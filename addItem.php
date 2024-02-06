<?php

require 'config.php';

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

$query = "INSERT INTO inventories (org, plant, sold_to, ship_to, material, distrik, qty_minimum, qty_bonus, qty_status, created_by) VALUES ('$org', '$plant', '$sold_to', '$ship_to', '$material', '$distrik', '$qty_minimum', '$qty_bonus', '$qty_status', '$created_by')";

$result = mysqli_query($conn, $query);

echo json_encode($result);