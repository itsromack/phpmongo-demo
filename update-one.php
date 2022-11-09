<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new MongoDB\Client($_ENV['MDB_SERVER']);

$collection = $client->test->phhdi;

$data = $collection->findOneAndUpdate(
	[
		'city_province' => 'Metro Manila'
	],
	[
		'$set' => [
			'region' => 'MM'
		]
	],
	[
		'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER
	]
);

var_dump($data);

echo 'DONE';
