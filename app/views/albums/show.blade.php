@extends('master')

<?php $pageTitle = $album->albumName; ?>

@section('content')

	{{ $album->albumDesc }}
        
        <div class="buttons"><a href="{{ URL::to('/album/upload',$album->id) }}">Add Images</a></div>

	<div id="albumImagesContainer">
		@foreach($images as $image)

			<?php $imgInfo = Util::getNewDimensions(asset($image->imgLocation)); ?>
			<div class="thumbContainer">
				<a href="{{ URL::to('/album/'.$album->id.'/images',$image->id) }}"><img src='{{asset($image->imgLocation)}}' width='{{ $imgInfo['width']/10 }}' height='{{ $imgInfo['height']/10 }}' style="margin-top:{{ $imgInfo['top']/10 }}px;margin-left:{{ $imgInfo['left']/10 }}px;"/></a>
			</div>
		@endforeach
	</div>

@stop