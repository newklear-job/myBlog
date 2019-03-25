<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Debugbar;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at')->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->orderBy('created_at')->get();
        return view('posts.create', ['categories' => $categories, 'splitter' => ""]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:100|unique:posts',
            'body' => 'required|string',
            'photo' => 'nullable|string'
        ]);
        $post = new Post($request->all());
        $post->user_id = Auth::id();
        $post->save();
        if ($request->input('categories')) {
            $post->categories()->attach($request->input('categories'));
        }

        return redirect()->route('post.index')->with('status', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('parent_id', 0)->orderBy('created_at')->get();
        return view('posts.edit', ['categories' => $categories, 'post' => $post, 'splitter' => '']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => [
                'required',
                'string',
                'max:1',
                Rule::unique('posts')->ignore($post->id)
            ],
            'body' => [
                'required',
                'string'
            ],
            'photo' => [
                'nullable',
                'string'
            ]
        ]);
        $post->categories()->detach();
        if ($request->input('categories')){
            $post->categories()->attach($request->input('categories'));
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->photo = $request->photo;
        $post->save();
        return redirect()->route('post.index')->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('post.index')->with('status', 'Post deleted successfully!');
    }
}
