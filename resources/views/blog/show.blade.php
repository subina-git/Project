@extends('layouts/app')

@section('content')
    </br>
    <div class="container">
        <h3>{{$post->title}} </h3></br>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <img src="/storage/cover_images/{{$post->cover_images}}" style="width:100%">
            </div>
            <div class="col-md-8 col-sm-8">
                {{$post->Blog}}</br>
                Written On {{$post->created_at}}
            </div>
        </div>
        @auth
        @if($post->user_id==Auth::user()->id)
            </br>
            <div class="d-flex justify-content-between">
                <a href="{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                {!!Form::open(['action' => ['PostsController@destroy' , $post->id] , 'method' => 'POST' , 'class' => 'float-right'])!!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            </div>
        @endif
        @endauth
    </div>
@endsection