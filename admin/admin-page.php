<?php
  session_start();

  // Memeriksa apakah pengguna sudah login
  if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
  }

  // Memeriksa apakah pengguna memiliki peran admin
  if ($_SESSION['role'] !== 1) {
    echo "Access Denied. You do not have permission to access this page.";
    exit();
  }
  // Kode halaman admin di sini...

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>LOLOK</p>
</body>
</html>