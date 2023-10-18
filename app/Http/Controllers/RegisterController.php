<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    public function show()
    {
        return 0;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());

            auth()->login($user);

            return APIHelper::makeAPIResponse(true, 'Login Successfully', $user);

        } catch (\Exception $e) {
            return APIHelper::makeAPIResponse(false, 'Internal server error', null, 500);
        }
    }
}
