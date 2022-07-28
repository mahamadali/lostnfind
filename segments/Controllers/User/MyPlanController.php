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
                $plans[$key]->transaction = $planRequest->user_subscription()->first();
            }
        }
		return render('backend/user/my-plans', [
			'plans' => $plans
		]);
	}
}