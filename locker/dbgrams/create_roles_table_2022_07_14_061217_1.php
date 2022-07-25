<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'roles';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->string('name')->nullable(false);
			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
