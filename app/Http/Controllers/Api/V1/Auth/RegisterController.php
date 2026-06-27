<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    // invoke indicates that you only have controller with one function
    public function __invoke(RegisterRequest $request)
    {
        // Validate the input
        $validated = $request->validated();
        //Create the user in DB
        $user = User::create($validated);
        // Log user in
        Auth::login($user);
        return response()->json(Auth::user());
    }
}
