<?php
require_once "function.php";
require_once "koneksi.php";

// Pastikan session auth_id tersedia
$auth_id = isset($_SESSION['auth_id']) ? $_SESSION['auth_id'] : null;
if (!$auth_id) {
    header("Location: /auth/login.php");
    exit();
}

// Query untuk mengambil informasi customer dan riwayat booking customer
$sql = "SELECT c.id_customer, c.nama_customer, c.email, c.alamat, c.no_telepon,
               b.id_booking, b.check_in, b.check_out, b.total_harga, r.nama AS nama_kamar, r.id_room
        FROM customer c
        JOIN users u ON c.id_customer = u.id_customer
        LEFT JOIN booking b ON c.id_customer = b.id_customer
        LEFT JOIN room r ON b.id_room = r.id_room
        WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $auth_id);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    if (!isset($customer)) {
        $id_customer = $row['id_customer'];
        $nama_customer = $row['nama_customer'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $no_telepon = $row['no_telepon'];
    }

    if ($row['id_booking']) {
        $booking = [
            'id_booking' => $row['id_booking'],
            'check_in' => $row['check_in'],
            'check_out' => $row['check_out'],
            'total_harga' => $row['total_harga'],
            'nama_kamar' => $row['nama_kamar'],
            'id_room' => $row['id_room']
        ];
        $bookings[] = $booking;
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/loader.css" rel="stylesheet" />
    <script src="js/loader.js"></script>
    <title>Booking Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
<!-- Loader -->
<div id="loader">
    <div class="spinner"></div>
</div>
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">Booking History</h1>
    <?php if (!empty($id_customer)) : ?>
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <p><strong>Nama :</strong> <?= $nama_customer ?></p>
            <p><strong>Email :</strong> <?= $email ?></p>
            <p><strong>Alamat :</strong> <?= $alamat ?></p>
            <p><strong>No Telepon :</strong> <?= $no_telepon ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($bookings)) : ?>
        <?php foreach ($bookings as $booking) : ?>
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <p><strong>ID Booking:</strong> <?= htmlspecialchars($booking['id_booking']) ?></p>
                <p><strong>Check-in Date:</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
                <p><strong>Check-out Date:</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
                <p><strong>Total Price:</strong> Rp <?= number_format($booking['total_harga'], 0, ',', '.') ?></p>
                <p><strong>Nama Kamar:</strong> <?= htmlspecialchars($booking['nama_kamar']) ?></p>
                <!-- Tombol Cancel Booking -->
                <button onclick="cancelBooking(<?= $booking['id_booking'] ?>, <?= $booking['id_room'] ?>)" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mt-4 inline-block">Cancel Booking</button>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No booking history.</p>
    <?php endif; ?>

    <!-- Tombol Back -->
    <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mt-4 inline-block mr-2">Back</a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function cancelBooking(id_booking, id_room) {
    $.ajax({
        url: 'cancel_booking.php', // Mengarahkan ke file cancel_booking.php untuk membatalkan booking
        type: 'POST',
        data: {
            action: 'cancel_booking', // Aksi untuk pembatalan booking
            id_booking: id_booking,
            id_room: id_room
        },
        success: function(response) {
            alert('Booking berhasil dibatalkan: ' + response);
            location.reload(); // Refresh halaman setelah pembatalan berhasil
        },
        error: function(xhr, status, error) {
            alert('Booking gagal dibatalkan: ' + error);
        }
    });
}
</script>
</body>
</html>
