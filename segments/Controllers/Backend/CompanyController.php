<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\User;
use Models\Company;

class CompanyController
{
	public function index(Request $request)
	{
		$company = Company::orderBy('id')->first();

		return render('backend/admin/company/profile', [
			'company' => $company
		]);
	}

    public function store(Request $request)
	{

        $validator = $request->validate([
			'name' => 'required|min:2|max:60',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $company = Company::orderBy('id')->first();
        if(empty($company)) {
            $company = new Company();
        }

        $logoPath = null;
		if ($request->hasFile('logo')) {
			$logo = $request->files('logo');
			if (!$logo->isImage()) {
				return redirect()->withFlashError('Logo must be type of image')->with('old', $request->all())->back();
			} else {
				$uploadTo = 'assets/uploads/company-logos/';
				$uploadAs = 'company-logos-' . uniqid() . '.' . $logo->extension;
				if ($logo->save(pathWith($uploadTo), $uploadAs)) {
                    if(!empty($company->logo) && file_exists($company->logo)) {
                        unlink($company->logo);
                    }
					$logoPath = $uploadTo . $uploadAs;
                    $company->logo = $logoPath;
				} else {
					return redirect()->withFlashError('Logo upload failed!')->with('old', $request->all())->back();
				}
			}
		}

        
        $company->name = $request->name;
        $company->address = $request->address;
		$company->email = $request->email;
		$company->phone_number = $request->phone_number;
        $company->save();
        return redirect(route('admin.company.index'))->withFlashSuccess('Company profile updated!')->with('old', $request->all())->go();
	}
}