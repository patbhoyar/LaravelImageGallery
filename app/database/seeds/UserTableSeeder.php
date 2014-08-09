<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'email'    => 'test@test.com',
			'password' => Hash::make('awesome'),
		));
	}

}
