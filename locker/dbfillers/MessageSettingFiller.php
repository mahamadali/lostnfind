<?php

namespace Bones\Skeletons\DBFiller;

use Bones\Database;

return new class
{
	protected $table = 'message_setting';

	public function fill()
	{
		Database::insert([
			'title' => 'findsms',
			'content' => '{{first_name}} just found your {{category}} {{item}} and would like you to contact them at {{phone}}',
		], $this->table);
	}

};