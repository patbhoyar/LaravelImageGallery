@extends('master')

<?php $pageTitle = "Sign Up"; ?>

@section('content')

    {{ Form::open(array('url' => 'register')) }}
            
            <!-- if there are login errors, show them here -->
            <p>
                    {{ $errors->first('email') }}
                    {{ $errors->first('password') }}
            </p>

            <p>
                    {{ Form::label('email', 'Email Address') }}
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'xyz@abc.com')) }}
            </p>

            <p>
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password') }}
            </p>

            <p>{{ Form::submit('Register!') }}</p>
    {{ Form::close() }}
@stop