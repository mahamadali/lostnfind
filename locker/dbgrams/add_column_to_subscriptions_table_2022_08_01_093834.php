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
			$table->unsignedBigInteger('category_id')->nullable()->after('days');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('category_id');
			return $table;
		});
	}

};
