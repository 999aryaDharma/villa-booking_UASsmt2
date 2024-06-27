<?php 
// require "../admins/function-admin.php";
require_once "../rooms-admin.php/function-room.php";

$id = $_GET["id"];

$result = deleteRoom($id);
if($result > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = '../rooms-admin.php/show-rooms.php';
        </script>
        ";
} else {
    $errorMessage = $result == -1 ? 'Terjadi kesalahan saat menghapus data' : 'Data tidak ditemukan atau tidak dihapus';
    echo "
        <script>
            alert('Data gagal dihapus: $errorMessage');
            document.location.href = '../rooms-admin.php/show-rooms.php';
        </script>
        ";
}
?>