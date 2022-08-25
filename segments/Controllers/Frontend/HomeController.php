<?php

namespace Controllers\Frontend;

use Bones\Alert;
use Bones\Request;
use Contributors\SMS\Texter;
use Mail\WelcomeEmail;
use Models\Category;
use Models\Faq;
use Models\Item;
use Models\Pages;
use Models\SocialMedia;
use Models\Subscription;
use Models\User;
use Models\NotifyItem;
use Mail\NotifyItemEmail;
use Models\MessageSetting;
use Models\SmsSetting;
use Models\Newsletter;
use Mail\NewsletterEmail;
use Models\Advertise;

class HomeController
{
    public function index()
    {
        $pages = Pages::get();
        $faqs = Faq::get();
        $social_icons = SocialMedia::get();
        $categories = Category::where('status', 'Active')->get();
        return render('frontend/home', [
            'pages' => $pages,
            'faqs' => $faqs,
            'social_icons' => $social_icons,
            'categories' => $categories
        ]);
    }

    public function pricing()
    {
        $plans = Subscription::where('title','Free','!=')->get();
        return render('frontend/pricing', [
            'plans' => $plans
        ]);
    }

    public function advertisements()
    {
        $advertises = Advertise::get();
        return render('frontend/advertises', [
            'advertises' => $advertises
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
            $transaction = $item->transaction();
            
            if(empty($transaction) || $transaction->status != 'ACTIVE') {
                $item = [];
            }
        }

        $template = MessageSetting::where('title','finditem')->first();
        if(!empty($item)){
            $search_message = str_replace("{{item}}", strtoupper($item->category->prefix),$template->content);
        }else{
            $search_message = str_replace("{{item}}", 'ITEM',$template->content);
        }
        



        return render('frontend/search-item', [
            'item' => $item,
            'search_message' => $search_message,
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
            // 'address' => 'required',
		]);
		if ($validator->hasError()) {
			return response()->json(['status' => 304, 'errors' => $validator->errors()]);
		}

        $notify = new NotifyItem();
        $notify->item_id = $item->id;
        $notify->first_name = $request->first_name;
        $notify->email = $request->email;
        $notify->country_code = $request->country_code;
        $notify->phone = $request->phone;
        // $notify->address = $request->address;
        $notify->save();

        $template = MessageSetting::where('title','findsms')->first();
        $message = str_replace("{{first_name}}", $request->first_name,$template->content);
        $message = str_replace("{{category}}", $item->category->title,$message);
        $message = str_replace("{{item}}", $item->name,$message);
        $message = str_replace("{{phone}}", "+".$request->country_code.$request->phone,$message);

        $messageSetting = SmsSetting::first();
        
        if(!empty($messageSetting)) {
            Texter::to('+'.$item->user()->country_code.' '.$item->user()->contact_number)->body($message)->setTwilio([
                'from_number' => '+'.$messageSetting->from_no,
                'account_sid' => $messageSetting->sid,
                'auth_token' => $messageSetting->token
            ])->send();
        }
        

        Alert::as(new NotifyItemEmail($item->user()->email,$item->user()->first_name,$message))->notify();
        foreach($item->user()->contacts()->get() as $contact){
            Alert::as(new NotifyItemEmail($contact->email,$item->user()->first_name,$message))->notify();
            if(!empty($messageSetting)) {
                Texter::to('+'.$item->user()->country_code.' '.$contact->contact)->body($message)->setTwilio([
                    'from_number' => '+'.$messageSetting->from_no,
                    'account_sid' => $messageSetting->sid,
                    'auth_token' => $messageSetting->token
                ])->send();
            }
        }
        return response()->json(['status' => 302, 'message' => 'Notification has been sent successfully!']);
        
        
    }

    public function newsletterStore(Request $request){

        $validator = $request->validate([
			'email' => 'required|email'
		]);
		if ($validator->hasError()) {
			return response()->json(['status' => 304, 'error' => $validator->errors()[0]]);
		}
        $checkEmail = Newsletter::where('email',$request->email)->first();
        if(!empty($checkEmail)){
            return response()->json(['status' => 304, 'error' =>'Newsletter Email already exist in this system!']);
        }

        $newsletter = new Newsletter();
        $newsletter->email =  $request->email;
        $newsletter->save();

        Alert::as(new NewsletterEmail($request->email))->notify();
        return response()->json(['status' => 200, 'message' => 'Email has been sent successfully!']);

    }

    public function verifyNewsletterEmail(Request $request,$email){
       
        $checkEmail = Newsletter::where('email',$email)->first();
        if(!empty($checkEmail)){
            if($checkEmail->status == 'Active'){
                return redirect( url('/'))->withFlashError('Already newsletter email verified!!')->with('old', $request->all())->go();
            }
        }else{
            return redirect(url('/'))->withFlashError('Newsletter Email not exist in system!!')->with('old', $request->all())->go();
        }

        $newsletter = Newsletter::where('email',$email)->first();
        $newsletter->status =  'Active';
        $newsletter->save();

        return redirect( url('/'))->withFlashSuccess('Email has been added in our newsletters successfully!!')->with('old', $request->all())->go();

    }
}