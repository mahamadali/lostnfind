<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\SocialMedia;

class SocialmediaController
{
	public function index(Request $request)
	{
		$socialmedia = SocialMedia::orderBy('id')->get();

		return render('backend/admin/socialmedia/list', [
			'socialmedia' => $socialmedia
		]);
	}

	public function create()
	{
		return render('backend/admin/socialmedia/create');
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			// 'icon' => 'required',
			'url' => 'required'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$socialmediaData = $request->getOnly(['title','icon','url']);

		if ($request->hasFile('files')) {
            $files = $request->files('files');
			
			foreach($files as $file) {
                $uploadTo = 'assets/uploads/footermenu/';
				$path = $file['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$uploadAs = 'menu-' . uniqid() . '.' . $ext;
				
				if ($file->save(pathWith($uploadTo), $uploadAs)) {
					opd($uploadAs);
					$socialmediaData['icon'] = $uploadTo . $uploadAs;
				}
            }
		}else{
			return redirect()->withFlashError('Please upload correct icon')->with('old', $request->all())->back();
		}

		$socialmedia = SocialMedia::create($socialmediaData);

		if (!empty($socialmedia)) {
			$socialmedia->save();
			return redirect(route('admin.socialmedia.list'))->withFlashSuccess('Social media footer menu created successfully!')->go();
		} else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}
	}

	public function edit(Request $request, SocialMedia $socialmedia)
	{
		return render('backend/admin/socialmedia/edit', [
			'socialmedia' => $socialmedia
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			'icon' => 'required',
			'url' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$socialmediaData = $request->getOnly(['title','icon','url']);

		if (SocialMedia::where('id', $request->id)->update($socialmediaData)) {
			return redirect()->withFlashSuccess('Social media footer menu updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

	public function delete(Request $request, SocialMedia $socialmedia)
	{
		if (!empty($socialmedia)) {
			SocialMedia::where('id', $socialmedia->id)->delete();
			return redirect()->withFlashError('Social media footer menu deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}
}
