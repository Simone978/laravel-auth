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

  <div class="container">
      <div class="row">
        <form action="{{route('comment.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name">
            </div>
            <div class="form-group">
                <label for="body">body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                <input type="hidden" name="post_id" value = "{{$post->id}}">
            </div>
                
            {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
            
            <button class="btn btn-success" type= "submit">salva</button>
            
            </form>
          <div class="comments">
              @forelse ($post->comments as $comment)
                <p>scritto da: {{$comment->name}}</p>
                <p>titolo: {{$comment->body}}</p>
                  
              @empty
              <p>non ci sono commenti</p>
                  
              @endforelse
          </div>
      </div>
  </div>
  
  

  
 
@endsection