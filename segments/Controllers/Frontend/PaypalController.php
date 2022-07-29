<?php

namespace Controllers\Frontend;

use Bones\Alert;
use Bones\Request;
use DateTime;
use Mail\PlanSubscribed;
use Models\Category;
use Models\PurchasePlanRequest;
use Models\Subscription;
use Models\UserSubscription;

class PaypalController
{
    public function success(Request $request)
    {
        $planRequestInfo = PurchasePlanRequest::find($request->request_id);
        $plan = $planRequestInfo->plan()->first();
        return render('frontend/payment-form/success', [
            'plan' => $plan,
            'planRequestInfo' => $planRequestInfo
        ]);
    }

    public function cancel(Request $request)
    {
        return redirect(route('purchase-plan.index', ['plan' => $request->plan_id]))->withFlashError('Payment cancelled!')->go();
    }

    public function notify(Request $request)
    {
        // $raw_post_data = file_get_contents('php://input'); 
        // file_put_contents('paypal-ipn.txt', $raw_post_data);
        //$raw_post_data = 'txn_type=subscr_eot&subscr_id=I-YRBLHR9AN7HK&last_name=Maknojiya&residence_country=US&item_name=Basic+Plan&mc_currency=USD&business=akbarbusiness121%40gmail.com&verify_sign=AaHEuBrkW8NVkk8CtsU9.JXTY.LzA42xaxae1j0y2.yY2YFFUPKfAfBg&payer_status=verified&test_ipn=1&payer_email=akbarbuyer121%40gmail.com&first_name=AkbarHusen&receiver_email=akbarbusiness121%40gmail.com&payer_id=F6DDYV68BGWU6&item_number=2&payer_business_name=test&custom=6&charset=windows-1252&notify_version=3.9&ipn_track_id=90baf9af1637e';
        $raw_post_data = 'mc_gross=100.00&protection_eligibility=Eligible&address_status=confirmed&payer_id=F6DDYV68BGWU6&address_street=1+Main+St&payment_date=23%3A54%3A47+Jul+28%2C+2022+PDT&payment_status=Completed&charset=windows-1252&address_zip=95131&first_name=AkbarHusen&mc_fee=3.98&address_country_code=US&address_name=test&notify_version=3.9&subscr_id=I-B1HF2GSLLYV5&custom=1&payer_status=verified&business=akbarbusiness121%40gmail.com&address_country=United+States&address_city=San+Jose&verify_sign=A7M8Ljn42v0jYkJjjb8.2wQEDl7EA0X9vk6CeYpginRMB-ZF-qq8XUE3&payer_email=akbarbuyer121%40gmail.com&txn_id=5VU32323JJ781353Y&payment_type=instant&payer_business_name=test&last_name=Maknojiya&address_state=CA&receiver_email=akbarbusiness121%40gmail.com&payment_fee=3.98&receiver_id=N7VQQRXX8WXVQ&txn_type=subscr_payment&item_name=Basic+Plan&mc_currency=USD&item_number=1&residence_country=US&test_ipn=1&transaction_subject=Basic+Plan&payment_gross=100.00&ipn_track_id=5ec60b407abb2';
        
        file_put_contents(locker_path('/paypal/ipn.txt'), $raw_post_data);

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
            $txn_type = $paypalInfo['txn_type']; //subscr_payment or subscr_eot 
            $planInfo = Subscription::find($paypalInfo['item_number']);
            $planIntervalInfo = getIntervalInfo($planInfo);
            $interval = $planIntervalInfo['interval']; 
            $interval_count = $planIntervalInfo['interval_count'];
            $subscr_date = date('Y-m-d H:i:s');
            $interval_unit_arr = array('D' => 'day', 'W' => 'week', 'M' => 'month', 'Y' => 'year'); 
            $interval_unit = $interval_unit_arr[$interval]; 
            $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $interval_count $interval_unit", strtotime($subscr_date))); 
            
            if(!empty($txn_type) && $txn_type == 'subscr_eot'){ 
                $subscr_id = $paypalInfo['subscr_id']; 
                $payer_name = trim($paypalInfo['first_name'].' '.$paypalInfo['last_name']); 
                $payer_email = $paypalInfo['payer_email']; 
                $item_name = $paypalInfo['item_name']; 
                $item_number = $paypalInfo['item_number']; 
                $custom = $paypalInfo['custom']; 
                $paid_amount = '0.00'; 
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
                $paid_amount =  !empty($paypalInfo['mc_gross'])?$paypalInfo['mc_gross']:0; 
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
                    if($txn_type == 'subscr_eot'){ 
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

                        Alert::as(new PlanSubscribed($userSubscription, $purchasePlanRequest))->notify();
                    }
                } else {
                    if($txn_type == 'subscr_payment' || $txn_type == 'subscr_eot'){ 
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
                        $userSubscription->save();
                        
                        $purchasePlanRequest = PurchasePlanRequest::find($userSubscription->user_id);
                        $purchasePlanRequest->status = 'Active';
                        $purchasePlanRequest->save();

                        Alert::as(new PlanSubscribed($userSubscription, $purchasePlanRequest))->notify();
                    }
                }
            } 
        } 
        die;
        
    }
}