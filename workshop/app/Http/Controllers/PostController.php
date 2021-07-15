<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->with(['user','likes'])->paginate(5);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'body'=> 'required'
        ]);
  Post::create([
'user_id' => auth()->id(),
'body' => $request->body
            ]);
  return back();
    }
    public function destroy(Post $post)
    {

   $this->authorize('delete',$post);
   $post->delete();
   return back();

    }

    public function update(Post $post)
    {
        //$this->authorize('delete',$post);
        if(auth()->user()->id === $post->user_id)
        {
            $data=Post::find($post);
           return view('posts.Update',[
               'data'=>$data
           ]);
        }
        else
        {
            abort(404);
        }
    }
    public function maj(Request $request)
    {
$data = Post::find($request->id);
$data->body = $request->body;
$data->save();
return redirect('posts');
    
    }

    public function comment(Post $post)
    {
        $data=Post::find($post);
        $data2=Comment::where('post_id',$post->id)->get();
        return view('posts.show',[
            'data'=>$data,
            'comments'=>$data2
        ]);
    }
 

    
}
