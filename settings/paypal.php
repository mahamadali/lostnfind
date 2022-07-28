<?php

return [
	'PAYPAL_ID' => 'akbarbusiness121@gmail.com',
    'PAYPAL_SANDBOX' => true,
    'PAYPAL_URL' => 'https://www.sandbox.paypal.com/cgi-bin/webscr', // LIVE https://www.paypal.com/cgi-bin/webscr
    'PAYPAL_RETURN_URL' => 'http://localhost/lostnfind/paypal/success',
    'PAYPAL_CANCEL_URL' => 'http://localhost/lostnfind/paypal/cancel',
    'PAYPAL_NOTIFY_URL' => 'http://dev.wisencode.com/webhooks/paypal/notify.php',
    'CURRENCY' => 'USD',
];