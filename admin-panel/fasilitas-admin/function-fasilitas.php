<?php
require "../../koneksi.php";

function getDataFasilitas(){
    global $conn;
    $sql = "SELECT * FROM fasilitas";
    $result = mysqli_query($conn, $sql);

    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

function createFasilitas($data){
    global $conn;
    $nama_fasilitas = htmlspecialchars($data["nama_fasilitas"]);

    $stmt = $conn->prepare("INSERT INTO fasilitas (nama_fasilitas, created_at, updated_at) VALUES (?, NOW(), NOW())");
    $stmt->bind_param("s", $nama_fasilitas);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
        return "An error occurred while inserting into users. Please try again.";
    }
}
        
    

function hapusFasilitas($conn, $id) {
    global $conn;
    // Lakukan query untuk menghapus data dengan ID tertentu
    // Hapus dari tabel `users`
    $sql1 = "DELETE FROM fasilitas WHERE id_fasilitas = '$id'";
    if (mysqli_query($conn, $sql1)) {
        echo "Data berhasil dihapus dari tabel users.<br>";
    }
        if (mysqli_query($conn, $sql1)) {
            return mysqli_query($conn, $sql1);
            echo "
          <script>
            alert('DATA BERHASIL DIHAPUS!');
            document.location.href = 'show-fasilitas.php';
          </script>
        ";
        } else {
            return null;
            echo "
          <script>
            alert('DATA GAGAL DIHAPUS!');
            document.location.href = 'show-fasilitas.php';
          </script>
        ";
        }
}


