@extends('master')

@section('content')

	@if(isset($msg))
		<div id="messages">
			<div id="theMessage"> {{ $msg }} </div>
			<div id="closeMsg">X</div>
		</div>
	@endif

	<div id="thumbnailsContainer">
		
		@foreach($images as $image)

			<?php $imgInfo = Util::getNewDimensions(asset($image->imgLocation)); ?>
			<div class="thumbContainer">
				<a href="{{ URL::to('/images/show',$image->id) }}"><img src='{{asset($image->imgLocation)}}' width='{{ $imgInfo['width']/10 }}' height='{{ $imgInfo['height']/10 }}' style="margin-top:{{ $imgInfo['top']/10 }}px;margin-left:{{ $imgInfo['left']/10 }}px;"/></a>
			</div>
		@endforeach

	</div>

	{{ $images->links() }}

@stop
