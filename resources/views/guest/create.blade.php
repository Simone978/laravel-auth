@extends('layouts.app')

@section('content')
    <div class="container">

    
        <form action="{{route('posts.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name">
        </div>
        <div class="form-group">
            <label for="body">body</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
        </div>
        {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
        
        <button class="btn btn-success" type= "submit">salva</button>
        
        </form>
    </div>  
@endsection