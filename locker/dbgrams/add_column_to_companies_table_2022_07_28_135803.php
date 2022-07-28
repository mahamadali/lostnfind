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
			$table->text('info')->after('address');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('info');
			return $table;
		});
	}

};
