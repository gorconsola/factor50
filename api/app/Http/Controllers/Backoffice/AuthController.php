<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Wrong email or password',
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


    public function sendResetLinkEmail (Request $request)
    {
        $email = $request->only('email')['email'];
        $email = base64_decode($email);

        $credentials = ['email' => $email];

        $response = Password::sendResetLink($credentials);

        return $response === Password::RESET_LINK_SENT
            ? response()->json([
                'message' => 'Reset link sent to your email.',
                'status' => 201
            ], 201)
            : response()->json([
                'message' => 'Unable to send reset link',
                'status' => 401
            ], 401);
    }


    /**
     * Reset Redirect
     *
     * @return \Illuminate\Http\Response
     */
    public function passwordResetRedirect(Request $request)
    {
        $token = str_replace('=', '', $request->getQueryString());
        return redirect(config('backoffice.url') . '#/reset/' . $token);
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
        $user = User::with('userRole')->find(Auth::user()->id);

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
