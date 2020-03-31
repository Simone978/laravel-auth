@extends('layouts.app')

@section('content')
        <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
        @csrf
        @method('PATCH')
        {{-- <select name="userId">
            @foreach ($posts as $post)
                <option value="{{$post->user_id}}">
            @endforeach
        </select> --}}
        <input type="text" value="{{$post->title}}">
        <input type="text" value="{{$post->body}}">
        <input type="text" value="{{$post->slug}}">
        <button type= "submit">Modifica</button>
        
    </form>
@endsection