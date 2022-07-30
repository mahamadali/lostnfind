<?php

namespace Bones\Skeletons\DBFiller;

use Bones\Database;

return new class
{
	protected $table = 'categories';

	public function fill()
	{
		Database::__insertMulti([
			[
				'title' => 'Pets',
				'prefix' => 'PET'
			],
			[
				'title' => 'Keys',
				'prefix' => 'KEY'
			],
			[
				'title' => 'Bikes',
				'prefix' => 'BIK'
			],
			[
				'title' => 'Luggage',
				'prefix' => 'LUG'
			],
		], null, $this->table);
	}

};