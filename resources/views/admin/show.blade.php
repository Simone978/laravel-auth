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
  <div class="tags">
    <h3>tags</h3>
    <ul>
      @forelse ($post->tags as $tag)
      <span>{{$tag->name}}</span>
      <input type="checkbox" name="tags[]" value="{{$tag->id}}">  
      @empty
          No tag
      @endforelse
      
    </ul>
  </div>
 
@endsection