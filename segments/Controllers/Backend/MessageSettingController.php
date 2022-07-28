<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\MessageSetting;

class messagesettingController
{
	public function index(Request $request)
	{
		$templates = MessageSetting::orderBy('id')->get();

		return render('backend/admin/messagesetting/list', [
			'templates' => $templates
		]);
	}

	public function create()
	{
		return render('backend/admin/messagesetting/create');
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			'content' => 'required|min:2'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$templateData = $request->getOnly(['title','content']);

		$template = MessageSetting::create($templateData);

		if (!empty($template)) {
			$template->save();
			return redirect(route('admin.messagesetting.list'))->withFlashSuccess('Template created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, MessageSetting $template)
	{
		return render('backend/admin/messagesetting/edit', [
			'template' => $template
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			'content' => 'required|min:2'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$templateData = $request->getOnly(['title','content']);

		if (MessageSetting::where('id', $request->id)->update($templateData)) {
			return redirect()->withFlashSuccess('Template updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

	public function delete(Request $request, MessageSetting $template)
	{
		if (!empty($template)) {
			MessageSetting::where('id', $template->id)->delete();
			return redirect()->withFlashError('Template deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}

}