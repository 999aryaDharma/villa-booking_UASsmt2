<?php

require_once "koneksi.php";

// Pastikan request method adalah POST dan parameter action ada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Handle action 'cancel_booking'
    if ($action == 'cancel_booking') {
        // Ambil id_booking dan id_room dari data POST
        $id_booking = $_POST['id_booking'];
        $id_room = $_POST['id_room'];

        // Hapus data booking dari tabel booking
        $sql_delete_booking = "DELETE FROM booking WHERE id_booking = ?";
        $stmt_delete_booking = $conn->prepare($sql_delete_booking);
        $stmt_delete_booking->bind_param("i", $id_booking);

        // Lakukan eksekusi query
        if ($stmt_delete_booking->execute()) {
            // Jika penghapusan berhasil, update status room menjadi 'Available'
            $sql_update_room = "UPDATE room SET status = 'Available' WHERE id_room = ?";
            $stmt_update_room = $conn->prepare($sql_update_room);
            $stmt_update_room->bind_param("i", $id_room);
            
            // Lakukan eksekusi query
            if ($stmt_update_room->execute()) {
                echo "Booking berhasil dibatalkan.";
            } else {
                echo "Gagal memperbarui status kamar.";
            }

            $stmt_update_room->close(); // Tutup statement update room
        } else {
            echo "Gagal membatalkan booking.";
        }

        $stmt_delete_booking->close(); // Tutup statement delete booking
    } else {
        echo "Aksi tidak valid atau tidak ditemukan.";
    }
} else {
    echo "Request tidak valid.";
}
?>
