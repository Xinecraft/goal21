<?php

namespace App\Http\Controllers;

use App\Events\NewPremiumSubscription;
use App\Http\Requests\TaskRequest;
use App\Payment;
use App\SiteSetting;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Uuid;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function getKYCs()
    {
        $kycs = User::where('is_kyc', 0)->orWhere('is_kyc', 1)->orderBy('is_kyc')->latest()->paginate();
        return view('admin.listkyc')->with('kycs', $kycs);
    }

    public function getKYCDetail($username)
    {
        $kyc = User::where('username', $username)->firstOrFail();
        return view('admin.viewkyc')->with('kyc', $kyc);
    }

    public function postActionOnKYC($username, Request $request)
    {
        $kyc = User::where('username', $username)->firstOrFail();

        switch ($request->action) {
            case 'accept':
                $kyc->is_kyc = 1;
                $kyc->is_profile_completed = 1;
                $kyc->kyc_approved_at = Carbon::now();
                if ($kyc->save()) {
                    toast('KYC Has been accepted successfully', 'success', 'top-right')->autoClose(5000);
                    return redirect()->route('admin.get.kyclist');
                } else {
                    toast('There are some Unknown Error. ', 'error', 'top-right')->autoClose(10000);
                    return redirect()->back()->withErrors(['error' => 'Unknown Error. Contact Dev']);
                }
                break;
            case 'reject':
                $kyc->is_kyc = -1;
                $kyc->is_profile_completed = 0;
                $kyc->kyc_approved_at = null;
                $kyc->kyc_request_at = null;
                if ($kyc->save()) {
                    toast('KYC Has been rejected successfully', 'success', 'top-right')->autoClose(5000);
                    return redirect()->route('admin.get.kyclist');
                } else {
                    toast('There are some Unknown Error. ', 'error', 'top-right')->autoClose(10000);
                    return redirect()->back()->withErrors(['error' => 'Unknown Error. Contact Dev']);
                }
            case 'setpending':
                break;
            default:
        }
    }

    public function postApproveAllKYC()
    {
        User::where('is_kyc', '=', 0)->update(['is_kyc' => 1, 'is_profile_completed' => 1, 'kyc_approved_at' => Carbon::now()]);
        toast('All KYC accepted successfully', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('admin.get.kyclist');
    }

    public function getUsers()
    {

    }

    public function getUser()
    {

    }

    public function postActionOnUser()
    {

    }

    public function getListTasks()
    {
        return view('admin.listtasks');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function anyListTasks()
    {
        $tasks = Task::select(['id', 'type', 'link', 'wait_in_seconds', 'credit_inr', 'description', 'uuid']);

        return Datatables::of($tasks)
            ->addColumn('action', function ($task) {
                return '<a href="' . route('admin.get.edittask',$task->uuid)  . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';})
            ->editColumn('id', 'ID: {{$id}}')
            ->addColumn('type_name', function ($task) {
                return $task->type_name;
            })
            ->make(true);
    }

    public function getCreateTask()
    {
        return view('admin.createtask');
    }

    public function postCreateTask(TaskRequest $request)
    {
        $description = $request->description ? $request->description : null;
        $uuid = Uuid::generate(4);

        $task = Task::create([
            'type' => $request->type,
            'uuid' => $uuid,
            'link' => $request->link,
            'wait_in_seconds' => $request->wait_in_seconds,
            'credit_inr' => $request->credit_inr,
            'description' => $description,
            'is_active' => $request->is_active,
            'user_id' => $request->user()->id
        ]);

        if ($task) {
            toast('New Task is Created', 'success', 'top-right')->autoClose(5000);
            return redirect()->back();
        } else {
            toast('There are some Unknown Error. ', 'error', 'top-right')->autoClose(10000);
            return redirect()->back()->withErrors(['error' => 'Unknown Error. Contact Dev'])->withInput();
        }
    }

    public function getEditTask($uuid)
    {
        $task = Task::whereUuid($uuid)->firstOrFail();
        return view('admin.edittask')->with('task', $task);
    }

    public function postEditTask($uuid, TaskRequest $request)
    {
        $description = $request->description ? $request->description : null;
        $task = Task::whereUuid($uuid)->firstOrFail();

        $task = Task::where('uuid', $uuid)->update([
            'type' => $request->type,
            'uuid' => $uuid,
            'link' => $request->link,
            'wait_in_seconds' => $request->wait_in_seconds,
            'credit_inr' => $request->credit_inr,
            'description' => $description,
            'is_active' => $request->is_active,
            'user_id' => $request->user()->id
        ]);

        if ($task) {
            toast('Task has been updated', 'success', 'top-right')->autoClose(5000);
            return redirect()->back();
        } else {
            toast('There are some Unknown Error. ', 'error', 'top-right')->autoClose(10000);
            return redirect()->back()->withErrors(['error' => 'Unknown Error. Contact Dev'])->withInput();
        }
    }

    public function getSiteSettings()
    {
        $sitesettings = SiteSetting::all();
        return view('admin.sitesettings')->with(['sitesettings' => $sitesettings]);
    }

    public function postSiteSettings(Request $request)
    {
        $sitesettings = $request->all();
        array_shift($sitesettings);
        foreach ($sitesettings as $key => $value) {
            SiteSetting::whereSetting($key)->update(['value' => $value]);
        }
        toast('Settings updated. ', 'success', 'top-right')->autoClose(10000);
        return redirect()->back();
    }

    public function getListUsers()
    {
        return view('admin.listusers');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function anyListUsers()
    {
        $users = User::select(['id', 'full_name', 'username', 'email', 'phone_number', 'created_at', 'total_income', 'status', 'wallet_one', 'wallet_two', 'payment_confirmed']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
            return '<a href="' . route('admin.get.edituser',$user->username)  . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';})
            ->editColumn('id', 'ID: {{$id}}')
            ->addColumn('wallet', function (User $user) {
                return $user->balanceFloat;
            })
            ->make(true);
    }

    public function getListPaymentApprovals(Request $request)
    {
        $users = User::where('payment_confirmed', 0)->paginate();

        return view('admin.listpendingpayments')->with('paymentUsers', $users);
    }

    public function postApprovePayment($username, Request $request)
    {
        $user = User::whereUsername($username)->firstOrFail();

        $user->payment_confirmed = 1;
        $user->wallet_two += 30; // Add 30 INR BONUS MONEY
        $user->activated_at = now();
        $user->save();

        \File::delete(storage_path('app/public/').$user->payment_screenshot);

        event(new NewPremiumSubscription($user));

        toast('Payment Approved. ', 'success', 'top-right')->autoClose(10000);
        return redirect()->back();
    }

    public function deleteRejectPayment($username, Request $request)
    {
        $user = User::whereUsername($username)->firstOrFail();

        \File::delete(storage_path('app/public/').$user->payment_screenshot);

        $user->payment_confirmed = -1;
        $user->payment_applied_at = null;
        $user->payment_method = null;
        $user->payment_screenshot = null;
        $user->save();

        toast('Payment Rejected. ', 'info', 'top-right')->autoClose(10000);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getViewPendingWithdrawRequests(Request $request)
    {
        $payments = Payment::where('payment_status',0)->paginate(10);
        return view('admin.withdrawrequests')->with('payments',$payments);
    }

    public function postApprovePendingWithdrawRequest($uuid, Request $request)
    {
        $payment = Payment::whereUuid($uuid)->firstOrFail();

        $payment->payment_status = 1;
        $payment->paid_at = now();
        $payment->save();

        toast('Withdraw Request Completed. ', 'success', 'top-right')->autoClose(10000);
        return redirect()->back();
    }
}
