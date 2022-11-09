<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$csv_filename = 'PH2012-hdi.csv';
$handle = fopen($csv_filename, 'r');
$row_index = 0;
$headers = [];

$data = [];

while (($row_data = fgetcsv($handle, 1000, ',')) !== FALSE)
{
	if ($row_index++ < 1)
	{
		foreach ($row_data as $col)
		{
			array_push($headers, $col);
			var_dump($col);
		}
		continue;
	}

	$tmp = [];
	for ($index = 0; $index < count($headers); $index++)
	{
		$tmp[$headers[$index]] = $row_data[$index];
	}
	array_push($data, $tmp);
}

fclose($handle);

// Load Data to MongoDB

$client = new MongoDB\Client($_ENV['MDB_SERVER']);

$collection = $client->test->phhdi;

foreach ($data as $item)
{
	echo $item['City or Province'] . ' ' . $item['Region'];
	echo "\n\tLife Expectancy: " . $item['Life Expectancy at birth (years) 2012'];
	echo "\n\tYears of Schooling: " . $item['Expected years of Schooling 2012'];
	echo "\n\tPer Capita Income: " . $item['Per Capita Income 2012 (PPP NCR 2012 Pesos)'];
	echo "\n";

	$doc = [
		'city_province' => $item['City or Province'],
		'region' => $item['Region'],
		'life_expectancy' => $item['Life Expectancy at birth (years) 2012'],
		'years_schooling' => $item['Expected years of Schooling 2012'],
		'per_capita_income' => $item['Per Capita Income 2012 (PPP NCR 2012 Pesos)']
	];

	$result = $collection->insertOne($doc);
	var_dump($result);
}

echo 'DONE';
