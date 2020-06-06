<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Http\Requests\Backoffice\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json(['status' => 'success'], 200);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->guard()->attempt($credentials);
        
        if (! $token) {
            return response()
                ->json(['error' => 'login_error'], 401);
        }

        return response()
            ->json(['status' => 'success'], 200)
            ->header('Authorization', $token);
    }


    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }


    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }


    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }


    private function guard()
    {
        return Auth::guard();
    }

}
