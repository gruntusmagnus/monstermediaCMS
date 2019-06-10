<?php

namespace App\Http\Controllers\Admin\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email'              => $request->email,
            'password'           => $request->password,
            'active'             => true,
            'authenticable_type' => Employee::class
        ];

        if (!$token = auth('api')->attempt($credentials)) {
            return response([
                                'status' => 'error',
                                'error'  => 'invalid.credentials',
                                'msg'    => 'Invalid Credentials.'
                            ], 400);
        }

        return response()
            ->json([
                       'status' => 'success',
                       'token'  => $token
                   ])
            ->header('Authorization', $token);
    }

    public function destroy()
    {
        auth('api')->logout();

        return response()->json(['status' => 'success']);
    }

    public function refresh()
    {
        return response()->json(auth('api')->user());
    }
}
