<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Faq;

class FaqController
{
	public function index(Request $request)
	{
		$faqs = Faq::orderBy('id')->get();

		return render('backend/admin/faq/list', [
			'faqs' => $faqs
		]);
	}

	public function create()
	{
		return render('backend/admin/faq/create');
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

		$faqData = $request->getOnly(['title','description']);

		$faq = Faq::create($faqData);

		if (!empty($faq)) {
			$faq->save();
			return redirect(route('admin.faq.list'))->withFlashSuccess('Faq created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, Faq $faq)
	{
		return render('backend/admin/faq/edit', [
			'faq' => $faq
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

		$faqData = $request->getOnly(['title','description']);

		if (Faq::where('id', $request->id)->update($faqData)) {
			return redirect()->withFlashSuccess('Faq updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

	public function delete(Request $request, Faq $faq)
	{
		if (!empty($faq)) {
			Faq::where('id', $faq->id)->delete();
			return redirect()->withFlashError('Faq deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}
}