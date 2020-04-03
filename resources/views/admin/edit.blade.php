@extends('layouts.app')

@section('content')
    <div class="container">

    
        <form action="{{route('admin.posts.update', $post)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <img src="{{asset('storage/'.$post->img_path)}}" alt="">
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="body">body</label>
            <textarea class="form-control" name="body" id="body"cols="30" rows="10"> {{$post->body}}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">tags</label>
            @foreach ($tags as $tag)
            <span>{{$tag->name}}</span>
            <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{$post->tags->contains($tag->id) ? 'checked' : ''}}>  
            @endforeach 
        </div>
        <div class="form-group">
            <label for="img_path">Modifica o aggiungi immagine</label>
            <input type="file" name="img_path" accept="image/*">
        </div>
        
        <button class="btn btn-success" type= "submit">modifica</button>
        
        </form>
    </div>  
@endsection