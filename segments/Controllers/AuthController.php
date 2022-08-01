<?php

namespace Controllers;

use Bones\Alert;
use Bones\Request;
use Bones\Session;
use Jolly\Engine;
use Mail\ResetPassword;
use Mail\WelcomeEmail;
use Models\PurchasePlanRequest;
use Models\Role;
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

	public function signup(Request $request, PurchasePlanRequest $planRequest)
	{
		if($planRequest->status == 'Active') {
			
			$user = User::where('email', $planRequest->email)->first();

			if(!empty($user)) {
				$userSubscription = $planRequest->user_subscription()->first();
				$userSubscription->owner_id = $user->id;
				$userSubscription->save();
				return redirect(route('auth.login'))->withFlashSuccess('Please login.')->go();
			}

			return render('backend/auth/signup', [
				'planRequest' => $planRequest
			]);
		}

		return render('defaults/301', [
			'stop_msg' => 'You are not authorized to access'
		]);
	}

	public function registerPost(Request $request, PurchasePlanRequest $planRequest) {
		$validator = $request->validate([
			'first_name' => 'required|min:2',
			'last_name' => 'required',
			'username' => 'required',
			'contact_number' => 'required|numeric',
			'password' => 'required',
			'cpassword' => 'required|eqt:password'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}

		$user = new User();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->username = $request->username;
		$user->email = $planRequest->email;
		$user->country_code = $request->country_code;
		$user->contact_number = $request->contact_number;
		$user->password = md5($request->password);
		$user->role_id = Role::where('name', 'user')->first()->id;
		// $user->subscription_id = $planRequest->user_subscription()->first()->paypal_subscr_id;
		$user = $user->save();

		$userSubscription = $planRequest->user_subscription()->first();
		$userSubscription->owner_id = $user->id;
		$userSubscription->save();
		
		Alert::as(new WelcomeEmail($user))->notify();

		return redirect()->to(route('auth.login'))->withFlashSuccess('All Set! Please login to access portal.')->go();

	}

	public function updateProfile(Request $request){
		dd($request);
	}

	public function forgotPassword(Request $request)
	{
		return render('backend/auth/forgot-password');
	}

	public function forgotPasswordPost(Request $request) {
		$user = User::where('email', $request->email)->first();
		if(!empty($user)) {
			Alert::as(new ResetPassword($user))->notify();
		}
		return redirect()->to(route('auth.forgot-password'))->withFlashSuccess('Reset password link sent to your email address.')->go();
	}

	public function resetPassword(Request $request, $token) {
		$user = User::where('password', base64_decode($token))->first();
		if(!empty($user)) {
			return render('backend/auth/reset-password', [
				'user' => $user
			]);
		} else {
			return render('defaults/301', ['error' => 'Unauthenticated!']);
		}
	}

	public function resetPasswordPost(Request $request, User $user) {
		$validator = $request->validate([
			'password' => 'required|min:6',
			'cpassword' => 'required|eqt:password'
		]);

		if ($validator->hasError()) {
			return redirect()->withFlashError(implode('<br>', $validator->errors()))->with('old', $request->all())->back();
		}
		
		$user->update(['password' => md5($request->password)]);
		return redirect()->to(route('auth.login'))->withFlashSuccess('Password has been changed successfully')->go();
	}
}