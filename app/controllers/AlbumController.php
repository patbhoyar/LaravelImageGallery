<?php

class AlbumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            if (is_null(Util::checkUserAuth())) {
                return Redirect::to('login')->with(Util::displayError(ENG::$ERROR['LOGIN'], ENG::$POSITION['TOP']));
            }else{
                $loggedInUserId = Auth::user()->id;
		$albums = Album::where('ownerUserId', '=', $loggedInUserId)->get();
		return View::make('albums.index', array('albums' => $albums, 'x' => '$ids'));
            }
	}

	public function makeNew()
	{
            if (is_null(Util::checkUserAuth())) {
                return Redirect::to('login')->with(Util::displayError(ENG::$ERROR['LOGIN'], ENG::$POSITION['TOP']));
            }else{
		return View::make('albums.create');
            }
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
                $album->albumCover = "images/default.jpg";
                $album->ownerUserId = Auth::user()->id;
		$album->save();

		return Redirect::to('/album/show/'.$album->id);
	}

	public function upload($id)
	{
		return View::make('albums.upload', array('albumId' => $id));
	}

	public function saveFile($id)
	{
        $album = Album::find($id);
		$isAlbumCoverSet = ($album->albumCover === "images/default/jpg")?TRUE:FALSE;
                
		foreach (Input::file('photo') as $photo) {

            $filename = $photo->getClientOriginalName();
            $extension =$photo->getClientOriginalExtension();
                    $destinationPath = 'uploads';
            $uploadSuccess = $photo->move($destinationPath, $filename);

            $image = new Image();
            $image->albumId = $id;
            $image->ownerUserId = Auth::user()->id;
            $image->imgLocation = $destinationPath.'/'.$filename;
            $image->imgTitle = $filename;
            $image->imgDescription = $filename;
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

            if (self::userOwnsAlbum($id)) {
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
            }else{
                return Redirect::to('/albums')->with(Util::displayError(ENG::$ERROR['NOALBUMACCESS'], ENG::$POSITION['TOP']));
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
        $albumData = self::getAlbum($id);
        //If user owns album, album is returned, else, Redirect is returned. Hence check if an array is returned
        if(is_array($albumData))
            return View::make('albums.show', $albumData);
        else
            return $albumData;
	}
        
    public static function userOwnsAlbum($albumId){
        $loggedInUserId = Auth::user()->id;
        $ownedAlbumIds = Album::where('ownerUserId', '=', $loggedInUserId)->lists('id');
        if (in_array($albumId, $ownedAlbumIds))
            return TRUE;
        else
            return FALSE;
    }

        /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $albumData = self::getAlbum($id);
        //If user owns album, album is returned, else, Redirect is returned. Hence check if an array is returned
        if(is_array($albumData))
            return View::make('albums.edit', $albumData);
        else
            return $albumData;
	}

    public static function getAlbum($id){
        if (self::userOwnsAlbum($id)) {
            $album = Album::find($id);
            $images = Album::find($id)->images;

            return array('album' => $album, 'images' => $images);
        }else{
            return Redirect::to('/albums')->with(Util::displayError(ENG::$ERROR['NOALBUMACCESS'], ENG::$POSITION['TOP']));
        }
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $input = Input::all();
        $albumName = $input['albumName'];
        $albumDesc = $input['albumDesc'];

        $album = Album::find($id);
        $album->albumName = $albumName;
        $album->albumDesc = $albumDesc;

        if(isset($input['newAlbumCover']) && $input['newAlbumCover'] != ''){
            $albumCover = $input['newAlbumCover'];
            $albumCover = Image::find($albumCover);
            $album->albumCover = $albumCover->imgLocation;
        }

        $album->save();

        return Redirect::to('/album/show/'.$album->id);
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