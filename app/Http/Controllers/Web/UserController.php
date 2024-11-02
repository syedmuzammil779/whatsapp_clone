<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //

    public function loginView(){


        return Inertia::render('login');


    }
    public function signUpView(){


        return Inertia::render('signUp');


    }
    public function login(Request $request){


        $this->validateFields($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ( ! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $response = array();
            $response['code'] = 2;
            $response['message'] = 'The entered email or password is invalid';
            echo json_encode($response);
            die();
        }

        $user = $request->user();

        $token = $user->createToken("whatsapp token")->plainTextToken;
        $user = User::find($user->id);


        Session::put('user_token',$token);


        return response()->json(["code"=>1,'message'=>'Success', 'token' =>$token]);



    }

    public function signUp(Request $request){


        info("User signUp===".$this->safeJson($request->all()));

        $this->validateFields($request, [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required',

        ]);



        $parameters = array(
            'name',
            'email',
            'password',
        );


        $user = new User();

        $random = 123456;

        $user->password = $request->password;
        $this->filledRequestFields($request,$parameters, $user);
        $user->save();


        $token = $user->createToken("whatsapp token")->plainTextToken;
        Session::put('user_token',$token);


        return response()->json(["code"=>1,'message'=>'Success', 'token' =>$token]);

    }


}
