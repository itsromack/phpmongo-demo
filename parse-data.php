<?php

$filename = 'PH2012-hdi.csv';
$handle = fopen($filename, 'r');
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

foreach ($data as $item)
{
	echo $item['City or Province'] . ' ' . $item['Region'];
	echo "\n\tLife Expectancy: " . $item['Life Expectancy at birth (years) 2012'];
	echo "\n\tYears of Schooling: " . $item['Expected years of Schooling 2012'];
	echo "\n\tPer Capita Income: " . $item['Per Capita Income 2012 (PPP NCR 2012 Pesos)'];
	echo "\n";
}
