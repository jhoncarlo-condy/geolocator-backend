<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;

class UserController
{
    public function login(UserFormRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user) {
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken(Str::uuid());
                return response()->json([
                    'success' => true,
                    'token'   => $token->plainTextToken
                ]);
            }
        }

        return response()->json([
            'success' => false
        ]);
    }
}
