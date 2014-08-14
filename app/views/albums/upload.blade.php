@extends('master')

@section('content')

	{{ Form::open(array('url' => URL::to('/album/upload',$albumId), 'files' => true)) }}
	{{ Form::file('photo[]', array('multiple'=>true)) }}
	{{ Form::submit('Upload') }}
	{{ Form::close() }}

@stop





@if(isset($pageType) && ($pageType == 'album))
<div id="albumModifyContainer">
    <div id="albumEdit">
        {{ HTML::link('/album/albumId/edit', 'Edit') }}
    </div>
    <div id="albumAddImages">
        <div class="buttons"><a href="{{ URL::to('/album/upload',$albumId) }}">Add Images</a></div>
    </div>
</div>
@endif