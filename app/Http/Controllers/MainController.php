<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private int $postsPage = 1;
    private int $postsLimit = 3;
    private int $postsOffset = 0;

    public function showMainPage(){

        return view('main', [
            'printing_services' => Service::query()->where('type', '=', 'printing service')->get(),
            'notaries' => Service::query()->where('type', '=', 'notary')->get(),
            'posts' => Post::query()->orderBy('created_at', 'desc')
                ->limit($this->postsLimit)->offset($this->postsOffset)->get(),
            'numberOfPostsPage' => $this->postsPage,
            'countOfPostsPages' => ceil(Post::query()->count() / $this->postsLimit),
        ]);
    }

    public function showAnotherPostsPage($page){
        if(!intval($page) || $page <= 0){
            $this->postsPage = 1;
        } elseif($page > ceil(Post::query()->count() / $this->postsLimit)) {
            $this->postsPage = ceil(Post::query()->count() / $this->postsLimit);
        } else {
            $this->postsPage = $page;
        }

        $this->setPostsOffsetValue();
        return $this->showMainPage();
    }

    private function setPostsOffsetValue() : void{
        $this->postsOffset = $this->postsLimit * ($this->postsPage - 1);
    }
}
