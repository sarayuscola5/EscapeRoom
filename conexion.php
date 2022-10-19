<?php 
$hostDB = '127.0.0.1';
$nombreDB = 'igkluba';
$usuarioDB = 'root';
$password = 'root';

$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB);
?>