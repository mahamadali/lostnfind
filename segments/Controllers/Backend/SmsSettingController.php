<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\User;
use Models\SmsSetting;

class SmsSettingController
{
	public function index(Request $request)
	{
		$smssetting = SmsSetting::orderBy('id')->first();

		return render('backend/admin/smssetting/index', [
			'smssetting' => $smssetting
		]);
	}

    public function store(Request $request)
	{

        $validator = $request->validate([
			'sid' => 'required',
            'token' => 'required',
            'from_no' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $smssetting = SmsSetting::orderBy('id')->first();
        if(empty($smssetting)) {
            $smssetting = new SmsSetting();
        }
        
        $smssetting->sid = $request->sid;
        $smssetting->token = $request->token;
        $smssetting->from_no = $request->from_no;
        $smssetting->save();
        return redirect(route('admin.smssetting.index'))->withFlashSuccess('SMS Setting updated!')->with('old', $request->all())->go();
	}
}