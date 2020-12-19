<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        //? submitted data validation
        $validator = Validator::make(request()->all(), [

            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails()){

            return response()->json(['error' => 'Sorry! Invalid Registration Information.']);

        }else{
            //? create nre user
            $getUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json(['success' => 'Account Create Successfully with this '.$request->email.'', ], 200);
        }
    }

    //? check email before create new user
    public function emailCheck(Request $request)
    {

        $emailCheck = User::where('email', $request->email)->first();

        if($emailCheck){

            return response()->json(['error' => 'Sorry! This Email already registered with another account.']);

        }else{
        }
    }
}
