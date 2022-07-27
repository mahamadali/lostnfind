<?php

return [

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

];