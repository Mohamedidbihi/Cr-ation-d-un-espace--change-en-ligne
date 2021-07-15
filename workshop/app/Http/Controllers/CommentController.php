<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(Request $request)
    {
        $this->validate($request, [
            'commenter'=> 'required'
        ]);
        Comment::create([
        'user_id' => auth()->id(),
         'post_id' => $request->id,
         'commenter' => $request->commenter, 
  ]);
        return back();
    }
}