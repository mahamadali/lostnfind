<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'item_images';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->string('path');
			$table->unsignedBigInteger('item_id');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
