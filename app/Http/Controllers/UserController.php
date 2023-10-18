<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getAllUsers(){
        try {
            $users = User::paginate();
            return APIHelper::makeAPIResponse(true, 'User list', $users);
        }catch (\Exception $e){
            return APIHelper::makeAPIResponse(false, 'Internal server error', null,500);
        }
    }
    public function signUp(Request $request){
        return 1 ;
    }

    public function signIn(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                'password' => 'required|string',
                'email' => 'required|string',
            ]);

            if ($validator->fails()) {
                return APIHelper::makeAPIResponse(false, ['error' => $validator->errors()], null, 422);
            }
            $password = $request->input('password');
            $email = $request->input('email');

            $user = User::where('email',$email)->where('password',$password)->get()->first();

            if ($user){
                return APIHelper::makeAPIResponse(true, 'Login Successfully', $user);
            }
            else{
                return APIHelper::makeAPIResponse(false, 'Login failed');
            }


        }catch (\Exception $e){
            return APIHelper::makeAPIResponse(false, 'Internal server error', null,500);
        }
    }
}
