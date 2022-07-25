<?php

namespace Barriers;

use Bones\Request;

class VerifyToken 
{
    public function check(Request $request)
    {
        return true;
    }
}