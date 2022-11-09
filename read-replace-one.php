<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new MongoDB\Client($_ENV['MDB_SERVER']);

$collection = $client->test->phhdi;

$data = $collection->findOneAndReplace(
	[
		'city_province' => 'Metro Manila'
	],
	[
		'city_province' => 'Metro Manila',
		'region' => 'NCR'
	]
);

var_dump($data);

echo 'DONE';
