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




