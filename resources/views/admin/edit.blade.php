@extends('layouts.app')

@section('content')
    <div class="container">

    
        <form action="{{route('admin.posts.update', $post)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="body">body</label>
            <textarea class="form-control" name="body" id="body"cols="30" rows="10"> {{$post->body}}</textarea>
        </div>
        {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
        
        <button class="btn btn-success" type= "submit">modifica</button>
        
        </form>
    </div>  
@endsection