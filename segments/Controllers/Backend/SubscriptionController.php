<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Category;
use Models\Subscription;

class SubscriptionController
{
	public $categories;

	public function __construct()
    {
        $this->categories = Category::where('status', 'active')->get();
    }
	
	public function index(Request $request)
	{
		$subscriptions = Subscription::orderBy('id')->get();

		return render('backend/admin/subscriptions/list', [
			'subscriptions' => $subscriptions
		]);
	}

	public function create()
	{
		return render('backend/admin/subscriptions/create', ['categories' => $this->categories]);
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:60',
            'description' => 'required',
            'price' => 'required',
			'renew_price' => 'required',
            'days' => 'required',
			'category_id' => 'required'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$data = $request->getOnly(['title', 'description', 'price', 'renew_price', 'days', 'category_id']);

		$subscription = Subscription::create($data);

		if (!empty($subscription)) {
			return redirect(route('admin.subscriptions.list'))->withFlashSuccess('Subscription plan created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, Subscription $subscription)
	{
		return render('backend/admin/subscriptions/edit', [
			'subscription' => $subscription,
			'categories' => $this->categories
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:60',
            'description' => 'required',
            'price' => 'required',
			'renew_price' => 'required',
            'days' => 'required',
			'category_id' => 'required'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$data = $request->getOnly(['title', 'description', 'price', 'renew_price', 'days', 'category_id']);

		if (Subscription::where('id', $request->id)->update($data)) {
			return redirect()->withFlashSuccess('Subscription updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

	public function delete(Request $request, Subscription $subscription)
	{
		if (!empty($subscription)) {
			Subscription::where('id', $subscription->id)->delete();
			return redirect()->withFlashError('Subscription deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}
}
