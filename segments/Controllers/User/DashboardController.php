<?php

namespace Controllers\User;

use Bones\Request;
use Models\User;
use Models\Item;

class DashboardController
{
	public function index(Request $request)
	{
		$items = count(Item::where('user_id', auth()->id)->where('status', 'Active')->get());

		return render('backend/user/dashboard', [
			'items' => $items,
		]);
	}
}