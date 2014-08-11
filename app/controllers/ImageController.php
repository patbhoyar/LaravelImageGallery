<?php

class ImageController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
            $availableImages = Image::lists('id');
            if (in_array($id, $availableImages)) {
                    $img = Image::find($id);
                    $comments = Image::find($id)->comments;
                    if (is_null($comments)) {
                            $comments = "";
                    }
                    $likes = Image::find($id)->likes;
                    if (is_null($likes)) {
                            $likes = 0;
                    }else{
                            $likes = $likes->likes;
                    }
                    return View::make('images.show', array('img' => $img, 'comments' => $comments, 'likes' => $likes, 'imageIds' => $availableImages));
            }else{
                    return View::make('images.show');
            }
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
		try {
			$img = Image::find($id);
			
			if (!is_null($img)) {
				$img->delete();
				return Redirect::to('/')->with('msg', '1 Image deleted successfully');
			}else{
				return Redirect::to('/')->with('msg', 'Could not find Image');
			}

		} catch (Exception $e) {
			print_r($e);
		}
	}

}