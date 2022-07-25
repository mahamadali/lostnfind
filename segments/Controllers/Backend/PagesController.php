<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Pages;

class PagesController
{
	public function index(Request $request)
	{
		$pages = Pages::orderBy('id')->get();

		return render('backend/admin/pages/list', [
			'pages' => $pages
		]);
	}

	public function create()
	{
		return render('backend/admin/pages/create');
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			'description' => 'required|min:2'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$pageData = $request->getOnly(['title','description']);

		$page = Pages::create($pageData);

		if (!empty($page)) {
			$page->save();
			return redirect(route('admin.pages.list'))->withFlashSuccess('Page created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, Pages $page)
	{
		return render('backend/admin/pages/edit', [
			'page' => $page
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			'description' => 'required|min:2'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$pageData = $request->getOnly(['title','description']);

		if (Pages::where('id', $request->id)->update($pageData)) {
			return redirect()->withFlashSuccess('Page updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

	public function delete(Request $request, Pages $page)
	{
		if (!empty($page)) {
			Pages::where('id', $page->id)->delete();
			return redirect()->withFlashError('Page deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}
}