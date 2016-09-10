@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ config('app.name', 'Laravel') }}</div>

                <div class="panel-body">
                    Welcome to Notes!

                    <hr>

                    @if (Auth::guest())
                        <a href="{{ url('/register') }}">Join</a> the website, or <a href="{{ url('/login') }}">sign in</a> if you already have an account.
                    @else
                        <a href="{{ url('/home') }}">View your notes</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
