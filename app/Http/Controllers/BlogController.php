<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Comments;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if($id == 1) {
            $allPost = Blog::all();

            return view('blog.adminblog.home', compact('allPost'));
        }

        if($id == 2) {
            $categories = Category::all();

            return view('blog.adminblog.create', compact('categories'));
        }

        if($id == 3) {
            $allCategory = Category::all();

            return view('blog.adminblog.category', compact('allCategory'));
        }
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
    public function store(Request $request)
    {
        //return Auth::user();

        $blog = new Blog;
        $blog->title = $request->Title;
        $blog->category = $request->Category;
        $blog->image = $request->Image->getClientOriginalName();
        $blog->post = $request->Post;
        $blog->author = Auth::user()->name;

        $created = $blog->save();

        if($created) {
            //$path = "upload/".basename($_FILES["Image"]["name"]);
            $imageName = $request->Image->getClientOriginalName();
            $request->Image->move(public_path('upload/'), $imageName);
            //move_uploaded_file($_FILES["Image"]["tmp_name"], $path);
            $id = 1;
            return redirect('blog/' . $id)->with('message', 'Post is created successfully.');
        }
        else {
            $id = 1;
            return redirect('blog/' . $id)->with('message', 'Post creation failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = Blog::find($id);
        $post->title = $request->Title;
        $post->category = $request->Category;
        $post->author = Auth::user()->name;
        $post->image = $request->Image->getClientOriginalName();
        $post->post = $request->Post;

        $updated = $post->save();

        if($updated) {
            $imageName = $request->Image->getClientOriginalName();
            $request->Image->move(public_path('upload/'), $imageName);
            return redirect('editpost/'.$post->id)->with('message', 'Post is edited successfully.');
        }
        else {
            return redirect('editpost/'.$post->id)->with('message', 'Post editation failed.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Blog::find($id);
        $deleted = $post->delete();

        if($deleted) {
            $id = 1;
            return redirect('blog/' . $id)->with('message', 'Post is deleted successfully.');
        }

        else {
            $id = 1;
            return redirect('blog/' . $id)->with('message', 'Post cannot be deleted. An error occured.');
        }
    }

    public function editPost($id) {
        $post = Blog::find($id);
        $category = Category::all();
        return view('blog.adminblog.edit', compact('post', 'category'));
    }

    public function deletePost($id) {
        $post = Blog::find($id);
        $category = Category::all();
        return view('blog.adminblog.delete', compact('post', 'category'));
    }

    public function createCategory(Request $request) {
        $category = new Category;
        $category->name = $request->category;

        $userName = Auth::user()->name;
        $category->creatorname = $userName;

        $created = $category->save();

        if($created) {
            $id = 3;
            return redirect('blog/' . $id)->with('message', 'Category is created successfully');
        }

        else {
            $id = 3;
            return redirect('blog/' . $id)->with('message', 'Category creation failed');
        }
    }

    public function deleteCategory($id) {
        $deleted = Category::find($id)->delete();

        if($deleted) {
            $id = 3;
            return redirect('blog/'.$id)->with('message', 'Category is deleted successfully');
        }
    }

    public function liveBlogPost() {
        $allPost = Blog::orderBy('created_at', 'desc')->get();
        $allCategory = Category::all();
        return view('blog.index', compact('allPost', 'allCategory'));
    }

    public function liveBlogPostById($id) {
        $post = Blog::find($id);
        $allCategory = Category::all();
        return view('blog.fullblogpost', compact('post', 'allCategory'));
    }
}
