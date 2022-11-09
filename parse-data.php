<?php

$filename = 'PH2012-hdi.csv';
$handle = fopen($filename, 'r');
$row_index = 0;
$headers = [];

$data = [];

while (($row_data = fgetcsv($handle, 1000, ',')) !== FALSE)
{
//	var_dump($row_data);
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
//exit;
var_dump($data);
var_dump($headers);
