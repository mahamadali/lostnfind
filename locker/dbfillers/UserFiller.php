<?php

namespace Bones\Skeletons\DBFiller;

use Models\User;
use Models\Role;

return new class
{
	public function fill()
	{
		$user = User::create([
			'first_name' => 'super',
			'last_name' => 'admin',
			'email' => 'admin@admin.com',
			'password' => md5('secret'),
		]);

		$user->role_id = Role::where('name', 'admin')->first()->id;
		$user->save();

	}
};