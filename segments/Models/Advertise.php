<?php

namespace Models;

use Models\Base\Model;

class Advertise extends Model
{
	protected $table = 'advertise';

    protected $attaches = ['full_path', 'image_name'];

	
    public function getFullPathProperty()
	{
		return url($this->image);
	}

    public function getImageNameProperty()
	{
		return basename($this->image);
	}

}