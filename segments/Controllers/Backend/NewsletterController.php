<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Newsletter;

class NewsletterController
{
	public function index(Request $request)
	{
		$newsletters = Newsletter::orderBy('id')->get();

		return render('backend/admin/newsletter/list', [
			'newsletters' => $newsletters
		]);
	}
}  