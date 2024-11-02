<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function index(){

        if( ! $this->isAuthenticated() )  return redirect()->route('login');

        return Inertia::render('dashboard');


    }
}
