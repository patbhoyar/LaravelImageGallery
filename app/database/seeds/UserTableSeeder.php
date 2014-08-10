<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'email'    => 'test@gmail.com',
			'password' => Hash::make('test'),
		));
		User::create(array(
			'email'    => 'abc@xyz.com',
			'password' => Hash::make('abc'),
		));
	}

}
