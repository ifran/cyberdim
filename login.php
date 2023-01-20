<?php 
require 'vendor/serpapi/google-search-results-php';
require 'vendor/serpapi/restclient.php';

$query = [
 "q" => "Naruto",
 "hl" => "en",
 "gl" => "us",
 "google_domain" => "google.com",
];

$search = new GoogleSearch('50fdaa34aa04f363d6e7d3c3f225ce18ae72c800a3126236f0741fc909ff413e');
$result = $search->get_json($query);
?>