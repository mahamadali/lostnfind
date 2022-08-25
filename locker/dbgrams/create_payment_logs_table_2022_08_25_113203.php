<?php

use Bones\DataWing;
use Bones\Skeletons\DataWing\Skeleton;

return new class 
{

	protected $table = 'payment_logs';

	public function arise()
	{
		DataWing::create($this->table, function (Skeleton $table)
		{
			$table->id()->primaryKey();
			$table->unsignedBigInteger('user_subscription_id');
			$table->string('paypal_id');
			$table->string('txn_id');
			$table->string('paid_amount');
			$table->string('currency_code');
			$table->string('payer_name');
			$table->string('payer_email');
			$table->string('payment_status');
			$table->string('payment_method');
			$table->timestamps();
			return $table;
		});
	}

	public function fall()
	{
		DataWing::drop($this->table);
	}

};
