<?php

namespace Controllers\Backend;

use Bones\Request;
use Models\Role;
use Models\User;

class UserController
{
	public function index(Request $request)
	{
		// $users = User::where('role_id', 2)->orderBy('id')->get();
		$users = User::whereHas('role', function($query) {
			return $query->where('name', 'user');
		})->where('status', 'Active')->get();
		
		$totalUsers = count($users);
		
		return render('backend/admin/user/list', [
			'users' => $users,
			'totalUsers' => $totalUsers
		]);
	}

	public function create()
	{
		return render('backend/admin/user/create');
	}

	public function store(Request $request)
	{
		$validator = $request->validate([
			'first_name' => 'required|min:2|max:18',
			'last_name' => 'required|min:2|max:18',
			'email' => 'required|max:70|email|unique:users,email',
			'expiration_date' => 'required',
            'password' => ['required', 'min:6', 'max:12', 'eqt:confirm_password'],
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
        }

		$role = Role::where('name', 'user')->first()->id;
		$userData = $request->getOnly(['first_name', 'last_name', 'email', 'password', 'expiration_date', 'role_id']);
		$userData['password'] = md5($userData['password']);
		$userData['role_id'] = $role;

		$user = User::create($userData);

		if (!empty($user)) {
            return redirect(route('admin.users.list'))->withFlashSuccess('User created successfully!')->go();
        } else {
			return redirect()->withFlashError('Something went wrong!')->back();
		}

	}

	public function edit(Request $request, User $user)
	{
		return render('backend/admin/user/edit', [
			'user' => $user
		]);
	}

	public function update(Request $request)
	{
		$validator = $request->validate([
			'first_name' => 'required|min:2|max:18',
			'last_name' => 'required|min:2|max:18',
			'email' => 'required|max:70|email|unique:users,email,' . $request->id,
            'password' => ['eqt:confirm_password'],
		]);

		if ($validator->hasError()) {
            return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
        }

		$userData = $request->getOnly(['first_name', 'last_name', 'email', 'password']);
		if (!empty($userData['password'])) {
			$userData['password'] = md5($userData['password']);
		} else {
			unset($userData['password']);
		}

		if (User::where('id', $request->id)->update($userData)) {
			return redirect()->withFlashSuccess('User updated successfully!')->with('old', $request->all())->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}

	}

	public function delete(Request $request, User $user)
	{
		if (!empty($user)) {
			User::where('id', $user->id)->delete();
			return redirect()->withFlashError('User deleted successfully!')->back();
		} else {
			return redirect()->withFlashError('Oops! Something went wrong!')->back();
		}
	}

}