@extends('layouts/app')

@section('content')
    </br>
    <div class="container">
        @if(count($posts)>0)
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($posts as $post)
                    @if($post->user_id==auth()->user()->id)
                        <tr>
                            <td width=90%><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                            <td>
                                <a href="posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                {!!Form::open(['action' => ['PostsController@destroy' , $post->id] , 'method' => 'POST' , 'class' => 'float-right'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            
        @else
            <h5 class="display-5">No posts to show</h5>
        @endif
    </div>


@endsection