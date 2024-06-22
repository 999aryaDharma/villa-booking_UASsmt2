<?php 
$id = $_GET['id'];
require_once "function-admin.php";
$h = hapusAdmin($conn, $id);
header("Location: admin-page.php");
$conn->close();
?>

<?php
                      if (isset($_POST['submit'])) {
                        $id = $_POST['id'];
                        if (hapusAdmin($id)) {
                            echo "
                            <script>
                                alert('DATA BERHASIL DIHAPUS!');
                                document.location.href = 'admin-page.php';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                                alert('DATA GAGAL DIHAPUS!');
                                document.location.href = 'admin-page.php';
                            </script>
                            ";
                        }
                    }
                    ?>
