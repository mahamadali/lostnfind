<?php

namespace Controllers\Frontend;

use Bones\Alert;
use Bones\Request;
use Mail\WelcomeEmail;
use Models\Category;
use Models\Faq;
use Models\Pages;
use Models\SocialMedia;
use Models\Subscription;
use Models\User;

class HomeController
{
    public function index()
    {
        $pages = Pages::get();
        $plans = Subscription::get();
        $faqs = Faq::get();
        $social_icons = SocialMedia::get();
        $categories = Category::where('status', 'Active')->get();
        return render('frontend/home', [
            'pages' => $pages,
            'plans' => $plans,
            'faqs' => $faqs,
            'social_icons' => $social_icons,
            'categories' => $categories
        ]);
    }

    public function page(Request $request, Pages $cms)
    {
        return render('frontend/cms/page', [
            'cmsPage' => $cms,
        ]);
    }
}