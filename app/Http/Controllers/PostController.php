<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::all();
        return view('dashboard',['posts' => $posts]);
    }

    public function postCreatePost(Request $request){
        //Validation
        $this->validate($request, [
           'body'=>'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)){
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
}
/**
 * Created by PhpStorm.
 * User: LenovoPc
 * Date: 1/10/2017
 * Time: 1:14 AM
 */