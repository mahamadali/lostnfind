<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\MessageSetting;

class messagesettingController
{
	public function index(Request $request)
	{
		$messagesetting = MessageSetting::orderBy('id')->first();

		return render('backend/admin/messagesetting/index', [
			'messagesetting' => $messagesetting
		]);
	}

    public function store(Request $request)
	{

        $validator = $request->validate([
			'content' => 'required'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $messagesetting = MessageSetting::orderBy('id')->first();
        if(empty($messagesetting)) {
            $messagesetting = new MessageSetting();
        }
        
        $messagesetting->content = $request->content;
        $messagesetting->save();
        return redirect(route('admin.messagesetting.index'))->withFlashSuccess('Message Setting updated!')->with('old', $request->all())->go();
	}
}