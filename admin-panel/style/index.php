<?php
include_once "../layout/header.php";

// require_once "../admins/function-admin.php";

// require "../../function.php";

  // Memeriksa apakah pengguna sudah login
  if (!isset($_SESSION['auth_id'])) {
    header("location: /auth/login.php");
    exit();
  }

  if (!isset($_SESSION['role'])) {
    echo "Access Denied. You do not have permission to access this page.";
    exit();
  }

  // Memeriksa apakah pengguna memiliki peran admin
  if ($_SESSION ['role'] !== 1) {
    echo "Access Denied. You do not have permission to access this page.";
    exit();
  }


  $sql = "SELECT COUNT(*) AS total_admins
        FROM users 
        WHERE role = 1";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Mengambil hasil query sebagai array asosiatif
        $row = mysqli_fetch_assoc($result);
        
        // Mengambil nilai jumlah baris dari hasil query
        $totalAdmin = $row['total_admins'];
    }


  $sql1 = "SELECT COUNT(nama) AS total_villa
        FROM room";

    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        // Mengambil hasil query sebagai array asosiatif
        $row = mysqli_fetch_assoc($result1);
        
        // Mengambil nilai jumlah baris dari hasil query
        $totalVilla = $row['total_villa'];
    }

    $sql2 = "SELECT COUNT(*) AS total_fasilitas
        FROM fasilitas";

    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {
        // Mengambil hasil query sebagai array asosiatif
        $row = mysqli_fetch_assoc($result2);
        
        // Mengambil nilai jumlah baris dari hasil query
        $totalFasilitas = $row['total_fasilitas'];
    }

    $sql3 = "SELECT COUNT(*) AS total_booking
        FROM booking";

    $result3 = mysqli_query($conn, $sql3);

    if ($result3) {
        // Mengambil hasil query sebagai array asosiatif
        $row = mysqli_fetch_assoc($result3);
        
        // Mengambil nilai jumlah baris dari hasil query
        $totalBooking = $row['total_booking'];
    }
?>
<main class="pl-56 pt-24 pr-9">
    <div class="custom-grid-colums">
        <div class="p-4 border shadow-xl">
            <h2 class="font-bold text-lg">Admins</h2>
            <p class="text-sm">Number Of Admins: <?= $totalAdmin ?></p>
        </div>
        <div class="p-4 border-2 shadow-xl">       
            <h2 class="font-bold text-lg">Fasilitas</h2>
            <p class="text-sm">Number Of Fasilitas: <?= $totalFasilitas ?></p>
        </div>
        <div class="p-4 border shadow-xl">
            <h2 class="font-bold text-lg">Rooms</h2>
            <p class="text-sm">Number Of Rooms: <?= $totalVilla ?></p>
        </div>
        
        <div class="p-4 border shadow-xl">
            <h2 class="font-bold text-lg">Bookings</h2>
            <p class="text-sm">Number Of Bookings: <?= $totalBooking ?></p>
        </div>
    </div>
</main>