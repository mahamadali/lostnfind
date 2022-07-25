<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'renewal_mail_setting';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->unsignedInteger('days_before');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
