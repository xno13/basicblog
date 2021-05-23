@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row p-5">
            <div class="col-lg-12">
                <div class="col-lg-12 text-center">
                    <img 
                    class="py-2" 
                    src="{{ asset('images/' . $profile->profilePic) }}" 
                    style="width: 200px; height: 200px;">
                    <h1 class="py-2">{{ $profile->name }}</h1>
                </div>
            <hr>
            @if (isset(Auth::user()->id) && Auth::user()->id == $profile->id)
                <a 
                    href="/profile/{{ $profile->id }}/edit" 
                    class="float-right text-success">Edit Profile</a>
            @endif
            <h4>Email: {{ $profile->email }}</h4>
            <br>
            <h4>Phone Number: {{ $profile->phone }}</h4>
            <br>
            <h4>Mobile Number: {{ $profile->mobile }}</h4>
            <br>    
            <h4>Address: {{ $profile->address }}, {{ $profile->city }}, {{ $profile->state }}, {{ $profile->zip }}</h4>
            </div>
        </div>
    </div>
@endsection