<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }


    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return response()->json([
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

}
