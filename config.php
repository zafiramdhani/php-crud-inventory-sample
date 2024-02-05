<?php

$SERVER = 'localhost';
$USER = 'root';
$PASSWORD = '';
$DB_NAME = 'db_php_crud_inventory_sample';

$conn = mysqli_connect($SERVER, $USER, $PASSWORD, $DB_NAME);

if (!$conn) {
  die("Gagal terhubung ke database " . mysqli_connect_error());
}