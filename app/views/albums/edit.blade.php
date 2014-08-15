@extends('master')

<?php
    $pageTitle  =   'Editing "'.$album->albumName.'"';
    $pageType   =   'albumEdit';
    $albumId    =   $album->id;
?>

@section('content')

    <p>
        {{ Form::label('albumName', 'Album Name') }}
        {{ Form::text('albumName', $album->albumName, array('class' => 'albumNameText')) }}
    </p>

    <p>
        {{ Form::label('albumDesc', 'Album Description') }}
        {{ Form::text('albumDesc', $album->albumDesc, array('class' => 'albumDescText')) }}
    </p>

    <div>Select Album Cover</div>

	<div id="albumImagesContainer">
		@foreach($images as $image)

			<?php $imgInfo = Util::getNewDimensions(asset($image->imgLocation)); ?>
			<div class="thumbContainer">
				<img src='{{asset($image->imgLocation)}}' width='{{ $imgInfo['width']/10 }}' height='{{ $imgInfo['height']/10 }}' style="margin-top:{{ $imgInfo['top']/10 }}px;margin-left:{{ $imgInfo['left']/10 }}px;"/>
                <div class="cover"></div>
            </div>
		@endforeach
	</div>

@stop