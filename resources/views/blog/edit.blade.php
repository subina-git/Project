@extends('layouts/app')

@section('content')
    {!! Form::open(['action' => ['PostsController@update' , $post->id] , 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{form::label('title','Blog Title')}}
            {{form::text('title',$post->title,['class' => 'form-control' , 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{form::label('body','Content')}}
            {{form::textarea('body',$post->Blog,['class' => 'form-control' , 'placeholder' => 'Body'])}}
        </div>
        <div class="form-group">
            {{form::file('cover_image')}}
        </div>
        {{form::hidden('_method','PUT')}}
        {{form::submit('Update',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection