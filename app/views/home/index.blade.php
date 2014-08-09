@extends('master')

<?php $pageTitle = "Login"; ?>

@section('content')

    {{ Form::open(array('url' => 'login')) }}
            
            @if(Auth::check())
                {{Auth::user()->email;}}
            @else
                Login Now Bitch!
            @endif
            
            <!-- if there are login errors, show them here -->
            <p>
                    {{ $errors->first('email') }}
                    {{ $errors->first('password') }}
            </p>

            <p>
                    {{ Form::label('email', 'Email Address') }}
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
            </p>

            <p>
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password') }}
            </p>

            <p>{{ Form::submit('Submit!') }}</p>
    {{ Form::close() }}
@stop