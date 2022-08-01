<?php

return [

	// Mail configuration
	'mail' => [

		'via' => 'smtp', // default | SMTP

		'from' => [
				'email' => 'admin@administration.com',
				'name' => 'Administration',
		],

		'reply' => [
				'email' => 'reply@administration.com',
				'name' => 'Administration',
		],

		'smtp' => [
			'host' => 'smtp.gmail.com',
			'username' => 'rehanmasiya786@gmail.com',
			'password' => 'iawwoxmxuceblpwx',
			'port' => 587,
			'encryption' => 'tls', // SSL | TLS
			'debug' => false,
			'auth' => true,
		],

	],

	// SMS configuration
	'sms' => [

		'via' => 'twilio', // twilio

		'twilio' => [
			'account_sid' => 'TWILIO_ACCOUNT_SID',
			'auth_token' => 'TWILIO_AUTH_TOKEN',
			'from_number' => 'TWILIO_FROM_NUMBER',
			'api_endpoint' => 'https://api.twilio.com/2010-04-01/',
		],

	],

];