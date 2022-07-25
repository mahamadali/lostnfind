<?php

namespace Bones\Skeletons\DBFiller;

use Models\Role;

return new class
{
	public function fill()
	{
		Role::insertMulti([
			[
				'name' => 'admin',
			],
			[
				'name' => 'user',
			],
		]);
	}

};