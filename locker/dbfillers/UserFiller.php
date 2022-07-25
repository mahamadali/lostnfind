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
			'expiration_date' => null,
			'role_id' => 1
		]);

		$user->role_id = Role::where('name', 'admin')->first()->id;
		$user->save();

	}
};