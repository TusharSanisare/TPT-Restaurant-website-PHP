<?php

$conn = mysqli_connect("localhost", "root", "tusharsql", "tpt_restaurant");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



// $stmt = $conn->prepare("SELECT * FROM tbl_food_items");
// $stmt->execute();
// $result = $stmt->get_result();
