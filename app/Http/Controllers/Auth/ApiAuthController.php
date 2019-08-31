<?php

namespace App\Http\Controllers\Auth;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use JWTAuthException;
use App\User;

class ApiAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->user = new User;
    }

    /*public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $jwt = '';

        try {
            if (!$jwt = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_credentials',
                ], 401);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ], 500);
        }
        return response()->json([
            'response' => 'success',
            'result' => ['token' => $jwt]
        ]);
    }*/
    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function getAuthUser(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function getTasks()
    {
        $tasks = Task::all();
        $completedTasks = auth('api')->user()->tasks;

        $allTasks = $tasks->map(function ($task) use ($completedTasks) {
            $task->completed = false;
            if ($completedTasks->contains($task)) {
                $task->completed = true;
            }
            return $task;
        });
        return response()->json($allTasks);
    }

    public function getOneTask($uuid)
    {
        $task = Task::whereUuid($uuid)->firstorFail();
        $completedTasks = auth('api')->user()->tasks;
        $task->completed = false;
        if ($completedTasks->contains($task)) {
            $task->completed = true;
        }
        return response()->json($task);
    }

    public function postCompleteTask($uuid, Request $request)
    {
        if(env('KAKA_KEY') != $request->application_key)
        {
            return response()->json(['error' => 'Service Unavailable']);
        }
        $user = auth('api')->user();
        $task = Task::whereUuid($uuid)->firstorFail();
        $completedTasks = $user->tasks;
        if ($completedTasks->contains($task)) {
            return response()->json(['error' => 'Task Already Completed']);
        }
        $user->tasks()->attach($task, ['status' => 1]);

        $tasks = Task::count();
        $task_sum = Task::sum('credit_inr');

        $completedTasks = $user->tasks()->count();
        $pendingTasks = $tasks - $completedTasks;
        $user->total_task_pending = $pendingTasks;

        // Bug Fix shit
        if ($user->total_task_pending < 0)
        {
            $user->total_task_pending = 0;
        }

        $user->wallet_one = $user->wallet_one + $task->credit_inr;

        // Bug fix shit
        if($user->total_task_pending <= 0 && $user->wallet_one != $task_sum)
        {
            $user->wallet_one = $task_sum;
        }

        $user->save();
        Log::info($user->username." completed Task $task->id and got $task->credit_inr. Task Pending = $user->total_task_pending. New Wallet One Balance: $user->wallet_one");

        $task->total_impression += 1;
        $task->save();

        return response()->json(['success' => 'Task Completed Successfully']);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
