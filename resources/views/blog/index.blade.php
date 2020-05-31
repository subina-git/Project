@extends('layouts/app')

@section('content')
    </br>
    <div class="container">
        @if(count($posts)>0)
            @foreach($posts as $post)
                <div class="well">
                    <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img src="/storage/cover_images/{{$post->cover_images}}" style="width:100%">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <h5 class="display-5"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h5>
                                <small>By {{$post->name}} On {{$post->created_at}}</small>
                            </div>
                    </div>
                    </br>
                </div>
                
            @endforeach
            {{$posts->links()}}
        @else
            <h5 class="display-5">No posts to show</h5>
        @endif
    </div>
    
@endsection