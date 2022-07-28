<?php

namespace Controllers\User;

use Bones\Request;
use Bones\Session;

class TransactionController
{
	public function index(Request $request)
	{
        $transactions = user()->transactions();
        
        $totalTransactions = count($transactions->get());
		return render('backend/user/transactions', [
			'transactions' => $transactions,
            'totalTransactions' => $totalTransactions
		]);
	}
}