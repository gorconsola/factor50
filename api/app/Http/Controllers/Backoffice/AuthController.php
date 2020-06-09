<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $user = User::with('userRole')->whereEmail($request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Verkeerde emailadres of wachtwoord',
                'status' => 422
            ], 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Verkeerde emailadres of wachtwoord',
                'status' => 422
            ], 422);
        }

        $token = $this->guard()->attempt($credentials);

        return response()
            ->json([
                'status' => 200,
                'data' => [
                    'token' => $token,
                    'user' => $user
                ]])
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
