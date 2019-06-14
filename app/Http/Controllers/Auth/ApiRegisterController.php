<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class ApiRegisterController extends RegisterController
{
    /**
     * Handle a registration request for the application.
     *
     * @override
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function register(Request $request)
    {
        $errors = $this->validator($request->all())->errors();

        if (count($errors)) {
            return response(['errors' => $errors], 401);
        }

        if ($request->referral_user) {
            // If Referral User is not allowed to have referrals.
            $rfu = User::whereUsername($request->referral_user)->first();
            if ($rfu == null || $rfu->is_banned || !$rfu->is_profile_completed || $rfu->status < 1) {
                return response(['errors' => 'Referral is not active or banned'], 401);
            }
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return response(['user' => $user]);
    }
}
