<?php

$api_url = 'https://api.myquran.com/v2/sholat/jadwal/1104/2025/3/4';

// membaca JSON dari url
$json_data = file_get_contents($api_url);

// Decode data JSON data menjadi array PHP
$response_data = json_decode($json_data);

// Mengakses data yang ada dalam object 'data'
$jadwal_shalat = $response_data->data;

?>

<pre>
<?php print_r($jadwal_shalat); ?>
</pre>