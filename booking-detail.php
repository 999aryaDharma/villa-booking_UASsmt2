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
               b.id_booking, b.check_in, b.status, b.check_out, b.total_harga, r.nama AS nama_kamar, r.id_room
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
        $status = $row['status'];
        $no_telepon = $row['no_telepon'];
    }

    if ($row['id_booking']) {
        $booking = [
            'id_booking' => $row['id_booking'],
            'status' => $row['status'],
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
    <link href="src/input.css" rel="stylesheet" />
    <script src="js/loader.js"></script>
    <title>Booking Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<body class="bg-gray-100 p-4 bg-cover bg-fixed bg-no-repeat bg-center min-h-screen"style="background-image: url('images/blur-bg.png')">
<!-- Loader -->
<div id="loader">
    <div class="spinner"></div>
</div>

<div class="max-w-3xl mx-auto md:p-8 max-md:mt-20 ">
    <div class="flex  mb-6 rounded-md bg-teal-50">
    <!-- <button class="bg-white p-2 rounded-md shadow-md flex items-center"> -->
        <a href="index.php"><img aria-hidden="true" alt="home-icon" src="images/logo.png" class="h-12 pl-5 rounded-md"/></a>
        <h1 class="text-xl font-semibold mb-4 pl-3 mt-3.5 text-emerald-700">Booking History</h1>
    <!-- </button> -->
    </div>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow-lg mt-5">
        <?php if (!empty($id_customer)) : ?>
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <p><strong>Nama :</strong> <?= $nama_customer ?></p>
                <p><strong>Email :</strong> <?= $email ?></p>
                <p><strong>Alamat :</strong> <?= $alamat ?></p>
                <p><strong>No Telepon :</strong> <?= $no_telepon ?></p>
            </div>
        <?php endif; ?>

        <div class="booking-container">
        <?php if (!empty($bookings)) : ?>
            <?php foreach ($bookings as $booking) : ?>
                <div class="booking-card">
                    <p><strong>Check-in Date :</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
                    <p><strong>Check-out Date :</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
                    <p><strong>Total Price :</strong> Rp <?= number_format($booking['total_harga'], 0, ',', '.') ?></p>
                    <p><strong>Nama Kamar :</strong> <?= htmlspecialchars($booking['nama_kamar']) ?></p>
                    <p><strong>Status :</strong> <?= htmlspecialchars($booking['status']) ?></p>
                    <button onclick="cancelBooking(<?= $booking['id_booking'] ?>, <?= $booking['id_room'] ?>)" class="cancel-button">Cancel Booking</button>
                </div>
            <?php endforeach; ?>
            <?php else : ?>
                <p>No booking history.</p>
            <?php endif; ?>
        </div>



        <!-- Tombol Back -->
        <a href="index.php" class="bg-emerald-600 hover:bg-emerald-700 text-white py-2 px-4 rounded mt-8 inline-block mr-2">Back</a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function cancelBooking(id_booking, id_room) {
    Swal.fire({
        title: 'Cancel reservation?',
        text: "Are you sure you want to cancel this booking?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user mengklik "Yes", lakukan AJAX request untuk membatalkan booking
            $.ajax({
                url: 'cancel_booking.php',
                type: 'POST',
                data: {
                    action: 'cancel_booking',
                    id_booking: id_booking,
                    id_room: id_room
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking successfully canceled!',
                        text: 'Response: ' + response,
                        timer: 2000, // Durasi pesan sukses
                        showConfirmButton: false // Tidak menampilkan tombol OK
                    }).then(function() {
                        location.reload(); // Refresh halaman setelah pembatalan berhasil
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to cancel booking!',
                        text: 'Error: ' + error,
                        timer: 3000, // Durasi pesan error
                        showConfirmButton: true // Menampilkan tombol OK
                    });
                }
            });
        }
    });
}
</script>

</body>
</html>
