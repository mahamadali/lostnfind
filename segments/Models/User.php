<?php

namespace Models;

use Models\Base\Model;
use Models\Role;

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

	public function supplierQuotes()
	{
		return $this->hasMany(QuoteSupplier::class, 'supplier_id')->leftJoin('quotations', 'quotations.id = quotation_suppliers.quotation_id')->where('quotations.status', 'approved', '!=');
	}

	public function getFullNameProperty()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

}