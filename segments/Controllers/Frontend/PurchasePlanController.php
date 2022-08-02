<?php

namespace Controllers\Frontend;

use Bones\Request;
use Models\Category;
use Models\PurchasePlanRequest;
use Models\Subscription;
use Models\Tag;

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
			'user_email' => 'required',
            'category' => 'required'
		],[
            'user_email.required' => 'Email is required'
        ]);

		if ($validator->hasError()) {
			return response()->json(['status' => 304, 'errors' => $validator->errors()]);
		}

        $tag = Tag::where('category_id', $request->category)->where('is_locked', 0)->first();
        if(empty($tag)) {
            return response()->json(['status' => 301, 'message' => 'Sorry currently tag for this category is not available.']);
        }

        $checkEntryAlreadyExist = PurchasePlanRequest::where('email', $request->user_email)->where('category_id', $request->category)->first();
        
        // if(isset($checkEntryAlreadyExist->email)) {
        //     if($checkEntryAlreadyExist->status == 'Active' && $checkEntryAlreadyExist->category_id == $request->category) {
        //         $message = 'Plan is already active with this email and Category';
        //         return response()->json(['status' => 301, 'message' => $message]);
        //     }

        //     if($checkEntryAlreadyExist->status == 'Inactive') {
        //         $message = 'You already requested before, We are redirecting you to paypal...';
        //         $requestId = $checkEntryAlreadyExist->id;
        //     }

        //     if($checkEntryAlreadyExist->status == 'Active') {
        //         $purchasePlanRequest = new PurchasePlanRequest();
        //         $purchasePlanRequest->email = $request->user_email;
        //         $purchasePlanRequest->category_id = $request->category;
        //         $purchasePlanRequest->plan_id = $plan->id;
        //         $purchasePlanRequest = $purchasePlanRequest->save();
        //         $requestId = $purchasePlanRequest->id;
        //         $message = 'We are redirecting you to paypal...';
        //     }

        // } else {
            $purchasePlanRequest = new PurchasePlanRequest();
            $purchasePlanRequest->email = $request->user_email;
            $purchasePlanRequest->category_id = $request->category;
            $purchasePlanRequest->plan_id = $plan->id;
            $purchasePlanRequest = $purchasePlanRequest->save();
            $requestId = $purchasePlanRequest->id;
            $message = 'We are redirecting you to paypal...';
        // }
        
        $redirectUrl = route("purchase-plan.paypal.index", ["plan" => $plan->id, "request_id" => $requestId]);
        return response()->json(['status' => 200, 'message' => $message, 'redirectUrl' => $redirectUrl]);
    }

    public function paypalFormPage(Request $request, Subscription $plan, PurchasePlanRequest $planRequest)
    {
        $planIntervalInfo = getIntervalInfo($plan);
        
        return render('frontend/payment-form/paypal', [
            'plan' => $plan,
            'planRequest' => $planRequest,
            'planIntervalInfo' => $planIntervalInfo
        ]);
    }
}