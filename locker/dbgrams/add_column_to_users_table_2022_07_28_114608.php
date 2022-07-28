<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'users';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->string('username')->nullable()->after('email');
			$table->string('subscription_id')->nullable()->after('role_id');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('username');
			$table->dropColumn('subscription_id');
			return $table;
		});
	}

};
