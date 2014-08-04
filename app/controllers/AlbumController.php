<?php

class AlbumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$albums = Album::all();
		return View::make('albums.index', array('albums' => $albums));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$input = Input::all();
		$albumName = $input['albumName'];
		$albumDesc = $input['albumDesc'];

		$album = new Album();
		$album->albumName = $albumName;
		$album->albumDesc = $albumDesc;
		$album->save();

		return Redirect::to('/album/show/'.$album->id);
	}

	public function upload($id)
	{
		return View::make('albums.upload', array('albumId' => $id));
	}

	public function saveFile($id)
	{
		$isAlbumCoverSet = false;
		foreach (Input::file('photo') as $photo) {

        	$filename = $photo->getClientOriginalName();
        	$extension =$photo->getClientOriginalExtension();
			$destinationPath = 'uploads';
        	$uploadSuccess = $photo->move($destinationPath, $filename);

        	$image = new Image();
        	$image->albumId = $id;
        	$image->imgLocation = $destinationPath.'/'.$filename;
        	$image->imgTitle = $destinationPath.'/'.$filename;
        	$image->imgDescription = $destinationPath.'/'.$filename;
        	$image->save();

        	if(!$isAlbumCoverSet){
        		$album = Album::find($id);
        		$album->albumCover = $destinationPath.'/'.$filename;
        		$album->save();
        		$isAlbumCoverSet = true;
        	}

        	if($uploadSuccess == false) {
	           return Response::json('error', 400);
	        }
		}
		$album = Album::find($id);
		$images = Album::find($id)->images;

		return View::make('albums.show', array('album' => $album, 'images' => $images));
	}

	public function getImages($id, $imgid){

		$album = Album::find($id);
		$images = Album::find($id)->images;

		$availableImages = array();

		foreach ($images as $image) {
			array_push($availableImages, $image->id);
		}

		if (in_array($imgid, $availableImages)) {
			$img = Image::find($imgid);
			$comments = Image::find($imgid)->comments;
			if (is_null($comments)) {
				$comments = "";
			}
			$likes = Image::find($imgid)->likes;
			if (is_null($likes)) {
				$likes = 0;
			}else{
				$likes = $likes->likes;
			}
			return View::make('images.show', array('album' => $album, 'img' => $img, 'comments' => $comments, 'likes' => $likes, 'imageIds' => $availableImages));
		}else{
			return View::make('images.show');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$album = Album::find($id);
		$images = Album::find($id)->images;

		return View::make('albums.show', array('album' => $album, 'images' => $images));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}