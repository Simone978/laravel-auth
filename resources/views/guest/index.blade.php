@extends('layouts.app')

@section('content')
<a class='btn btn-primary' href="{{route('admin.posts.create')}}">Crea un nuovo post</a>

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
        @foreach ($posts as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->user_id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->slug}}</td>
            <td><a class='btn btn-primary' href="{{route('post.show', $post->slug)}}">view</a></td>
          </tr>
        @endforeach
      
    </tbody>
    
  </table>
 
@endsection