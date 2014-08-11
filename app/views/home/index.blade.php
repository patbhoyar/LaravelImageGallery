@extends('master')

<?php   
        $pageTitle = "Login";
?>

@section('content')

    
    <!-- if there are login errors, show them here -->
    @if(isset($errors) && sizeof($errors) > 0)
        <div id='errorNotifier'>
            <div class='displayLoginErrors'> {{ $errors->first('email') }}     </div>
            <div class='displayLoginErrors'> {{ $errors->first('password') }}  </div>
        </div>
    @endif

    <div id="loginContainer">
        {{ Form::open(array('url' => 'login')) }}

            <p>
                    {{ Form::label('email', 'Email Address') }}
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
            </p>

            <p>
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password') }}
            </p>

            <p>{{ Form::submit('Submit!') }}  {{ HTML::link('/register', ' or Sign Up!', array('class' => 'colorGrey, size14'))}}</p>
    {{ Form::close() }}
    </div>
    
@stop