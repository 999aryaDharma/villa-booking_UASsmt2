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
  	<script src="https://cdn.tailwindcss.com"></script>
		<link href="dist/output.css" rel="stylesheet" />
		<link href="src/input.css" rel="stylesheet" />
  <title>Admin</title>
</head>
<body>
  
</body>
</html>