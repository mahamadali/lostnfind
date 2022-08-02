<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'pages';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->longText('description')->modify();
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->text('description')->modify();
			return $table;
		});
	}

};
