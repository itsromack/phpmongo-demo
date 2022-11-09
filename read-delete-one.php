<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new MongoDB\Client($_ENV['MDB_SERVER']);

$collection = $client->test->phhdi;

$data = $collection->findOneAndDelete(
	[
		'city_province' => 'Metro Manila'
	]
);

var_dump($data);

echo 'DONE';
