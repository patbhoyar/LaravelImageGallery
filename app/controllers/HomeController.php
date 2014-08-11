<?php

use \User;

class HomeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            if (!is_null(Util::checkUserAuth()))
                return Redirect::to('/albums');
            else
                return View::make('home.index');
	}

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
		//
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
        
        public function showLogin() {
            return View::make('home.index');
        }
        
        public function doLogin()
	{
            // validate the info, create rules for the inputs
            $rules = array(
                    'email'    => 'required|email', // make sure the email is an actual email
                    'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make(Input::all(), $rules);

            // if the validator fails, redirect back to the form
            if ($validator->fails()) {
                    return Redirect::to('login')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            } else {

                // create our user data for the authentication
                $userdata = array(
                        'email' 	=> Input::get('email'),
                        'password' 	=> Input::get('password')
                );

                // attempt to do the login
                if (Auth::attempt($userdata)) {
                        return Redirect::to('/albums');
                } else {	 	
                        // validation not successful, send back to form	
                        return Redirect::to('login')->with(Util::displayError(ENG::$ERROR['WREMAILPASS'], ENG::$POSITION['MIDDLE']));
                }
            }
	}
        
        public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}
        
        public function showRegister()
	{
		return View::make('home.register');
	}
        
        public function doRegister() {
            
            // validate the info, create rules for the inputs
            $rules = array(
                    'email'    => 'required|email', // make sure the email is an actual email
                    'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make(Input::all(), $rules);

            // if the validator fails, redirect back to the form
            if ($validator->fails()) {
                    return Redirect::to('register')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            } else {

                // create our user data for the authentication
                $userdata = array(
                        'email' 	=> Input::get('email'),
                        'password' 	=> Input::get('password')
                );

                $user = new User;
                $user->email = $userdata['email'];
                $user->password = Hash::make($userdata['password']);
                $user->save();
                return Redirect::to('/');
                
            }
        }

}