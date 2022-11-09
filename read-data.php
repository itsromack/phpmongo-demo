<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new MongoDB\Client($_ENV['MDB_SERVER']);

$collection = $client->test->phhdi;

$data = $collection->find(
	[
		'region' => 'Region III'
	]
);

foreach ($data as $item)
{
	var_dump($item);
}

echo 'DONE';
