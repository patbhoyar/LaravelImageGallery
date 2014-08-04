@extends('master')

@section('content')

	{{ Form::open(array('url' => '/album/create', 'method' => 'post')) }}

	{{ Form::text('albumName', '', array('placeholder' => 'Album Name')) }} <br>
	{{ Form::text('albumDesc', '', array('placeholder' => 'Album Description')) }} <br>
	{{ Form::submit('Create Album') }}

	{{ Form::close() }}


	<div id="allAlbums">
		@foreach($albums as $album)
			<div class="album">
				<div class="albumName">{{ $album->albumName }}</div>
				<div class="albumPic"><a href="{{ URL::to('/album/show',$album->id) }}"><img src="{{asset($album->albumCover)}}" alt="" width='175' height='110'></a></div>
				<div class="albumDesc">{{ $album->albumDesc }}</div>
			</div>
		@endforeach
	</div>

@stop