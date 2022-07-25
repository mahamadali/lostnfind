<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'categories';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->string('title')->nullable(false);
			$table->enum('status', ['active', 'inactive'])->default('active');

			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
