<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\User;
use Models\Category;
use Models\Item;

class DashboardController
{
	public function index(Request $request)
	{
		$total_users = count(User::whereHas('role', function($query) {
			return $query->where('name', 'user');
		})->where('status', 'Active')->get());

		$total_tags = count(Category::where('status', 'Active')->get());

		$total_items = count(Item::where('status', 'Active')->get());

		return render('backend/admin/dashboard', [
			'total_users' => $total_users,
			'total_tags' => $total_tags,
			'total_items' => $total_items,
		]);
	}
}