<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function check() {

        if( !(Auth::check() ) ) return redirect('/login');
        
    }
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(15);

        return view('posts.home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->check();

        $posts = User::find(Auth::user()->id)->posts;
        return view('posts.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->check();

        if( Auth::check() ) {
            $created = Post::create([
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => Auth::user()->id
            ]);
            if ($created) {
                return redirect('/posts')->with('message', 'Post is added successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $posts = User::find(Auth::user()->id)->posts;

        return view('posts.show', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $post = Post::find($id);
        $posts = User::find(Auth::user()->id)->posts;
        return view('posts.edit', compact('post', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $post->user_id;
        $post->save();


        return redirect('/posts')->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect( '/posts')->with('message', 'Post has been deleted successfully!');
    }
    public function isLoggedIn() {
        return Auth::check();
    }
}
