@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user())
            <div class="row">
                <button 
                    type="button" 
                    class="btn btn-primary" 
                    data-toggle="modal" 
                    data-target="#Post">Write a post</button>

                <div 
                    class="modal fade" 
                    id="Post" 
                    tabindex="-1" 
                    role="dialog" 
                    aria-labelledby="ModalLabel" 
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Write a post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="post" action="/posts" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label 
                                            for="title" 
                                            class="col-form-label" 
                                            style="font-size: 18px;">Title:</label>
                                        <input 
                                            id="title" 
                                            name="title" 
                                            type="text" 
                                            class="form-control" 
                                            style="font-size: 16px;">
                                    </div>
                                    <div class="form-group">
                                        <label 
                                            for="message-text" 
                                            class="col-form-label"
                                            style="font-size: 18px;">Content:</label>
                                        <textarea 
                                            id="content" 
                                            name="content" 
                                            rows="5"
                                            class="my-2 form-control"
                                            style="font-size: 16px;"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button form="post" type="submit" class="btn btn-primary">Save Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr>
        @foreach ($posts as $post)
            <div class="row">
                <div class="col-lg-12 rounded p-3" style="background: rgb(193, 227, 233);">
                    @foreach ($users as $user)
                        @if ($user->id == $post->user_id)
                            <a href="profile/{{ $user->id }}" class="btn" class="">
                                <img src="{{ asset('images/'. $user->profilePic) }}" class="rounded-circle" style="width: 50px; height: 50px;">
                                <h4 class="float-right p-3">{{ $user->name }}</h4>
                            </a>
                        @endif
                    @endforeach
                    <div class="float-right">
                        <button 
                            type="button" 
                            class="btn rounded-circle" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                            &mldr;
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/posts/{{ $post->id }}" class="dropdown-item">View Post</a>
                            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                                <a href="/posts/{{ $post->id }}/edit" class="dropdown-item">Edit Post</a>
                                
                                <form action="/posts/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item">Delete Post</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    <h1>{{ $post->title }}</h1>
                    <small>{{ $post->created_at }}</small>
                    <hr>
                    <p style="font-size: 18px;">{{ $post->content }}</p>
                    <?php $i=0; ?>
                    @foreach ($post->Comments as $comment)
                        <?php $i++ ?>
                    @endforeach
                    <small>Comments: {{ $i }}</small>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection