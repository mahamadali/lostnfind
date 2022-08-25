<?php

namespace Controllers\Backend;

use Bones\Alert;
use Bones\Request;
use Models\Category;
use Models\Tag;
use Models\User;
use Models\Subscription;
use Models\PurchasePlanRequest;
use Models\UserSubscription;
use Mail\PlanSubscribed;
use Mail\PlanSubscribedAdminNoty;
use Contributors\SMS\Texter;
use Models\MessageSetting;
use Models\SmsSetting;





class TagsController
{
    public $categories;
    
    public function __construct()
    {
        $this->categories = Category::where('status', 'active')->get();
    }
	public function index(Request $request)
	{
		$tags = Tag::orderBy('id')->get();

		return render('backend/admin/tags/list', [
			'tags' => $tags
		]);
	}

	public function create()
	{
		return render('backend/admin/tags/create', ['categories' => $this->categories]);
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'category_id' => 'required',
			'tag_number' => 'required|unique:tags,tag_number',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $request->is_locked = 0;
		$tagData = $request->getOnly(['category_id', 'tag_number', 'is_locked']);

		$tag = Tag::create($tagData);

		if (!empty($tag)) {
			$tag->save();
			return redirect(route('admin.tags.list'))->withFlashSuccess('Tag created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, Tag $tag)
	{
		return render('backend/admin/tags/edit', [
			'tag' => $tag,
            'categories' => $this->categories
		]);
	}

	public function update(Request $request, Tag $tag)
	{
		$validator = $request->validate([
			'category_id' => 'required',
			'tag_number' => 'required|unique:tags,tag_number,'.$tag->id,
		]);
        
		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$tag->category_id = $request->category_id;
		$tag->tag_number = $request->tag_number;
        $tag->save();

		return redirect()->withFlashSuccess('Tag updated successfully!')->with('old', $request->all())->back();
	}

	public function delete(Request $request, Tag $tag)
	{
		if (!empty($tag)) {
			$tag->delete();
			return redirect()->withFlashError('Tag deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this tag!')->back();
		}
	}

    public function import(Request $request) {
        $csv = array();
        $row = 0;
        $existing = 0;

        // check there are no errors
        if($_FILES['csv']['error'] == 0){
            $name = $_FILES['csv']['name'];
            $fileExploded = explode('.', $_FILES['csv']['name']);
            $ext = strtolower(end($fileExploded));
            $type = $_FILES['csv']['type'];
            $tmpName = $_FILES['csv']['tmp_name'];

            // check the file is a csv
            if($ext === 'csv'){
                if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                    // necessary if a large csv file
                    set_time_limit(0);

                    while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        // number of fields in the csv
                        $col_count = count($data);

                        // get the values from the csv
                        $csv[$row]['col1'] = $data[0];
                        $csv[$row]['col2'] = $data[1];

                        $category = Category::where('prefix', $data[0])->first();
                        if(!empty($category)) {
                            $tag = Tag::where('tag_number', $data[1])->first();
                            if(empty($tag)) {
                                $tag = new Tag();
                                $tag->category_id = $category->id;
                                $tag->tag_number = $data[1];
                                $tag->is_locked = 0;
                                $tag->save();
                                // inc the row
                                $row++;
                            } else {
                                $existing++;
                            }
                        }
                        
                    }
                    fclose($handle);
                }
            }
        }

        return redirect()->withFlashSuccess($row.' tags imported. '.$existing. ' tags already in system')->back();
        
    }

	public function assignToUser(Request $request, Tag $tag)
	{
		$users = User::where('role_id',2)->where('status', 'active')->get();

		

		return render('backend/admin/tags/assign-to-user', [
			'tag' => $tag,
            'users' => $users
		]);
	}


	public function storeAssignToUser(Request $request, Tag $tag)
	{
		
		$validator = $request->validate([
			'plan_type' => 'required',
		]);
        
		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		

		// $data = $request->getOnly(['title', 'description', 'price', 'renew_price', 'days', 'category_id']);

		
		
		$renew_price = $request->renew_price ?? null;
		$user_id = $request->user_id ?? '';
		$plan_type = $request->plan_type;
		$expired_date = $request->expired_date ?? null;
		
		

		$data = [];
		$data['title'] = 'Free';
		$data['description'] = $tag->category->title;

		if($plan_type == 'life_time'){
			$data['renew_price'] = null;
			$data['days'] = null;
		}elseif($plan_type == 365){
			$data['renew_price'] = $renew_price;
			$data['days'] = 365;
		}elseif($plan_type == 'custom'){
			$data['renew_price'] = $renew_price;
			$today_date = date('Y-m-d');
            $valid_to =  date("Y-m-d", strtotime($expired_date));
			$datediff = strtotime($valid_to) - strtotime($today_date);
			$date_remain = round($datediff / (60 * 60 * 24));
			$data['days'] = $date_remain;
		}

		$data['is_free'] = 1;
		$data['category_id'] = $tag->category_id;
		$subscription = Subscription::create($data);

		if(!empty($user_id)){
			$user_detail = User::where('id',$user_id)->first();
			$user_country_code = $user_detail->country_code;
			$user_contact_number = $user_detail->contact_number;
			$email = $user_detail->email;
		}else{
			$user_country_code = '';
			$user_contact_number = '';
			$email = $request->email;
		}

		
		$PurchasePlanRequest = new PurchasePlanRequest();
		$PurchasePlanRequest->email = $email;
		$PurchasePlanRequest->plan_id = $subscription->id;
		$PurchasePlanRequest->category_id = $tag->category_id;
		$PurchasePlanRequest->status = 'Active';
		$PurchasePlanRequestInfo = $PurchasePlanRequest->save();


		$userSubscription = new UserSubscription();
		$userSubscription->user_id = $PurchasePlanRequestInfo->id;
		$userSubscription->plan_id = $subscription->id;
		$userSubscription->paypal_subscr_id = null;
		$userSubscription->txn_id = null;
		$userSubscription->valid_from = date('Y-m-d h:i:s');

		if($plan_type == 'life_time'){
			$subscr_date_valid_to = null;
		}elseif($plan_type == 365){
			$subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + 365 days", strtotime(date('Y-m-d h:i:s'))));
		}elseif($plan_type == 'custom'){
			$subscr_date_valid_to =  date("Y-m-d h:i:s", strtotime($expired_date));
		}


		$userSubscription->valid_to = $subscr_date_valid_to;
		$userSubscription->paid_amount = null;
		$userSubscription->currency_code = null;
		$userSubscription->payer_name = null;
		$userSubscription->payer_email = null;
		$userSubscription->payment_status = null;
		$userSubscription->payment_method = 'Free';
		$userSubscription = $userSubscription->save();


		// $tag = Tag::where('category_id', $tag->category_id)->where('is_locked', 0)->first();
		

		$userSubscription->tag_number = $tag->tag_number;
		$userSubscription->status = 'ACTIVE';
		$userSubscription->save();

		$tag->is_locked = 1;
		$tag->save();

		Alert::as(new PlanSubscribed($userSubscription, $PurchasePlanRequestInfo, $tag))->notify();


		$template = MessageSetting::where('title','adminfreetag')->first();
        $message = $template->content;

        $messageSetting = SmsSetting::first();

		if(!empty($user_contact_number) && !empty($user_country_code)){
			try {
				Texter::to('+'.$user_country_code.' '.$user_contact_number)->body($message)->setTwilio([
					'from_number' => '+'.$messageSetting->from_no,
					'account_sid' => $messageSetting->sid,
					'auth_token' => $messageSetting->token
				])->send();
			} catch (\Throwable $th) {
				
			}
		}


		return redirect()->withFlashSuccess('Assign tag to user successfully!')->with('old', $request->all())->back();
	}

}
