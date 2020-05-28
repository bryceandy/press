<?php

namespace Bryceandy\Press\Http\Controllers;

use Bryceandy\Press\Post;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all());
    }
}
