<?php

include('config.php');
require_once('vendor/autoload.php');

use Faker\Factory;

$faker = Factory::create('id_ID');

for ($i = 1; $i <= 20; $i++) { 
  $org = $faker->numberBetween(1000, 9999);
  $plant = $faker->word();
  $sold_to = $faker->name();
  $ship_to = $faker->name();
  $material = $faker->sentence(2);
  $distrik = $faker->address();
  $qty_minimum = $faker->numberBetween(10, 99);
  $qty_bonus = $faker->numberBetween(0, 9);
  $qty_status = $faker->word();
  $created_by = $faker->name();
  $updated_by = $faker->name();

  mysqli_query($conn, "INSERT INTO inventories 
                      (org, plant, sold_to, ship_to, material, distrik, qty_minimum, qty_bonus, qty_status, created_by, updated_by)
                      VALUES ('$org', '$plant', '$sold_to', '$ship_to', '$material', '$distrik', '$qty_minimum', '$qty_bonus', '$qty_status', '$created_by', '$updated_by')");
}

header('location:index.php');