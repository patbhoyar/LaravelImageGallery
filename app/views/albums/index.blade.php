@extends('master')

<?php $pageTitle = "My Albums"; ?>

@section('content')

	<div id="albumsContainer">
        @foreach($albums as $album)

            <?php $imgInfo = Util::getNewDimensions(asset($album->albumCover)); ?>
            <div class="album">
                <div class="albumPic">
                    <a href="{{ URL::to('/album/show',$album->id) }}">
                        <img src="{{asset($album->albumCover)}}" width='{{ $imgInfo['width']/4.5 }}' height='{{ $imgInfo['height']/4.5 }}' style="margin-top:{{ $imgInfo['top']/5 }}px;margin-left:{{ $imgInfo['left']/5 }}px;"/>
                    </a>
                </div>
                <div class="albumName">{{ $album->albumName }}</div>
                <div class="albumDesc">{{ $album->albumDesc }}</div>
            </div>
        @endforeach
	</div>

@stop