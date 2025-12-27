<?php
// feed-proxy.php
header('Content-Type: application/xml; charset=utf-8');

// The feed URL
$url = 'https://www.visiotech.fi/feed/';

// Use cURL to fetch the data (more reliable than file_get_contents)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
// Set a User-Agent so the target server knows it's a browser/valid request
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$data = curl_exec($ch);
curl_close($ch);

echo $data;
?>