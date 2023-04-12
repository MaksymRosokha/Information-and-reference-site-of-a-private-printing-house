<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function showAdminPage()
    {
        return view('users.admin');
    }
}
