<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'user_subscriptions';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->unsignedBigInteger('owner_id')->nullable()->after('ipn_track_id');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('owner_id');
			return $table;
		});
	}

};
