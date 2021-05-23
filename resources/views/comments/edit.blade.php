@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="/comments/{{ $comment->id }}" method="POST" class="col-lg-7 m-auto">
            @csrf
            @method('PUT')
                <h3>Edit comment</h3>
                <input 
                    id="post_id" 
                    name="post_id" 
                    type="hidden" 
                    class="form-control" 
                    style="font-size: 16px;"
                    value="{{ $comment->post_id }}">
                <label for="comment" style="font-size: 18px;">Comment:</label>
                <textarea 
                    id="comment" 
                    name="comment" 
                    type="text" 
                    class="form-control" 
                    style="font-size: 16px;">{{ $comment->comment }}</textarea>
                <div class="mt-2 w-100 d-flex justify-content-center">
                    <button 
                        type="submit" 
                        class="btn btn-info px-5 m-auto text-white" 
                        style="font-size: 16px;">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection