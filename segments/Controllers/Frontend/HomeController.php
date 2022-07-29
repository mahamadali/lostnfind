<?php

namespace Controllers\Frontend;

use Bones\Alert;
use Bones\Request;
use Mail\WelcomeEmail;
use Models\Category;
use Models\Faq;
use Models\Item;
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

    public function search(Request $request) {
        
        $item = Item::where('tag_number', $request->tag)->first();
        if(!empty($item)) {
            $userRequestedPlan = $item->user()->requested_plan();
        
            if(empty($userRequestedPlan)) {
                $item = [];
            }
        }

        return render('frontend/search-item', [
            'item' => $item,
        ]);
    }

    public function provideFounderForm(Request $request, Item $item) {
        return render('frontend/provider-info-form', [
            'item' => $item,
        ]);
    }

    public function provideFounderInfoProcess(Request $request, Item $item) {
        $validator = $request->validate([
			'email' => 'required|email',
            'first_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
		]);
		if ($validator->hasError()) {
			return response()->json(['status' => 304, 'errors' => $validator->errors()]);
		}
        dd($request);
        
    }
}