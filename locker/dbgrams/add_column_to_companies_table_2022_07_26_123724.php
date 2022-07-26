<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'companies';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->string('email')->after('address');
			$table->string('phone_number')->after('email');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('email');
			$table->dropColumn('phone_number');
			return $table;
		});
	}

};
