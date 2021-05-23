@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="m-auto rounded p-3" style="background: powderblue;">
                <div class="float-right">
                    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                    <button 
                        type="button" 
                        class="btn rounded-circle" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false">
                        &mldr;
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/posts/{{ $post->id }}/edit" class="dropdown-item">Edit Post</a>
                        
                        <form action="/posts/{{ $post->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="dropdown-item">Delete Post</button>
                        </form>
                    </div>
                    @endif
                </div>
                @foreach ($users as $user)
                        @if ($user->id == $post->user_id)
                            <a href="{{ url('profile/' . $user->id) }}" class="btn" class="">
                                <img src="{{ asset('images/'. $user->profilePic) }}" class="rounded-circle" style="width: 50px; height: 50px;">
                                <h4 class="float-right p-3">{{ $user->name }}</h4>
                            </a>
                        @endif
                    @endforeach
                <h1>{{ $post->title }}</h1>
                <small>{{ $post->created_at }}</small>
                <hr>
                <p>{{ $post->content }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 my-2">
                <h5>Comments:</h5>
            </div>
        </div>
            @foreach ($post->Comments as $comment)
                <div class="row">
                    <div class="col-lg-11 mx-auto my-1 p-1 border rounded">
                        <div class="col-lg-12 d-flex">
                            @foreach ($users as $user)
                            @if ($user->id == $comment->user_id)
                                <p class="col-lg-10 pt-2" style="font-size: 18px;">
                                    <b><a href="{{ url('profile/' . $user->id) }}" style="text-decoration: none; color: #000;">{{ $user->name }}</a></b>
                                : {{ $comment->comment }}</p>
                            @endif
                            @endforeach
                            @if (isset(Auth::user()->id) && Auth::user()->id == $comment->user_id)
                                <a href="/comments/{{ $comment->id }}/edit" class="btn text-success col-lg-1 text-right">Edit</a>
                                <form action="/comments/{{ $comment->id }}" method="POST" class="col-lg-1 text-right">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn text-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                        <small class="col-lg-12">{{ $comment->created_at }}</small>
                    </div>
                </div>
            @endforeach
            @if (Auth::user())
                <form action="/comments" method="POST" class="my-5 col-lg-11 mx-auto d-flex">
                @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="text" name="comment" class="form-control mr-2" placeholder="Comment..">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @endif
    </div>
@endsection