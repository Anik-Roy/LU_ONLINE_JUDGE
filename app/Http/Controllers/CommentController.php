<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Blog;
use App\Category;
use App\Notification;
use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function poststore(Request $request, $id)
    {
        $user = Auth::user();
        $post_author_id = Post::find($id);
        $post_author_id = $post_author_id->user->id;

        Comment::create([
            'user_id' => $user->id,
            'from_user_id' => $post_author_id,
            'post_id' => $id,
            'body' => $request->body
            ]);
        $notificationData = [
            'post_id' => $id,
            'user_id' => $post_author_id,
            'body'    => $request->body
        ];
        
        Notification::create($notificationData);
        
        $allCategory = Category::all();
        $post = Blog::find($id);
        return back();
    }
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        
        // $comment = new Comment;
        // $comment->body = $request->body;
        // $comment->user_id = $user->id;
        // $comment->blog_id = $id;
        
        Comment::create([
            'user_id' => $user->id,
            'blog_id' => $id,
            'body' => $request->body
            ]);
            return json_encode($user);
            
        $notificationData = [
            'blog_id' => $id,
            'user_id' => $user->id,
            'body'    => $request->body
        ];
        
        Notification::create($notificationData);
        
        $allCategory = Category::all();
        $post = Blog::find($id);
        return view('blog.fullblogpost', compact('post', 'allCategory'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
