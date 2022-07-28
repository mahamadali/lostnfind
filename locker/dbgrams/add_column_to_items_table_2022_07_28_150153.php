<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'items';

	public function arise()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->string('breed')->after('name')->nullable();
			$table->string('preferred_pet_food')->nullable();
			$table->string('distinguishing_marks')->nullable();
			$table->text('notes')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('gender')->nullable();
			$table->string('height')->nullable();
			$table->string('weight')->nullable();
			$table->string('length')->nullable();
			$table->string('type')->nullable();
			return $table;
		});
	}

	public function fall()
	{
		DataWing::modify($this->table, function (Skeleton $table)
		{
			$table->dropColumn('breed');
			$table->dropColumn('preferred_pet_food');
			$table->dropColumn('distinguishing_marks');
			$table->dropColumn('notes');
			$table->dropColumn('date_of_birth');
			$table->dropColumn('gender');
			$table->dropColumn('height');
			$table->dropColumn('weight');
			$table->dropColumn('length');
			$table->dropColumn('type');
			return $table;
		});
	}

};
