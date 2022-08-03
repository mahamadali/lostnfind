<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Advertise;

class AdvertiseController
{
	public function index(Request $request)
	{
		$advertises = Advertise::orderBy('id')->get();

		return render('backend/admin/advertise/list', [
			'advertises' => $advertises
		]);
	}

	public function create()
	{
		return render('backend/admin/advertise/create');
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			// 'image' => 'required',
			'description' => 'required'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$advertiseData = $request->getOnly(['title','image','description']);
		
		if ($request->hasFile('files')) {
            $files = $request->files('files');
            foreach($files as $file) {
                $uploadTo = 'assets/uploads/advertise/';
				$uploadAs = 'menu-' . uniqid() . '.' . $file->extension;
				if ($file->save(pathWith($uploadTo), $uploadAs)) {
					$advertiseData['image'] = $uploadTo . $uploadAs;
				}
            }
		}

		$advertise = Advertise::create($advertiseData);
		

		if (!empty($advertise)) {
			$advertise->save();
			echo json_encode(['status' => 200, 'message' => 'Advertise created successfully!']);
		} else {
			echo json_encode(['status' => 200, 'message' => 'Something went wrong!']);
		}
	}

	public function edit(Request $request, Advertise $advertise)
	{
		return render('backend/admin/advertise/edit', [
			'advertise' => $advertise
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'title' => 'required|min:2|max:30',
			// 'image' => 'required',
			'description' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$advertiseData = $request->getOnly(['title','image','description']);

		if ($request->hasFile('files')) {
            $files = $request->files('files');
            foreach($files as $file) {
                $uploadTo = 'assets/uploads/advertise/';
				$uploadAs = 'menu-' . uniqid() . '.' . $file->extension;
				if ($file->save(pathWith($uploadTo), $uploadAs)) {
					$advertiseData['image'] = $uploadTo . $uploadAs;
				}
            }
		}

		if (Advertise::where('id', $request->id)->update($advertiseData)) {
			echo json_encode(['status' => 200, 'message' => 'Advertise updated successfully!']);
		} else {
			echo json_encode(['status' => 203, 'message' => 'Something went wrong!']);
		}
	}

	public function delete(Request $request, Advertise $advertise)
	{
		if (!empty($advertise)) {
			Advertise::where('id', $advertise->id)->delete();
			return redirect()->withFlashError('Advertise deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('You have no access to delete this item!')->back();
		}
	}
}
