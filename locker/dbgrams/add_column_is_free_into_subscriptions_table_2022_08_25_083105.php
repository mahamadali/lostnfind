<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'subscriptions';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->unsignedBigInteger('is_free')->after('renew_price');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			return $table;
		});
	}

};
