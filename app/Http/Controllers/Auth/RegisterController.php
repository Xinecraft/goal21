<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewMemberAdded;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Uuid;
use Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string|min:10|max:20',
            'gender' => 'required|in:M,F,O',
            'dob' => 'required|date',
            'referral_user' => 'required|max:255|string|exists:users,username',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     * @throws \Exception
     */
    protected function create(array $data)
    {
        $uuid = Uuid::generate(4);

        $username = "GL" . strtoupper(mt_rand(100000, 999999));
        while (User::whereUsername($username)->first() != null) {
            $username = "GL" . strtoupper(mt_rand(100000, 999999));
        }

        $ref_user = $data['referral_user'];
        if ($rfu = User::whereUsername($ref_user)->first()) {
            $ref_user = User::whereUsername($ref_user)->first()->id;
        } else {
            $ref_user = null;
        }

        $newUser = User::create([
            'uuid' => $uuid->string,
            'username' => $username,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'referral_user_id' => $ref_user,
            'last_login_ip' => Request::ip(),
            'status' => 1
        ]);

        if ($data['referral_user']) {
            // Increment total referrals to +1 for the referrer
            $rfu->total_referrals = $rfu->total_referrals + 1;
            $rfu->save();
        }
        // Fire an Event to handle further tasks.
        event(new NewMemberAdded($newUser, $data['password']));

        // Return user for login
        return $newUser;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function register(HttpRequest $request)
    {
        $this->validator($request->all())->validate();

        // If Referral User is not allowed to have referrals.
        if ($request->referral_user) {
            $rfu = User::whereUsername($request->referral_user)->first();
            if ($rfu == null || $rfu->is_banned || $rfu->status < 1) {
                alert()->error('Referral User Inactive!', 'The referral username is not allowed to have referrals')->showConfirmButton('Ok', '#e65251')->autoClose(20000);
                return back()->withInput();
            }
        }
        /*if($rfu->total_referrals >= 4)
        {
            alert()->error('Referral User Limit!','The referral username you trying to enter already have 4 direct members.')->showConfirmButton('Ok','#e65251')->autoClose(20000);
            return back()->withInput();
        }*/

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        alert()->success('IMPORTANT!', 'Please note down your Username: '. $user->username. '. It will be used while login as well as you need to share it with others as your Referral Code.')->showConfirmButton('Done', '#007bff')->autoClose(170000);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
