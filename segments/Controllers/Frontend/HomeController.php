<?php

namespace Controllers\Frontend;

use Models\Faq;
use Models\Pages;
use Models\SocialMedia;
use Models\Subscription;

class HomeController
{
    public function index()
    {
        $pages = Pages::get();
        $plans = Subscription::get();
        $faqs = Faq::get();
        $social_icons = SocialMedia::get();
        return render('frontend/home', [
            'pages' => $pages,
            'plans' => $plans,
            'faqs' => $faqs,
            'social_icons' => $social_icons
        ]);
    }
}