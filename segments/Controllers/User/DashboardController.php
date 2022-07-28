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

		$planRequested = user()->requested_plan();
		$plan = [];
		if(!empty($planRequested)) {
			$plan = user()->requested_plan()->plan()->first();
		}
		
		return render('backend/user/dashboard', [
			'items' => $items,
			'contacts' => $contacts,
			'transactions' => $transactions,
			'plan' => $plan
		]);
	}
}