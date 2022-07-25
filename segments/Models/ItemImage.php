<?php

namespace Models;

use Models\Base\Model;

class ItemImage extends Model
{
	protected $table = 'item_images';
    protected $attaches = ['full_path', 'image_name'];
    public function getFullPathProperty()
	{
		return url($this->path);
	}

    public function getImageNameProperty()
	{
		return basename($this->path);
	}
}