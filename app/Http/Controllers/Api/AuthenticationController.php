<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        // dd('faisal',$request->all());
        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            // 'confirm_password' => $request->password,
        ];

        $formData['password'] = bcrypt($request->password);

        $user = User::create($formData);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('passportToken')->accessToken
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return handleValidationErrors('Validation Error.',422,$validator->errors());

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['user'] = $user;
            $success['token'] = $user->createToken($user->email)->accessToken;

            return sendSuccessResponse($success);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
}
