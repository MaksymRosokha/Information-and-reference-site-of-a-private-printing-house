<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showMainPage(){
        return view('main', ['services' => Service::all()]);
    }
}
