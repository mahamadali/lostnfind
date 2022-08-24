<?php

namespace Controllers\Frontend;

use Bones\Alert;
use Bones\Request;
use DateTime;
use Mail\PlanSubscribed;
use Mail\PlanSubscribedAdminNoty;
use Models\Category;
use Models\PurchasePlanRequest;
use Models\Subscription;
use Models\Tag;
use Models\UserSubscription;
use Mail\PlanRenew;

class PaypalController
{
    public function success(Request $request)
    {
      
        $planRequestInfo = PurchasePlanRequest::find($request->request_id);
        $plan = $planRequestInfo->plan()->first();
        $subscr_date = date('Y-m-d H:i:s');
        $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $plan->days days", strtotime($subscr_date)));

        $subscription_availbale = UserSubscription::where('user_id',$request->request_id)->first();
        if(empty($subscription_availbale)){

            $userSubscription = new UserSubscription();
            $userSubscription->user_id = $request->request_id;
            $userSubscription->plan_id = $request->plan_id;
            $userSubscription->paypal_subscr_id = $request->PayerID;
            $userSubscription->txn_id = $request->txn_id;
            $userSubscription->valid_from = $subscr_date;
            $userSubscription->valid_to = $subscr_date_valid_to;
            $userSubscription->paid_amount = $request->payment_gross;
            $userSubscription->currency_code = $request->mc_currency;
            $userSubscription->payer_name = $request->first_name.' '.$request->last_name;
            $userSubscription->payer_email = $request->payer_email;
            $userSubscription->payment_status = $request->payment_status;
            $userSubscription->payment_method = 'paypal';
            $userSubscription = $userSubscription->save();
            
            $purchasePlanRequest = PurchasePlanRequest::find($request->request_id);
            $purchasePlanRequest->status = 'Active';
            $purchasePlanRequest->save();

            $tag = Tag::where('category_id', $purchasePlanRequest->category_id)->where('is_locked', 0)->first();
            $tag->is_locked = 1;
            $tag->save();

            $userSubscription->tag_number = $tag->tag_number;
            $userSubscription->status = 'ACTIVE';
            $userSubscription->save();

            Alert::as(new PlanSubscribed($userSubscription, $purchasePlanRequest, $tag))->notify();
            Alert::as(new PlanSubscribedAdminNoty($userSubscription, $purchasePlanRequest))->notify();

            return render('frontend/payment-form/success', [
                'plan' => $plan,
                'planRequestInfo' => $planRequestInfo
            ]);

        }else{
            $cur_date = date('Y-m-d H:i:s');
            $valid_to =  $subscription_availbale->valid_to;

            $datediff = strtotime($valid_to) - strtotime($cur_date);
            $day_remain = round($datediff / (60 * 60 * 24));
            $days_increment = $day_remain + $plan->days;

            $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $days_increment days", strtotime($cur_date)));
            
            $subscription_availbale->paypal_subscr_id = $request->PayerID;
            $subscription_availbale->valid_to = $subscr_date_valid_to;
            $subscription_availbale->txn_id = $request->txn_id;
            $subscription_availbale->paid_amount = $request->payment_gross;
            $subscription_availbale->status = 'ACTIVE';
            $subscription_availbale->save();

            return render('frontend/payment-form/success', [
                'plan' => $plan,
                'planRequestInfo' => $planRequestInfo
            ]);
        }
       

        
    }

    public function cancel(Request $request)
    {
        return redirect(route('purchase-plan.index', ['plan' => $request->plan_id]))->withFlashError('Payment cancelled!')->go();
    }

