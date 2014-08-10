@extends('master')

<?php $pageTitle = "Create New Album"; ?>

@section('content')

{{ Form::open(array('url' => '/album/create', 'method' => 'post', 'class' => 'albumCreateForm')) }}

{{ Form::text('albumName','', array('class' => 'albumNameText', 'placeholder' => 'Album Name')) }} <br>
{{ Form::text('albumDesc', '', array('class' => 'albumDescText', 'placeholder' => 'Album Description')) }} <br>
{{ Form::submit('Create Album', array('class' => 'albumCreateSubmit')) }}
{{ Form::close() }}
@stop