<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\RenewalMailSetting;

class RenewalMailSettingController
{
	public function index(Request $request)
	{
		$renewalmailsetting = RenewalMailSetting::orderBy('id')->first();

		return render('backend/admin/renewalmailsetting/index', [
			'renewalmailsetting' => $renewalmailsetting
		]);
	}

    public function store(Request $request)
	{

        $validator = $request->validate([
			'days_before' => 'required'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $smssetting = RenewalMailSetting::orderBy('id')->first();
        if(empty($smssetting)) {
            $smssetting = new RenewalMailSetting();
        }
        
        $smssetting->days_before = $request->days_before;
        $smssetting->save();
        return redirect(route('admin.renewalmailsetting.index'))->withFlashSuccess('Renewal Mail Setting updated!')->with('old', $request->all())->go();
	}
}