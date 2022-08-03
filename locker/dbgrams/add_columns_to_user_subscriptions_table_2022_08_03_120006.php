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
			$table->string('tag_number')->nullable()->after('ipn_track_id');
			$table->string('status')->nullable()->after('tag_number');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('tag_number');
			$table->dropColumn('status');
			return $table;
		});
	}

};
