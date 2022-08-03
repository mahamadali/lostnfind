<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'newsletter';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->string('email')->unique();
			$table->enum('status', ['Active', 'Inactive'])->default('Inactive');
			$table->timestamps();
			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
