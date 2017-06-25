<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
    }

    public function showProfilePage(Request $request)
    {
        return view('profile.edit');
    }


}
