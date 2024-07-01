<?php 
require "../../koneksi.php";

function showBooking($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
    return $rooms;
}

function editStatus($data){
    global $conn;
    $status = htmlspecialchars($data["status"]);
    $id_booking = htmlspecialchars($data["id_booking"]);
    $new_status = mysqli_real_escape_string($conn, $status);

    $sql = "UPDATE booking SET status = '$new_status' WHERE id_booking = '$id_booking'";

    // Lakukan query ke database
    if (mysqli_query($conn, $sql)) {
        echo "Update berhasil";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
};

?>