<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::all();
        return response()->json([
            'status' => true,
            'posts' => $posts
        ]);
    }

    public function create()
    {

    }

    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());
        
        return response()->json([
            'status' => true,
            'message' => "Post Created successfully!",
            'post' => $blog
        ], 200);
    }

    public function show(Blog $blog)
    {
    
    }

    public function edit(Blog $blog)
    {
    
    }

    public function update(StoreBlogRequest $request, Blog $blog)
    {
       
        $input = $request->all();
        $blog_post = Blog::find($blog); 
        $blog_post = $input['title']; 
        $blog_post = $input['description']; 
        $blog_post->save();

        // $blog_post->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Post Updated successfully!",
            'post' => $blog_post
        ], 200);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'status' => true,
            'message' => "Post Deleted successfully!",
        ], 200);
    }
}
