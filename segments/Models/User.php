<?php

namespace Models;

use Models\Base\Model;
use Models\Role;
use Models\AdditionalContact;

class User extends Model
{
	protected $table = 'users';
	protected $attaches = ['full_name'];

	protected $elements = [
		'first_name',
		'last_name',
		'email',
		'password',
		'expiration_date',
		'role_id'
	];
	
	public function role() 
	{
		return $this->parallelTo(Role::class, 'role_id');
	}

	public function contacts()
	{
		return $this->hasMany(AdditionalContact::class, 'user_id');
	}

	public function getFullNameProperty()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

}