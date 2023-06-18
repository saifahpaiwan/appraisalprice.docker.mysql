@extends('layouts.auth')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('/favicon.ico') }}" height="50">
                    <h4>Welcome</h4>
                    @if (Route::has('login'))
                    <div>
                        @auth
                        <a href="{{ url('/home') }}" class="btn btn-dark waves-effect width-md waves-light ml-2">Home</a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-dark waves-effect width-md waves-light ml-2">Log in</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-dark waves-effect width-md waves-light ml-2">Register</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection