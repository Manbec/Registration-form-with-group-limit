<?php
$dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("formslabs");
$pdo = new PDO('mysql:host=localhost;dbname=formslabs', 'root', '');
session_start();
?>