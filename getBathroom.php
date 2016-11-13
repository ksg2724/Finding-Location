<?php
$conn = mysqli_connect("localhost", "ksg2724", "k2422724", "ksg2724");
mysqli_query($conn, "SET NAMES utf8");
$query = "SELECT * FROM bathroom";
$result = mysqli_query($conn, $query);
while ($temp = mysqli_fetch_assoc($result))
    $bathrooms[] = $temp;
echo json_encode($bathrooms);