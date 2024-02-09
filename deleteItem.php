<?php

require 'config.php';

$id = $_POST['id'];

$query = "DELETE FROM inventories WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result) {
  echo json_encode(array('success' => true));
} else {
  echo json_encode(array('errorMsg' => 'Error deleting item.'));
}