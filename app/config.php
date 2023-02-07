<?php
include 'database.php';

$db = new Database('localhost', 'urlshortener', 'root', '');
$db = $db->connect();
?>