<?php

namespace Models;

use Models\Base\Model;

class SocialMedia extends Model
{
	protected $table = 'social_media_footer_menu';

	protected $attaches = ['full_path', 'image_name'];

	
    public function getFullPathProperty()
	{
		return url($this->icon);
	}

    public function getImageNameProperty()
	{
		return basename($this->icon);
	}

}