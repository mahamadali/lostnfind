<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'purchase_plan_requests';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->enum('status', ['Active', 'Inactive'])->default('Inactive')->after('category_id');
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('status');
			return $table;
		});
	}

};
