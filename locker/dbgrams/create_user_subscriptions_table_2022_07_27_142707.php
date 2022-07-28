<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'user_subscriptions';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('plan_id');
			$table->string('payment_method');
			$table->string('paypal_subscr_id');
			$table->string('txn_id')->nullable();
			$table->string('subscr_interval');
			$table->string('subscr_interval_count');
			$table->string('valid_from');
			$table->string('valid_to');
			$table->decimal('paid_amount', 10, 2);
			$table->string('currency_code');
			$table->string('payer_name')->nullable();
			$table->string('payer_email');
			$table->string('payment_status');
			$table->string('ipn_track_id');
			$table->timestamps();
			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
