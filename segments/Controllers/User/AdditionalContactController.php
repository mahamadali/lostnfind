<?php

namespace Controllers\User;

use Bones\Request;
use LDAP\Result;
use Models\Category;
use Models\User;
use Models\Item;
use Models\ItemImage;
use Models\AdditionalContact;

class AdditionalContactController
{
	public function index(Request $request)
	{
		$additionalContacts = AdditionalContact::where('user_id', auth()->id)->orderBy('id')->get();
        $totalContacts = count($additionalContacts);
        return render('backend/user/additional-contacts/index', [
			'additionalContacts' => $additionalContacts,
            'totalContacts' => $totalContacts
		]);
	}

    public function create(Request $request)
	{
		return render('backend/user/additional-contacts/create');
	}

    public function store(Request $request)
	{
        $userContacts = user()->contacts()->get();
        if(count($userContacts) >= 2) {
            return redirect(route('user.additional-contacts.index'))->withFlashError('You can not add more than 2 contacts!')->go();
        }
        $validator = $request->validate([
			'full_name' => 'required|min:2|max:60',
            'email' => 'required|email',
            'contact' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $contact = new AdditionalContact();
        $contact->email = $request->email;
        $contact->full_name = $request->full_name;
        $contact->contact = $request->contact;
        $contact->user_id = auth()->id;
        $contact->save();
        
        return redirect(route('user.additional-contacts.index'))->withFlashSuccess('Additional Contact added successfully!')->go();
	}

    public function edit(Request $request, AdditionalContact $contact)
	{
		return render('backend/user/additional-contacts/edit', [
			'contact' => $contact
		]);
	}

    public function update(Request $request, AdditionalContact $contact)
	{
		$validator = $request->validate([
			'name' => 'required|min:2|max:60',
            'category_id' => 'required',
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

        $contact->email = $request->email;
        $contact->full_name = $request->full_name;
        $contact->contact = $request->contact;
        $contact->user_id = auth()->id;
        $contact->save();

        return redirect(route('user.additional-contacts.index'))->withFlashSuccess('Additional Contact updated successfully!')->go();

    }

    public function delete(Request $request, AdditionalContact $contact) {
        $contact->delete();
        return redirect()->withFlashError('Contact deleted successfully!')->with('old', $request->all())->back();
    }
}