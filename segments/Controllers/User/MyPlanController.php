<?php

namespace Controllers\User;

use Bones\Request;
use Bones\Session;

class MyPlanController
{
	public function index(Request $request)
	{
        $plans = [];
       
		$planRequested = user()->requested_plans();
        
        
        if(count($planRequested) > 0) {
            foreach($planRequested as $key => $planRequest) {
                $plans[] = $planRequest->plan()->first();
                $transaction = $planRequest->user_subscription()->first();
                $plans[$key]->transaction = $transaction;
                
                // $plans[$key]->api_subscription = ApiSubscriptionDetail($transaction->paypal_subscr_id);
                $plans[$key]->category = $planRequest->category()->first()->title;
            }
        }
        
       
		return render('backend/user/my-plans', [
			'plans' => $plans
		]);
	}
}