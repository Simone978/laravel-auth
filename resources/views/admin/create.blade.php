@extends('layouts.app')

@section('content')
    <div class="container">

    
        <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" name="title">
        </div>
        <div class="form-group">
            <label for="body">body</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="tags">tags</label>
            @foreach ($tags as $tag)
            <span>{{$tag->name}}</span>
            <input type="checkbox" name="tags[]" value="{{$tag->id}}">  
            @endforeach  
        </div>
        <div class="form-group">
            <label for="img_path">Aggiungi immagine</label>
            <input type="file" name="img_path" accept="image/*">
        </div>
        
        <button class="btn btn-success" type= "submit">salva</button>
        
        </form>
    </div>  
@endsection