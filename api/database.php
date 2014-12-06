<?php

function getConnection() {

	include '../config.php';

    $dbh = new PDO("mysql:host={$config['host']};dbname={$config['database']}",$config['username'],$config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("SET CHARACTER SET utf8");

    return $dbh;

}