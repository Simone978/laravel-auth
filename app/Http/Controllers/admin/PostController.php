<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    private $user;
    private $validateRules;

    public function __construct(){
        // $this->user = Auth::user();
        $this->validateRules = [
            'title'=>'required|string|max:255',
            'body'=>'required|string',
            'img_path'=>'image'
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
        $tags = Tag::all();
        return view('admin.create', compact('tags'));
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
        
        $path=Storage::disk('public')->put('images', $data['img_path']);

        $newpost = new Post;
        $newpost->title= $data['title'];
        $newpost->body= $data['body'];
        $newpost->slug= Str::finish(Str::slug($newpost->title), rand(1, 1000000));
        $newpost->user_id= $thisUser;
        $newpost->img_path= $path;

        $saved=$newpost->save();
        if(!$saved){
            return redirect()->back();
        }
         $tags = $data['tags'];
         $newpost->tags()->attach($tags);
         
         
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
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        $data = [
            'post'=> $post,
            'tags'=> $tags
        ];
        return view('admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validateRules);
        $thisUser = Auth::user()->id;
        $data = $request->all();
        $post = $post;
        $post->title= $data['title'];
        $post->body= $data['body'];
        $post->slug= Str::finish(Str::slug($post->title), rand(1, 1000000));
        $post->created_at= Carbon::now();
        $post->updated_at= Carbon::now();
        $updated=$post->update();
        if(!$updated){
            return redirect()->back();
        }
        $tags = $data['tags'];
        if(!empty($tags)){
            $post->tags()->sync($tags);
        };
        return redirect()->route('admin.posts.show', $post->slug);
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
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index', compact('post'));
    }
}
