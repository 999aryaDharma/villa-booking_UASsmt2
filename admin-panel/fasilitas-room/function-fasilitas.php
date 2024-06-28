<?php
require "../../koneksi.php";

function getDataFasilitas()
{
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

function createFasilitas($data)
{
    global $conn;
    $nama_fasilitas = htmlspecialchars($data["nama_fasilitas"]);
    $deskripsi_fasilitas = htmlspecialchars($data["deskripsi-fasilitas"]);

    $stmt = $conn->prepare("INSERT INTO fasilitas (nama_fasilitas,deskripsi, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
    $stmt->bind_param("ss", $nama_fasilitas,$deskripsi_fasilitas);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
        return "An error occurred while inserting into users. Please try again.";
    }
}


function hapusFasilitas($conn, $id)
{
    // Hapus dari tabel `room_fasilitas`
    $sql2 = "DELETE FROM room_fasilitas WHERE id_fasilitas = '$id'";
    mysqli_query($conn, $sql2); // Tidak perlu memeriksa hasil, lanjutkan ke penghapusan utama

    // Hapus dari tabel `fasilitas`
    $sql1 = "DELETE FROM fasilitas WHERE id_fasilitas = '$id'";
    if (mysqli_query($conn, $sql1)) {
        echo "
          <script>
            alert('DATA BERHASIL DIHAPUS!');
            document.location.href = 'show-fasilitas.php';
          </script>
        ";
    } else {
        echo "
          <script>
            alert('DATA GAGAL DIHAPUS!');
            document.location.href = 'show-fasilitas.php';
          </script>
        ";
    }
}