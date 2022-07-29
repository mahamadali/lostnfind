<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'items';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->text('description')->nullable();
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('description');
			return $table;
		});
	}

};
