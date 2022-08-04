<?php
use Models\Company;
use Models\Pages;
use Models\SocialMedia;
use Models\User;

if (! function_exists('generateOTP')) {
    /**
     * generate an OTP
     * @param int $length
     * @return string
     */
    function generateOTP($length = 4)
    {
        if(setting('app.stage', 'local') == 'local') {
            return implode('', range(1, $length));
        }
        else {
            return sprintf('%0'.$length.'d', mt_rand(1, str_repeat('9', $length)));
        }
    }
}

if (! function_exists('auth')) {
    function auth()
    {
        return session()->get('auth');
    }
}

if (! function_exists('user')) {
    function user()
    {
        $user = User::find(session()->get('auth')->id);
        return $user;
    }
}

if (! function_exists('old')) {
    function old($element)
    {
        if (!empty(session()->has('old'))) {
            $formData = session()->get('old');
            $old = (!empty($formData) && !empty($formData[$element])) ? $formData[$element] : null;
            $formData[$element] = null;
            session()->set('old', $formData);
            return $old;
        }

        return '';
        
    }
}

if (! function_exists('clearOld')) {
    function clearOld()
    {
        session()->remove('old');
    }
}

if (! function_exists('sendMail')) {
    function sendMail($to, $subject, $body)
    {
        $head = implode("\r\n", [
            "MIME-Version: 1.0",
            "Content-type: text/html; charset=utf-8"
        ]);

        mail($to, $subject, $body, $head);
    }
}

if (! function_exists('company')) {
    function company()
    {
        $company = Company::orderBy('id')->first();
        return $company;
    }
}

if (! function_exists('keyNumber')) {
    function keyNumber($length)
    {
        $random_string = '';
        for($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }
    
        return strtoupper($random_string);
    }
}

if (! function_exists('dd')) {
    function dd($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }
}

if (! function_exists('pages')) {
    function pages()
    {
        return Pages::get();
    }
}

if (! function_exists('social_icons')) {
    function social_icons()
    {
        return SocialMedia::get();
    }
}

if (! function_exists('getIntervalInfo')) {
    function getIntervalInfo($plan)
    {
        $days = $plan->days;
        switch ($days) {
            case '365':
                $response['interval'] = 'Y';
                $response['interval_count'] = 1;
                break;
            case '30':
                $response['interval'] = 'M';
                $response['interval_count'] = 1;
                break;
            case '7':
                $response['interval'] = 'W';
                $response['interval_count'] = 1;
                break;
            
            default:
                $response['interval'] = 'Y';
                $response['interval_count'] = 1;
                break;
        }
        return $response;
    }
}

if (! function_exists('userCategories')) {
    function userCategories()
    {
        $user_requested_plans = user()->requested_plans();
        $categories = [];
        foreach($user_requested_plans as $user_requested_plan) {
            $categories[] = $user_requested_plan->category()->first();
        }
        return $categories;
    }
}

if (! function_exists('ApiSubscriptionDetail')) {
    function ApiSubscriptionDetail($subscr_id)
    {

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, setting('paypal.api_endpoint').$subscr_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $token = base64_encode(setting('paypal.client_id').':'.setting('paypal.secret'));
        $headers[] = 'Authorization: Basic '.$token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($response);
    }
}

if (! function_exists('daysDiff')) {
    function daysDiff($your_date)
    {

        $now = time(); // or your date as well
        $your_date = strtotime($your_date);
        $datediff = $now - $your_date;

        return round($datediff / (60 * 60 * 24));
        
    }
}

if (! function_exists('renew_subscription')) {
    function renew_subscription($subscription)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, setting('paypal.api_endpoint').$subscription->paypal_subscr_id.'/activate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"reason\": \"Reactivating the subscription\"\n}");

        $headers = array();

        $headers[] = 'Content-Type: application/json';
        $token = base64_encode(setting('paypal.client_id').':'.setting('paypal.secret'));
        $headers[] = 'Authorization: Basic '.$token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $response = json_decode($result);
        return $response;
    }
}

if (! function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($phoneNumber) {
        $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);
    
        if(strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);
    
            $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
        }
        else if(strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);
    
            $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
        }
        else if(strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);
    
            $phoneNumber = $nextThree.'-'.$lastFour;
        }
    
        return $phoneNumber;
    }
}




