<?php
require_once "function.php";
global $conn;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'get_price') {
        $id_room = $_POST['id_room'];
        $sql = "SELECT harga FROM room WHERE id_room = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_room);
        $stmt->execute();
        $stmt->bind_result($harga_kamar);
        $stmt->fetch();
        $stmt->close();
        echo json_encode(['price_per_room' => $harga_kamar]);

    } elseif ($action == 'book_room') {
        $id_customer = $_POST['customer_id'];
        $id_room = $_POST['id_room'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $total_harga = $_POST['total_price'];
        $sql = "INSERT INTO booking (id_room, id_customer, tgl_booking, check_in, check_out, status, total_harga, created_at, updated_at) VALUES (?, ?, NOW(), ?, ?, 'Pending', ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissi", $id_room, $id_customer, $check_in, $check_out, $total_harga);

        if ($stmt->execute()) {
                // Update status kamar menjadi 'booked'
                $sql_update = "UPDATE room SET status = 'Booked' WHERE id_room = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("i", $id_room);
                $stmt_update->execute();
                $stmt_update->close();

                echo "Booking berhasil";
            } else {
                echo "Booking gagal";
            }
            $stmt->close();
    }
}

?>
