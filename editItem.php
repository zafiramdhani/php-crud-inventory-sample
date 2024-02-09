<?php

require 'config.php';

$id = $_GET['id'];
$org = $_POST['org'];
$plant = $_POST['plant'];
$sold_to = $_POST['sold_to'];
$ship_to = $_POST['ship_to'];
$material = $_POST['material'];
$distrik = $_POST['distrik'];
$qty_minimum = $_POST['qty_minimum'];
$qty_bonus = $_POST['qty_bonus'];
$qty_status = $_POST['qty_status'];
$created_by = $_POST['created_by'];

$query = "UPDATE inventories SET org='$org', plant='$plant', sold_to='$sold_to', ship_to='$ship_to', material='$material', distrik='$distrik', qty_minimum='$qty_minimum', qty_bonus='$qty_bonus', qty_status='$qty_status', created_by='$created_by', updated_at=NOW() WHERE id='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
  echo json_encode(array('successMsg' => 'Item updated successfully!'));
} else {
  echo json_encode(array('errorMsg' => 'Error while updating item.'));
}
