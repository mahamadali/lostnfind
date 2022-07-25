<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Category;

class CategoryController
{
	public function index(Request $request)
	{
		$categories = Category::orderBy('id')->get();

		return render('backend/admin/category/list', [
			'categories' => $categories
		]);
	}

	public function create()
	{
		return render('backend/admin/category/create');
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$categoryData = $request->getOnly(['title']);

		$category = Category::create($categoryData);

		if (!empty($category)) {
			$category->save();
			return redirect(route('admin.category.list'))->withFlashSuccess('Category created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, Category $category)
	{
		return render('backend/admin/category/edit', [
			'category' => $category
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$categoryData = $request->getOnly(['title']);

		if (Category::where('id', $request->id)->update($categoryData)) {
			return redirect()->withFlashSuccess('Category updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

	public function delete(Request $request, Category $category)
	{
		if (!empty($category)) {
			Category::where('id', $category->id)->delete();
			return redirect()->withFlashError('Category deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}
}
