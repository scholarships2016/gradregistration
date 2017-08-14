<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminManagementController extends Controller
{

    /**
     * AdminManagementController constructor.
     */
    public function __construct()
    {
    }

    public function showManagePage(Request $request)
    {

    }

    public function showAddPage(Request $request)
    {
        return view('backoffice.admin.edit');
    }

    public function showEditPage(Request $request)
    {
        return view('backoffice.admin.edit');
    }
}
