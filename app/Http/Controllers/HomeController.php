<?php

namespace App\Http\Controllers;

use App\Events\NewMemberAdded;
use App\Http\Requests\AddNewMember;
use App\Http\Requests\CompleteProfile;
use App\Http\Requests\EditProfile;
use App\Notifications\PaymentDeclined;
use App\Notifications\PaymentSent;
use App\Notifications\PaymentVerified;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Uuid;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getComingSoon()
    {
        return view('dashboard.comingsoon');
    }

    public function getCompleteProfile(Request $request)
    {
        if ($request->user()->is_profile_completed)
        {
            alert()->warning('Already Done!','You have already completed that. Visit Edit Profile section to make any changes.');
            return redirect()->route('dashboard');
        }

        return view('dashboard.complete_profile');
    }

    public function postCompleteProfile(CompleteProfile $request)
    {
        $pancard = $request->pancard;
        $addr_line1 = $request->addr_line1;
        $addr_line2 = $request->addr_line2;
        $addr_state = $request->addr_state;
        $addr_pincode = $request->addr_pincode;
        $addr_city = $request->addr_city;
        $addr_district = $request->addr_district;
        $bank_account_number = $request->bank_account_number;
        $bank_holder_name = $request->bank_holder_name;
        $bank_bank_name = $request->bank_bank_name;
        $bank_ifsc_code = $request->bank_ifsc_code;
        $bank_account_type = $request->bank_account_type;
        $paytm_number = $request->paytm_number;
        $upi_id = $request->upi_id;
        $preferred_payment_method = $request->preferred_payment_method;

        // Check if preferred_payment_method matches and has the data.
        if ($preferred_payment_method == "PAYTM" && $paytm_number == null)
            return redirect()->back()->withErrors(['error' => 'Preferred Payment Method you selected should not be Empty'])->withInput();
        else if ($preferred_payment_method == "UPI" && $upi_id == null)
            return redirect()->back()->withErrors(['error' => 'Preferred Payment Method you selected should not be Empty'])->withInput();
        else if ($preferred_payment_method == "BANK" && $bank_account_number == null)
            return redirect()->back()->withErrors(['error' => 'Preferred Payment Method you selected should not be Empty'])->withInput();


        // User Instance
        $user = \Auth::user();

        //File Upload for Profile Pic
        //with resizing an uploaded file
        if ($request->photo != null) {
            if ($photo = \Image::make($request->file('photo'))->resize(300, 300)->save(storage_path('/app/public/') . md5($user->email) . '.' . $request->file('photo')->extension())) {
                $profile_pic = $photo->basename;
            } else {
                $profile_pic = null;
            }
        } else {
            $profile_pic = null;
        }

        $user->photo = $profile_pic;
        $user->pancard = $pancard;
        $user->addr_line1 = $addr_line1;
        $user->addr_line2 = $addr_line2;
        $user->state = $addr_state;
        $user->city = $addr_city;
        $user->district = $addr_district;
        $user->pincode = $addr_pincode;
        $user->preferred_payment_method = $preferred_payment_method;
        $user->paytm_number = $paytm_number;
        $user->upi_id = $upi_id;
        $user->bank_account_holdername = $bank_holder_name;
        $user->bank_account_number = $bank_account_number;
        $user->bank_account_bankname = $bank_bank_name;
        $user->bank_account_type = $bank_account_type;
        $user->bank_account_ifsc = $bank_ifsc_code;
        $user->is_profile_completed = true;
        $user->is_kyc = 0;
        $user->kyc_request_at = Carbon::now();

        /**
         * Check if payment_confirmed == true and if yes then mark user as Active.
         */
        if($user->payment_confirmed)
        {
            $user->activated_at = Carbon::now();
            $user->status = 1;
        }

        // Try saving User and Respond
        if ($user->save()) {
            toast('Your Profile & KYC has been updated!', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('dashboard');
        } else {
            toast('There are some Unknown Error. Contact Admin or Raise a ticket.', 'error', 'top-right')->autoClose(10000);
            return redirect()->back()->withErrors(['error' => 'Unknown Error. Contact Admin'])->withInput();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getAddMember(Request $request)
    {
        if(!$request->user()->isAdmin())
        {
            alert()->error('Unauthorized!', 'You are not authorized to view the page.')->showCancelButton("Close")->autoClose(10000);
            return redirect()->route('dashboard');
        }
        return view('dashboard.add_members');
    }


    /**
     * @param AddNewMember $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddMember(AddNewMember $request)
    {
        $uuid = Uuid::generate(4);
        $username = "GL" . strtoupper(mt_rand(100000,999999));
        while (User::whereUsername($username)->first() != null) {
            $username = "GL" . strtoupper(mt_rand(100000,999999));
        }
        $password = str_random(10);

        $ref_user = $request->referral_user;
        if ($rfu = User::whereUsername($ref_user)->first()) {
            $ref_user = User::whereUsername($ref_user)->first()->id;
        } else {
            $ref_user = null;
        }

        $newMember = User::create([
            'uuid' => $uuid->string,
            'username' => $username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'referral_user_id' => $ref_user,
            'payment_amount' => 0,
            'payment_confirmed' => true
        ]);

        // Increment total referrals to +1 for the referrer
        $rfu->total_referrals = $rfu->total_referrals + 1;
        $rfu->save();

        // Fire an Event for handling further tasks.
        event(new NewMemberAdded($newMember, $password));

        // SweetAlert
        alert()
            ->success('Success!', "New Member has been added!")
            ->footer("<a href='" . route('dashboard') . "'>Go to Dashboard</a>")
            ->showConfirmButton()
            ->persistent();
        return redirect()->back();
    }

    /**
     * View all Payment to Data for Sender
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTransactions(Request $request)
    {
        //$request->user()->withdrawFloat(11.50, ['desc' => 'For Site Kakamora', 'txn_id' => 'KJSHDF453455KJHKF']);
        $transactions = $request->user()->transactions()->latest()->paginate(25);
        return view('dashboard.transactions')->with('transactions', $transactions);
    }


    /**
     * View Form for Payment Confirmation for Sender
     *
     * @param $uuid
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getViewWithdrawRequestForm(Request $request)
    {
        if (!$request->user()->is_kyc) {
            alert()->error('Error!', 'You need to complete KYC before withdraw')->autoClose(5000);
            return redirect()->back();
        }

        $selector = [];
        if ($request->user()->bank_account_number)
            $selector = array_add($selector, 'BANK', 'Bank Account');
        if ($request->user()->paytm_number)
            $selector = array_add($selector, 'PAYTM', 'PAYTM Number');
        if ($request->user()->upi_id)
            $selector = array_add($selector, 'UPI', 'UPI ID');

        $paymentAmountOptions = [500 => '₹500',1000 => '₹1000',2000 => '₹2000',5000 => '₹5000',10000 => '₹10,000',15000 => '₹15,000',20000 => '₹20,000',30000 => '₹30,000',40000 => '₹40,000',50000 => '₹50,000'];

        return view('dashboard.withdrawrequestform')->with('selector', $selector)->with('paymentAmountOptions', $paymentAmountOptions);
    }


    /**
     * Post Submit form for Payment Confirmation for Sender
     *
     * @param $uuid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postViewWithdrawRequestForm(Request $request)
    {
        if (!$request->user()->is_kyc) {
            alert()->error('Error!', 'You need to complete KYC before withdraw')->autoClose(5000);
            return redirect()->back();
        }

        // Validate Form
        $validatedData = $request->validate([
            'payment_method' => [
                'required',
                Rule::in(['BANK', 'PAYTM', 'UPI']),
            ],
            'payment_amount' => 'required|in:500,1000,2000,5000,10000,15000,20000,30000,40000,50000',
        ]);

        // Amount must be smaller than wallet balance
        if ($request->payment_amount > $request->user()->balanceFloat) {
            alert()->error('Error!', 'Please choose amount less than or equal to your Wallet balance')->autoClose(5000);
            return redirect()->back();
        }

        // One more cross check for payment method validation against malicious users.
        switch ($validatedData['payment_method']) {
            case "PAYTM":
                if ($request->user()->paytm_number == null) {
                    alert()->error('Error!', 'Dangerous activity detected! Incident will be reported to admin.')->autoClose(10000);
                    return redirect()->back();
                }
                break;
            case "UPI":
                if ($request->user()->upi_id == null) {
                    alert()->error('Error!', 'Dangerous activity detected! Incident will be reported to admin.')->autoClose(10000);
                    return redirect()->back();
                }
                break;
            case "BANK":
                if ($request->user()->bank_account_number == null) {
                    alert()->error('Error!', 'Dangerous activity detected! Incident will be reported to admin.')->autoClose(10000);
                    return redirect()->back();
                }
                break;
            default:
        }

        // Create Payment Data
        $createArray = [
            'uuid' => \Uuid::generate(4),
            'user_id' => $request->user()->id,
            'payment_method' => $request->payment_method,
            'payment_data' => $request->user()->paytextdata,
            'payment_amount' => $request->payment_amount
        ];
        $paymentData = Payment::create($createArray);

        // Remove that amount from Wallet.
        $request->user()->withdrawFloat($request->payment_amount, ['desc' => 'Withdraw Request ID: '.$paymentData->id, 'txn_id' => strtoupper(str_random(16)) ]);

        // Notification to receiver that payment is done and need verification.
        //$request->user()->notify(new PaymentSent($paymentData));

        alert()->toast("Withdraw request has been created and sent to administrator.", 'success')->autoClose(10000);
        return redirect()->route('get.withdrawrequest');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getViewWithdrawRequests(Request $request)
    {
        $payments = $request->user()->payments()->latest()->paginate(10);
        return view('dashboard.withdrawrequests')->with('payments',$payments);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postViewReceivedPayments(Request $request)
    {
        $payment = Payment::whereUuid($request->id)->firstOrFail();
        $receiver = $payment->receiver;
        $sender = $payment->sender;

        // If already mark as paid. Abort
        if($payment->payment_status > 0)
        {
            alert()->error('Error!','Payment is already marked as paid.')->showCancelButton('Close')->autoClose(5000);
            return redirect()->back();
        }

        // If user is not authorized to do so.
        if ($payment->receiver_id != $request->user()->id) {
            alert()->error('Access Denied!', 'You are not authorized for that action.')->showCancelButton('Close')->autoClose(5000);
            return redirect()->back();
        }

        // Check what is the action of the form and handle accordingly.
        switch ($request->input('action')) {
            case 'accept':
                // Accept the Payment
                $payment->payment_status = 1;
                $payment->verified_at = Carbon::now();
                $payment->save();

                // Increment Earned Money in Receiver's User table
                $receiver->total_income = $receiver->total_income + $payment->payment_amount;
                $receiver->save();

                // Check if this is the last pending Payment for the Sender. true = is last , false = nope
                // If yes then set payment_confirmed = true for the Sender.
                $isLast = $sender->payments_send->reject(function ($p){
                    return $p->payment_status == 1;
                });
                if($isLast->isEmpty())
                {
                    $sender->payment_confirmed = true;
                    // Check if is_profile_completed and if yes then Mark user as Active
                    if($sender->is_profile_completed)
                    {
                        $sender->activated_at = Carbon::now();
                        $sender->status = 1;
                    }
                    // Persist the Model
                    $sender->save();
                }

                // Notification to sender that payment is done.
                $sender->notify(new PaymentVerified($payment));

                //SweetNotify and go back.
                alert()->success('Payment Verified!', 'You have verified the payment successfully.')->showCancelButton('Close')->autoClose(5000);
                return redirect()->back();
                break;
            case 'deny':
                // Mark all Payment fields and empty, Set paid_at to null
                // and mark payment_status = -1
                $payment->payment_status = -1;
                $payment->payment_txn_id = null;
                $payment->paid_at = null;
                $payment->save();

                // Notification to sender that payment is declined.
                $sender->notify(new PaymentDeclined($payment));

                //SweetNotify and go back.
                alert()->info('Payment set as Not Received!', 'You have marked payment as Not received and sent back to sender for recheck.')->showCancelButton('Close')->autoClose(10000);
                return redirect()->back();
                break;
            default:
                // unknown action
                alert()->error('Unknown Action!', 'Action you performed is invalid. Please try again.')->showCancelButton('Close')->autoClose(5000);
                return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNotifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(15);
        return view('dashboard.notifications')->with('notifications',$notifications);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResetPassword()
    {
        return view('dashboard.resetpassword');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postResetPassword(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|confirmed|min:6'
        ]);
        $user = $request->user();
        if($request->curr_password == $request->password)
        {
            alert()->error('Error!','Current Password & New Password cannot be same.')->showCancelButton('Close')->autoClose(5000);
            return redirect()->back();
        }
        if(Hash::check($request->curr_password, $user->password))
        {
            $user->password = Hash::make($request->password);
            $user->save();
            alert()->success('Password Updated!','You have successfully updated your password.')->showCancelButton('Close')->autoClose(5000);
            return redirect()->route('dashboard');
        }
        alert()->error('Error!','Current Password did not match our records.')->showCancelButton('Close')->autoClose(5000);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditProfile(Request $request)
    {
        if(!$request->user()->is_profile_completed)
        {
            alert()->error('User not Active!', 'Please activate your user first');
            return redirect()->route('dashboard');
        }
        return view('dashboard.editprofile')->with('user', $request->user());
    }

    /**
     * @param EditProfile $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditProfile(EditProfile $request)
    {
        $full_name = $request->full_name;
        $gender = $request->gender;
        $dob = $request->dob;
        $phone_number = $request->phone_number;
        $pancard = $request->pancard;
        $addr_line1 = $request->addr_line1;
        $addr_line2 = $request->addr_line2;
        $addr_state = $request->state;
        $addr_pincode = $request->pincode;
        $addr_city = $request->city;
        $addr_district = $request->district;
        $bank_account_number = $request->bank_account_number;
        $bank_holder_name = $request->bank_account_holdername;
        $bank_bank_name = $request->bank_account_bankname;
        $bank_ifsc_code = $request->bank_account_ifsc;
        $bank_account_type = $request->bank_account_type;
        $paytm_number = $request->paytm_number;
        $upi_id = $request->upi_id;
        $preferred_payment_method = $request->preferred_payment_method;

        // Check if preferred_payment_method matches and has the data.
        if ($preferred_payment_method == "PAYTM" && $paytm_number == null)
            return redirect()->back()->withErrors(['error' => 'Preferred Payment Method you selected should not be Empty'])->withInput();
        else if ($preferred_payment_method == "UPI" && $upi_id == null)
            return redirect()->back()->withErrors(['error' => 'Preferred Payment Method you selected should not be Empty'])->withInput();
        else if ($preferred_payment_method == "BANK" && $bank_account_number == null)
            return redirect()->back()->withErrors(['error' => 'Preferred Payment Method you selected should not be Empty'])->withInput();

        // User Instance
        $user = $request->user();

        //File Upload for Profile Pic
        //with resizing an uploaded file
        if ($request->photo != null) {
            if ($photo = \Image::make($request->file('photo'))->resize(300, 300)->save(storage_path('/app/public/') . md5($user->email) . '.' . $request->file('photo')->extension())) {
                $profile_pic = $photo->basename;
            } else {
                $profile_pic = null;
            }
        } else {
            $profile_pic = $user->photo ? $user->photo : null ;
        }

        $user->full_name = $full_name;
        $user->gender = $gender;
        $user->dob = $dob;
        $user->phone_number = $phone_number;
        $user->photo = $profile_pic;
        $user->pancard = $pancard;
        $user->addr_line1 = $addr_line1;
        $user->addr_line2 = $addr_line2;
        $user->state = $addr_state;
        $user->city = $addr_city;
        $user->district = $addr_district;
        $user->pincode = $addr_pincode;
        $user->preferred_payment_method = $preferred_payment_method;
        $user->paytm_number = $paytm_number;
        $user->upi_id = $upi_id;
        $user->bank_account_holdername = $bank_holder_name;
        $user->bank_account_number = $bank_account_number;
        $user->bank_account_bankname = $bank_bank_name;
        $user->bank_account_type = $bank_account_type;
        $user->bank_account_ifsc = $bank_ifsc_code;
        $user->is_profile_completed = true;

        // Try saving User and Respond
        if ($user->save()) {
            toast('Your Profile has been updated!', 'success', 'top-right')->autoClose(5000);
            return redirect()->back();
        } else {
            toast('There are some Unknown Errors. Contact Admin or Raise a ticket.', 'error', 'top-right')->autoClose(10000);
            return redirect()->back()->withErrors(['error' => 'Unknown Error. Contact Admin'])->withInput();
        }
    }

    /**
     * @param $user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserDetails($user, Request $request)
    {
        $user = User::whereUuid($user)->firstOrFail();

        return view('dashboard.userdetails')->with('user', $user);
    }
}
