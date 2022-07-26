<?php

namespace Models;

use Models\Base\Model;
use Models\Role;
use Models\Item;
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
		'contact_number',
		'logo',
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

	public function getAvatarProperty()
    {
        return 'https://i2.wp.com/ui-avatars.com/api/'.urlencode($this->first_name.$this->last_name).'/64?ssl=1';
    }

	public function items()
	{
		return $this->hasMany(Item::class, 'user_id')->get();
	}


}