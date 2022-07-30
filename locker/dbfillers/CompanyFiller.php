<?php

namespace Bones\Skeletons\DBFiller;

use Bones\Database;

return new class
{
	protected $table = 'companies';

	public function fill()
	{
		Database::insert([
			'name' => 'Lost N Find',
			'logo' => null,
			'address' => 'United States',
			'info' => 'Lost N Find',
			'email' => 'info@lostnfind.com',
			'phone_number' => '9852589632',
		], $this->table);
	}

};