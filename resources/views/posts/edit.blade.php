@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="/posts/{{ $post->id }}" method="POST" class="col-lg-7 m-auto">
            @csrf
            @method('PUT')
                <h3>Edit post</h3>
                <input 
                    id="title" 
                    name="title" 
                    type="text" 
                    class="form-control" 
                    placeholder="Title.."
                    style="font-size: 16px;"
                    value="{{ $post->title }}">
                <textarea 
                    placeholder="Content.."
                    id="content" 
                    name="content" 
                    class="my-2 form-control" 
                    cols="30" 
                    rows="10"
                    style="font-size: 16px;">{{ $post->content }}</textarea>
                <div class="w-100 d-flex justify-content-center">
                    <button 
                        type="submit" 
                        class="btn btn-info px-5 m-auto text-white" 
                        style="font-size: 16px;">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection