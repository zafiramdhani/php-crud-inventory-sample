<?php

require 'config.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;

$query = mysqli_query($conn, "SELECT COUNT(*) FROM inventories");
$row = mysqli_fetch_row($query);
$result['total'] = $row[0];

$query = mysqli_query($conn, "SELECT * FROM inventories ORDER BY created_at DESC LIMIT $offset, $rows");

$items = array();
while ($row = mysqli_fetch_object($query)) {
  array_push($items, $row);
}

$result['rows'] = $items;

echo json_encode($result);