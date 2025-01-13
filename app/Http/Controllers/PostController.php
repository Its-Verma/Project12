<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        // Fetch all blog posts with pagination
        $posts = Post::select('id', 'title', 'content')->where('status','published')->paginate(5); // Change number as needed
        return view('home', ['posts'=>$posts]);
    }

    // Display a single blog post
    public function show($id)
    {
        $post = Post::findOrFail($id); // Fetch the post by ID
        return view('show_post', compact('post'));
    }

    public function addPost(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if($validator->passes()){
           $post = new Post();
           $post->title = $request->title;
           $post->content = $request->content;
           $post->save();

           return redirect()->route('other.dashboard')->with('success','Post successfully created.');
        } else {
            return redirect()->route('other.dashboard')->withInput()->withErrors($validator);
        }
    }

    public function updatePost(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();
        return redirect()->route('other.dashboard')->with('success', 'Post updated successfully!');
    }
    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);

        // Toggle the status
        $post->status = ($post->status === 'published') ? 'draft' : 'published';
        $post->save();

        return redirect()->route('other.dashboard')->with('success', 'Post status updated successfully!');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('other.dashboard')->with('success', 'Post deleted successfully!');
    }
}
