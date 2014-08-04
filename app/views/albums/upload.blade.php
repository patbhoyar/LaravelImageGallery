@extends('master')

@section('content')

	{{ Form::open(array('url' => URL::to('/album/upload',$albumId), 'files' => true)) }}
	{{ Form::file('photo[]', array('multiple'=>true)) }}
	{{ Form::submit('Upload') }}
	{{ Form::close() }}

@stop