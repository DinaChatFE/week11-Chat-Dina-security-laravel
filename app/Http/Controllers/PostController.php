<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $posts = Post::paginate(10);
        $categories = Post::getPostCategories();
        $post = Post::getPostUserModel(auth()->user()->id);

        return view('post', ['categories' => $categories, 'posts' => $post]);
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
    public function store(PostRequest $request)
    {
        // $arrCategories = explode(',', $request->categories);
        Post::create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        return redirect()->back()->with('success', 'Add post successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Post::getPostCategories();
        $invidulePost = Post::getPostIdModel($id);
        $post = Post::getPostUserModel(auth()->user()->id);

        return view('post', ['categories' => $categories, 'posts' => $post, 'edit' => $id, 'ipost' => $invidulePost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update((array_merge($request->all(), ['created_at' => Carbon::now()])));
        return redirect()->route('post.index')->with('success', 'Update post successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postid = Post::findOrFail($id);
        $postid->delete();

        return redirect('post')->with(['success' => "Delete successfully"]);
    }
}
