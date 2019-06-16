<?php

$login = 'wsuser';
$password = 'wsbodet';

$client = new SoapClient(
    'http://' . urlencode($login) . ':' . urlencode($password) . '@localhost:8089/open/services/' . $service . '?wsdl', [
        'login' => $login,
        'password' => $password
    ]
);