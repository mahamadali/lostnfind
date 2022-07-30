<?php

namespace Bones\Skeletons\DBFiller;

use Models\User;

return new class
{
	public function fill()
	{
		User::create([
			'first_name' => 'super',
			'last_name' => 'admin',
			'email' => 'admin@admin.com',
			'password' => md5('secret'),
			'expiration_date' => null,
			'contact_number' => null,
			'logo' => null,
			'role_id' => 1
		]);

	}
};