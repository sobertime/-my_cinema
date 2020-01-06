<?php
$conn = new PDO("mysql:host=localhost; dbname=epitech_tp;charset=utf8", 'root', 'root');
$conn->query("ALTER table historique_membre add avis varchar(255) NULL");
?>
