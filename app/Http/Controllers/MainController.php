<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showMainPage(){

        return view('main', [
            'printing_services' => Service::query()->where('type', '=', 'printing service')->get(),
            'notaries' => Service::query()->where('type', '=', 'notary')->get(),
            'posts' => Post::query()->orderBy('created_at', 'desc')->limit(3)->get(),
        ]);
    }
}
