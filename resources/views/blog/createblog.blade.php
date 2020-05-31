@extends('layouts/app')

@section('content')
    {!! Form::open(['action' => 'PostsController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{form::label('title','Blog Title')}}
            {{form::text('title','',['class' => 'form-control' , 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{form::label('body','Content')}}
            {{form::textarea('body','',['class' => 'form-control' , 'placeholder' => 'Body'])}}
        </div>
        <div class="form-group">
            {{form::file('cover_image')}}
        </div>
        {{form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection