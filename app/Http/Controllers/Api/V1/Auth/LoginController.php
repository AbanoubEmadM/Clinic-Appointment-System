<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request)
    {
        // Check user in DB
        $request->authenticate();

        // Save user info
        $user = Auth::user();
        $user->update(['last_login_at' => \Carbon\Carbon::now()]);
        // create token
        $token = $user->createToken('main')->plainTextToken;
        return response()->json(['user' => $user,'token' => $token]);
    }
}
