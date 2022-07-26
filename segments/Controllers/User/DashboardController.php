<?php

namespace Controllers\User;

use Bones\Request;
use Models\User;
use Models\Item;
use Models\AdditionalContact;

class DashboardController
{
	public function index(Request $request)
	{
		$items = count(Item::where('user_id', auth()->id)->where('status', 'Active')->get());

		$contacts = count(AdditionalContact::where('user_id', auth()->id)->get());

		return render('backend/user/dashboard', [
			'items' => $items,
			'contacts' => $contacts,
		]);
	}
}