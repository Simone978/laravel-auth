<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    private $user;
    private $validateRules;

    public function __construct(){
        // $this->user = Auth::user();
        $this->validateRules = [
            'title'=>'required|string|max:255',
            'body'=>'required|string'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validateRules);
        $thisUser = Auth::user()->id;
        $data = $request->all();
        $newpost = new Post;
        $newpost->title= $data['title'];
        $newpost->body= $data['body'];
        $newpost->slug= Str::finish(Str::slug($newpost->title), rand(1, 1000000));
        $newpost->user_id= $thisUser;

        $saved=$newpost->save();
        if(!$saved){
            return redirect()->back();
        }
        return redirect()->route('admin.posts.show', $newpost->slug);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin/show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        return view('admin.edit', compact('post'));
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
    public function destroy(Post $post)
    {
        if(empty($post)){
            abort(404);
        }
        $post->delete();
        return redirect()->route('admin.posts.index', compact('post'));
    }
}
