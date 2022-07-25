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
			],
			[
				'title' => 'Keys',
			],
			[
				'title' => 'Bikes',
			],
			[
				'title' => 'Luggage',
			],
		], null, $this->table);
	}

};