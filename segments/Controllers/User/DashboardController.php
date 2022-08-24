<?php

namespace Controllers\User;

use Bones\Request;
use Bones\Session;
use Models\User;
use Models\Item;
use Models\AdditionalContact;

class DashboardController
{
	public function index(Request $request)
	{
		$items = count(Item::where('user_id', auth()->id)->where('status', 'Active')->get());

		$transactions = count(user()->transactions()->get());

		$contacts = count(AdditionalContact::where('user_id', auth()->id)->get());

		$userPlans = user()->transactions()->get();
		
		return render('backend/user/dashboard', [
			'items' => $items,
			'contacts' => $contacts,
			'transactions' => $transactions,
			'userPlans' => count($userPlans)
		]);
	}
}