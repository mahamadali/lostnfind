<?php

use Barriers\VerifyToken;
use Barriers\Admin\IsAuthenticated;
use Barriers\Admin\IsNotAuthenticated;

return [

    // Add Barrier aliases to use as an alias
    'Barriers' => [
        'verify-token' => VerifyToken::class,
        'is-auth' => IsAuthenticated::class,
        'is-not-auth' => IsNotAuthenticated::class,
    ],

];