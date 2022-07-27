<?php

namespace Models;

use Models\Base\Model;

class Pages extends Model
{
    protected $table = 'pages';

    protected $route_bind_column = 'title';

    protected $transforms = [
        'title' => 'slug'
    ];

    public function getTitleBeautifyProperty() {
        return ucwords(str_replace("-", " ", $this->title));
    }

}