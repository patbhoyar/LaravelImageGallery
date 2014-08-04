@extends('master')


@section('content')

	@if(isset($img))
		<?php 
			$imgInfo = Util::getNewDimensions(asset($img->imgLocation)); 

			$key = array_search($img->id, $imageIds);
			if ($key == 0) {
				$prev = 0;
				$next = $key + 1;
			}else if ($key == sizeof($imageIds)-1) {
				$prev = $key - 1;
				$next = $key;
			}else{
				$prev = $key - 1;
				$next = $key + 1;
			}

			$nextImage = $imageIds[$next];
			$prevImage = $imageIds[$prev];
		?>
		{{ Form::hidden('imageId', $img->id, array('id' => 'imageId')) }}
		
		<div id="theTitle">{{ $img->imgTitle }}</div>
		<div id="deleteImg">
			<img src='{{ asset("images/delete.png") }}' width='20' height='20' style="" title="Delete Image"/>
		</div>
		<div id="theImage">
			<img src='{{ asset($img->imgLocation) }}' width='{{ $imgInfo['width'] }}' height='{{ $imgInfo['height'] }}' style="margin-top:{{ $imgInfo['top'] }}px;margin-left:{{ $imgInfo['left'] }}px;"/>
		</div>
		<div id="theDescription">{{ $img->imgDescription }}</div>
		<div id="theNavigation">
			<div id="moveLeft" class='imgNav'>{{ HTML::link('/album/'.$album->id.'/images/'.$prevImage, 'Previous') }}</div>
			<div id="moveRight" class='imgNav'>{{ HTML::link('/album/'.$album->id.'/images/'.$nextImage, 'Next') }}</div>
		</div>
		<div id="theLikes">
			<div id="likeImg"> <img src='{{ asset('images/like.jpeg') }}' width='49' height='24' id="like"/> </div>
			<div id="numLikes"> <span id="likes">{{ $likes }}</span> people liked this </div>
		</div>
		<div id="theComments">
			<div id="newComment">
				{{ Form::textarea('comments', '', array('placeholder' => 'Comment...', 'id' => 'comment')) }}
				{{ Form::button('Submit', array('id' => 'submitComment')) }}
			</div>
			<div id="commentsContainer">
				@if(isset($comments))
					@foreach($comments as $comment)
						<div class="comments">
							<div class="theComment">{{ $comment->comment }}</div>
							<div class="deleteComment" data-comment="{{ $comment->id }}" title="Delete Comment">X</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	@else
		<div id="theTitle">Could Not find Image. {{ HTML::link('/', 'Go Home.') }}</div>
	@endif
@stop
