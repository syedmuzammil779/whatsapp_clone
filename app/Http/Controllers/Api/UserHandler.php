<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserHandler extends Controller
{
    //

    public function logout(Request $request){


        $user = $request->user();
        $user->currentAccessToken()->delete();

        return redirect()->route('login');
    }
}
