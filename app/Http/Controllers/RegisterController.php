<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
    }

    public function doRegister(Request $request)
    {
        dd($request->all());
        return;
    }
}
