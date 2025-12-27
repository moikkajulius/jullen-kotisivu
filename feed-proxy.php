<?php
header('Content-Type: application/xml; charset=utf-8');
header('Access-Control-Allow-Origin: *'); // Allow usage from JS

$url = 'https://www.visiotech.fi/feed/';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// IMPORTANT: Handle gzip compression (common cause of empty/garbled responses)
curl_setopt($ch, CURLOPT_ENCODING, ""); 
// IMPORTANT: Follow redirects (e.g., http -> https)
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// IMPORTANT: Timeout to prevent hanging
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// Mimic a real browser fully
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Language: fi-FI,fi;q=0.9,en-US;q=0.8,en;q=0.7',
    'Cache-Control: no-cache'
]);
// Ignore SSL certificate issues if your server is old
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$data = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error_msg = curl_error($ch);
curl_close($ch);

// Debugging: If the fetch fails or returns an error code, show it
if ($http_code != 200 || !$data) {
    // Return a fake XML error so the JS can read it
    echo "<?xml version='1.0'?><error>Server Error: $http_code. Curl Error: $error_msg</error>";
    exit;
}

echo $data;
?>