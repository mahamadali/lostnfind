<?php

namespace Controllers\Frontend;

use Bones\Request;
use Models\Category;
use Models\PurchasePlanRequest;
use Models\Subscription;

class PurchasePlanController 
{
    public function index(Request $request, Subscription $plan)
    {
        $categories = Category::where('status', 'Active')->get();
        
        return render('frontend/purchase-plan', [
            'categories' => $categories,
            'plan' => $plan
        ]);
    }

    public function process(Request $request, Subscription $plan)
    {   
        $validator = $request->validate([
			'user_email' => 'required|unique:users,email',
            'category' => 'required',
		], [
            'user_email.unique' => 'Email already exists!'
        ]);
		if ($validator->hasError()) {
			return response()->json(['status' => 304, 'errors' => $validator->errors()]);
		}
        
        $purchasePlanRequest = new PurchasePlanRequest();
        $purchasePlanRequest->email = $request->user_email;
        $purchasePlanRequest->category_id = $request->category;
        $purchasePlanRequest->plan_id = $plan->id;
        $purchasePlanRequest->save();

        return response()->json(['status' => 200]);
    }
}