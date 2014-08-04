@extends('master')

@section('content')

	{{ $album->albumName }}
	{{ $album->albumDesc }}

	{{ HTML::link('/album/upload/'.$album->id, 'Upload Images') }}

	<div id="albumImagesContainer">
		@foreach($images as $image)

			<?php $imgInfo = Util::getNewDimensions(asset($image->imgLocation)); ?>
			<div class="thumbContainer">
				<a href="{{ URL::to('/album/'.$album->id.'/images',$image->id) }}"><img src='{{asset($image->imgLocation)}}' width='{{ $imgInfo['width']/10 }}' height='{{ $imgInfo['height']/10 }}' style="margin-top:{{ $imgInfo['top']/10 }}px;margin-left:{{ $imgInfo['left']/10 }}px;"/></a>
			</div>
		@endforeach
	</div>

@stop