    public function notify(Request $request)
    {

        exit;
        $raw_post_data = file_get_contents('php://input');
        file_put_contents('ak.txt', $raw_post_data); 
        // file_put_contents('paypal-ipn.txt', $raw_post_data);
        //$raw_post_data = 'amount3=20.95&address_status=confirmed&subscr_date=03%3A37%3A30+Aug+03%2C+2022+PDT&payer_id=PRMKM77KHA6CJ&address_street=1+Main+St&mc_amount3=20.95&charset=windows-1252&address_zip=95131&first_name=Ak&reattempt=1&address_country_code=US&address_name=Ak+Husen&notify_version=3.9&subscr_id=I-W4F73S6TSN2W&custom=2&payer_status=verified&business=akbarbusiness121%40gmail.com&address_country=United+States&address_city=San+Jose&verify_sign=AFd.erwt7VoeoUMr85yut0RloHozAkTVXPeTuoOFj11nZm8NOV3zwUfP&payer_email=akbar-buyer%40gmail.com&last_name=Husen&address_state=CA&receiver_email=akbarbusiness121%40gmail.com&recurring=1&txn_type=subscr_signup&item_name=BIKE+Plan&mc_currency=USD&item_number=5&residence_country=US&test_ipn=1&period3=1+Y&ipn_track_id=78c2c2aace3a4';
        
        // file_put_contents(locker_path('/paypal/ipn.txt'), $raw_post_data);

        /* 
        * Read POST data 
        * reading posted data directly from $_POST causes serialization 
        * issues with array data in POST. 
        * Reading raw POST data from input stream instead. 
        */
        $raw_post_array = explode('&', $raw_post_data); 
        $myPost = array(); 
        foreach ($raw_post_array as $keyval) { 
            $keyval = explode ('=', $keyval); 
            if (count($keyval) == 2) 
                $myPost[$keyval[0]] = urldecode($keyval[1]); 
        }
        
        // Read the post from PayPal system and add 'cmd' 
        $req = 'cmd=_notify-validate'; 
        foreach ($myPost as $key => $value) { 
            $value = urlencode($value); 
            $req .= "&$key=$value"; 
        } 
        
        /* 
        * Post IPN data back to PayPal to validate the IPN data is genuine 
        * Without this step anyone can fake IPN data 
        */ 
        $paypalURL = setting('paypal.paypal_url'); 
        $ch = curl_init($paypalURL); 
        if ($ch == FALSE) { 
            return FALSE; 
        } 
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
        curl_setopt($ch, CURLOPT_SSLVERSION, 6); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
        
        // Set TCP timeout to 30 seconds 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name')); 
        $res = curl_exec($ch); 

        /* 
        * Inspect IPN validation result and act accordingly 
        * Split response headers and payload, a better way for strcmp 
        */  
        $tokens = explode("\r\n\r\n", trim($res)); 
        $res = trim(end($tokens)); 
        
        if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) { 
            
            // Retrieve transaction data from PayPal 
            // $paypalInfo = $_POST; 
            
            $paypalInfo = $myPost;
            $ipn_track_id = $paypalInfo['ipn_track_id']; 
            $txn_type = $paypalInfo['txn_type']; //subscr_payment or subscr_signup 
            $planInfo = Subscription::find($paypalInfo['item_number']);
            $planIntervalInfo = getIntervalInfo($planInfo);
            $interval = $planIntervalInfo['interval']; 
            $interval_count = $planIntervalInfo['interval_count'];
            $subscr_date = date('Y-m-d H:i:s');
            $interval_unit_arr = array('D' => 'day', 'W' => 'week', 'M' => 'month', 'Y' => 'year'); 
            $interval_unit = $interval_unit_arr[$interval]; 
            $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $interval_count $interval_unit", strtotime($subscr_date))); 
            
            if(!empty($txn_type) && ($txn_type == 'subscr_signup' || $txn_type == 'subscr_eot')){ 
                $subscr_id = $paypalInfo['subscr_id']; 
                $payer_name = trim($paypalInfo['first_name'].' '.$paypalInfo['last_name']); 
                $payer_email = $paypalInfo['payer_email']; 
                $item_name = $paypalInfo['item_name']; 
                $item_number = $paypalInfo['item_number']; 
                $custom = $paypalInfo['custom']; 
                $paid_amount = $paypalInfo['amount3'] ?? 0.00; 
                $currency_code = $paypalInfo['mc_currency']; 
                $payment_status = !empty($paypalInfo['payment_status'])?$paypalInfo['payment_status']:'';
                $txn_id = ''; 
            }else {
                $subscr_id = $paypalInfo['subscr_id']; 
                $payer_name = trim($paypalInfo['first_name'].' '.$paypalInfo['last_name']); 
                $payer_email = $paypalInfo['payer_email']; 
                $item_name = $paypalInfo['item_name']; 
                $item_number = $paypalInfo['item_number']; 
                $custom = $paypalInfo['custom']; 
                $paid_amount =  !empty($paypalInfo['amount3'])?$paypalInfo['amount3'] : 0.00; 
                $currency_code = $paypalInfo['mc_currency']; 
                $payment_status = !empty($paypalInfo['payment_status'])?$paypalInfo['payment_status']:''; 
                
                $txn_id = !empty($paypalInfo['txn_id'])?$paypalInfo['txn_id']:''; 
                $subscr_date = !empty($paypalInfo['payment_date'])?$paypalInfo['payment_date']:date("Y-m-d H:i:s"); 
                $dt = new DateTime($subscr_date); 
                $subscr_date = $dt->format("Y-m-d H:i:s"); 
                
            } 
            
            if(!empty($ipn_track_id)){ 
                // Check if transaction data exists with the same TXN ID 
                
                $userSubscription = UserSubscription::where('ipn_track_id', $ipn_track_id)->first();
                if(!empty($userSubscription)) {
                    if($txn_type == 'subscr_signup' || $txn_type == 'subscr_eot'){ 
                        $userSubscription->paypal_subscr_id = $subscr_id;
                        $userSubscription->subscr_interval = $interval;
                        $userSubscription->subscr_interval_count = $interval_count;
                        $userSubscription->valid_from = $subscr_date;
                        $userSubscription->valid_to = $subscr_date_valid_to;
                        $userSubscription->save();
                        
                    }elseif($txn_type == 'subscr_payment'){ 
                        $userSubscription->txn_id = $txn_id;
                        $userSubscription->payment_status = $payment_status;
                        $userSubscription->save();

                        $purchasePlanRequest = PurchasePlanRequest::find($userSubscription->user_id);
                        $purchasePlanRequest->status = 'Active';
                        $purchasePlanRequest->save();

                        $tag = Tag::where('category_id', $purchasePlanRequest->category_id)->where('is_locked', 0)->first();
                        $tag->is_locked = 1;
                        $tag->save();

                        $userSubscription->tag_number = $tag->tag_number;
                        $userSubscription->save();

                        Alert::as(new PlanSubscribed($userSubscription, $purchasePlanRequest, $tag))->notify();
                        
                        Alert::as(new PlanSubscribedAdminNoty($userSubscription, $purchasePlanRequest))->notify();
                    }
                } else {
                    if($txn_type == 'subscr_payment' || $txn_type == 'subscr_signup' || $txn_type == 'subscr_eot'){ 
                        // Insert transaction data into the database 
                        
                        $userSubscription = new UserSubscription();
                        $userSubscription->user_id = $custom;
                        $userSubscription->plan_id = $item_number;
                        $userSubscription->paypal_subscr_id = $subscr_id;
                        $userSubscription->txn_id = $txn_id;
                        $userSubscription->subscr_interval = $interval;
                        $userSubscription->subscr_interval_count = $interval_count;
                        $userSubscription->valid_from = $subscr_date;
                        $userSubscription->valid_to = $subscr_date_valid_to;
                        $userSubscription->paid_amount = $paid_amount;
                        $userSubscription->currency_code = $currency_code;
                        $userSubscription->payer_name = $payer_name;
                        $userSubscription->payer_email = $payer_email;
                        $userSubscription->payment_status = $payment_status;
                        $userSubscription->ipn_track_id = $ipn_track_id;
                        $userSubscription->payment_method = 'paypal';
                        $userSubscription = $userSubscription->save();
                        
                        $purchasePlanRequest = PurchasePlanRequest::find($userSubscription->user_id);
                        $purchasePlanRequest->status = 'Active';
                        $purchasePlanRequest->save();

                        $tag = Tag::where('category_id', $purchasePlanRequest->category_id)->where('is_locked', 0)->first();
                        $tag->is_locked = 1;
                        $tag->save();

                        $userSubscription->tag_number = $tag->tag_number;
                        $userSubscription->status = 'ACTIVE';
                        $userSubscription->save();

                        Alert::as(new PlanSubscribed($userSubscription, $purchasePlanRequest, $tag))->notify();
                        Alert::as(new PlanSubscribedAdminNoty($userSubscription, $purchasePlanRequest))->notify();
                    }
                }
            } 
        } 
        die;
        
    }

    public function update(Request $request) {
        $userSubscriptions = UserSubscription::get();
        foreach($userSubscriptions as $userSubscription) {
            $subscr_id = $userSubscription->paypal_subscr_id;
            $subscription_details = ApiSubscriptionDetail($subscr_id);
            if(!empty($subscription_details)) {
                $userSubscription->status = $subscription_details->status;
                if($subscription_details->status != 'ACTIVE') {
                    $userSubscription->valid_to = date('Y-m-d H:i:s');
                } else if($subscription_details->status == 'EXPIRED') {
                    $planRequested = $userSubscription->plan_requested_info();
                    $planRequested->status = 'INACTIVE';
                    $planRequested->save();
                }
                $userSubscription->save();
            }
        }
        exit;
    }

    public function reactivate(Request $request, UserSubscription $usersubscription) {
        
        $response = renew_subscription($usersubscription);
        if(isset($response->debug_id)) {
            return redirect()->withFlashError($response->message)->back();
        }
        $newDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$usersubscription->subscr_interval_count.' years'));
        $usersubscription->valid_to = $newDate;
        $usersubscription->status = 'ACTIVE';
        $usersubscription->save();

        return redirect(route('user.my-plans.index'))->withFlashSuccess('Plan will reactivate soon.')->go();

    }


    public function checkRenewPlanCron(Request $request) {
        $userSubscriptions = UserSubscription::get();
        foreach($userSubscriptions as $userSubscription) {

            if($userSubscription->status == 'ACTIVE') {
                $today_date = date('Y-m-d H:i:s');
                $valid_to =  date("Y-m-d H:i:s", strtotime($userSubscription->valid_to));
                $before_ten_days_valid_date = date("Y-m-d H:i:s", strtotime(" - 10 days", strtotime($valid_to)));

                if($before_ten_days_valid_date <= $today_date && $today_date <= $valid_to){
                    $datediff = strtotime($valid_to) - strtotime($today_date);
                    $date_remain = round($datediff / (60 * 60 * 24));
                    $message = 'Your plan expired in '.$date_remain.' days';

                    $planRequestInfo = PurchasePlanRequest::find($userSubscription->user_id);

                    Alert::as(new PlanRenew($userSubscription, $planRequestInfo, $message))->notify();

                }
            }
        }
    }


    public function planRenew(Request $request,$plan_req_id) {
        $planRequestInfo = PurchasePlanRequest::find($plan_req_id);
        $plan = $planRequestInfo->plan()->first();

        
        if(!empty($planRequestInfo)){
            $paypalConfig = [
                'email' => setting('paypal.paypal_id'),
                'return_url' =>  setting('paypal.paypal_return_url').'?plan_id='.$plan->id.'&request_id='.$planRequestInfo->id,
                'cancel_url' => setting('paypal.paypal_cancel_url').'?plan_id='.$plan->id,
                'notify_url' => setting('paypal.paypal_notify_url')
            ];
            $paypalUrl = setting('paypal.paypal_url');
            
            $data['cmd'] = '_xclick';
            $data['business'] = $paypalConfig['email'];
            $data['return'] = stripslashes($paypalConfig['return_url']);
            $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
            $data['notify_url'] = stripslashes($paypalConfig['notify_url']);
            $data['item_name'] = $plan->title;
            $data['item_number'] = $plan->id;
            $data['amount'] = $plan->renew_price;
            $data['currency_code'] = setting('paypal.currency');
            $data['rm'] = 2;
            $data['quantity'] = 1;
            $data['custom'] = $plan_req_id;
            $queryString = http_build_query($data);
            header('location:' . $paypalUrl . '?' . $queryString);
            // dd($paypalUrl . '?' . $queryString);
            exit();
        }
       
    }
}