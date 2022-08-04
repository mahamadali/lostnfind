<?php

namespace Controllers\User;

use Bones\Request;
use Bones\Session;

class TransactionController
{
	public function index(Request $request)
	{
        $totalTransactions = count(user()->transactions()->get());
		return render('backend/user/transactions', [
            'totalTransactions' => $totalTransactions
		]);
	}
}