<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "porjek_villa";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Gagal konek ke database: " . mysqli_connect_error());
}