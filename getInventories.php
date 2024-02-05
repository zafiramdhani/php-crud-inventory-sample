<?php

require 'config.php';

// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
// $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;

// $query = $conn->query("SELECT * FROM inventories");
$query = mysqli_query($conn, "SELECT * FROM inventories");
$result = array();

while ($row = mysqli_fetch_object($query)) {
  array_push($result, $row);
}

echo json_encode($result);