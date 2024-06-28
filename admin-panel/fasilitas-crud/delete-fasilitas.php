<?php
require_once "function-fasilitas.php";
$id = $_GET['id'];
$h = hapusFasilitas($conn, $id);
header("Location: show-fasilitas.php");
$conn->close();
?>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    if (hapusFasilitas($conn, $id)) {
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
?>