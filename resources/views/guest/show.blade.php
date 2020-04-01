@extends('layouts.app')

@section('content')

<table class="table">   
    <thead>  
        <tr>
        <th scope="col">Id</th>
        <th scope="col">User id</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Slug</th>
        </tr>      
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->user_id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->slug}}</td>
          </tr>
      
    </tbody>
    
  </table>

  <div class="comments">
      @forelse ($post->comments as $comment)
        <p>scritto da: {{$comment->name}}</p>
        <p>titolo: {{$comment->body}}</p>
          
      @empty
      <p>non ci sono commenti</p>
          
      @endforelse
  </div>

  
 
@endsection