<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
    }

    public function showLoginPage(Request $request)
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {

    }
}
