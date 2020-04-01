<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    

    public function store(Request $request)
    {
    
        $request->validate([
            'name'=>'required|string|max:255',
            'body'=>'required|string'
        ]);
        
        $data = $request->all();
        
        $newcomment = new Comment;
        $newcomment->fill($data);
        $saved=$newcomment->save();

        if(!$saved){
            return redirect()->back();
        }
        
        return redirect()->route('post.show', $newcomment->post->slug);
        
        
    }
}
