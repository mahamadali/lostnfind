<?php

namespace Controllers;

use Bones\Request;
use Bones\Session;
use Jolly\Engine;
use Models\User;

class AuthController
{
	public function index(Request $request)
	{
		return render('backend/auth/login');
	}

	public function checkLogin(Request $request)
	{
		$email = $request->email;
		$password = $request->password;

		$user = User::where('email', $email)->where('password', md5($password))->with('role')->first();
		if ( !empty($user) ) {
			Session::set('auth', $user);
			return $this->redirectAfterLogin($user);
		} else {
			return redirect()->to(route('auth.login'))->withFlashError('Incorrect credentials!')->go();
		}
	}

	public function autoLogin(Request $request, $email)
	{
		$auth = User::where('email', $email)->with('role')->first();
		session()->set('auth', $auth);

		return $this->redirectAfterLogin($auth);
	}

	public function redirectAfterLogin($user) {
		$role = $user->role->name ?? '';
		switch ($role) {
			case 'admin':
				return redirect()->to(route('admin.dashboard'))->go();
				break;
			case 'user':
				return redirect()->to(route('user.dashboard'))->go();
				break;
			case 'supplier':
				return redirect()->to(route('supplier.dashboard'))->go();
				break;
			default:
				return Engine::error([
					'error' => 'Unauthorised Access!'
				]);
				break;
		}
		
	}

	public function logout(Request $request) {
		Session::remove('auth');
		return redirect()->to(route('auth.login'))->go();
	}
}