<?php
    include_once "../layout/header.php";
    require_once "function-admin.php";
    // Periksa apakah 'id' ada di URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("ID tidak ditemukan di URL.");
    }

  // Memeriksa apakah pengguna sudah login
  if (!isset($_SESSION['auth_id'])) {
    header("location: /auth/login.php");
    exit();
  }

  if (!isset($_SESSION['role'])) {
    echo "Access Denied. You do not have permission to access this page.";
    exit();
  }

  // Memeriksa apakah pengguna memiliki peran admin
    if ($_SESSION ['role'] !== 1) {
        echo "Access Denied. You do not have permission to access this page.";
        exit();
    }

   // Cek apakah form disubmit
    if (isset($_POST['submit'])) {
        if (editAdmin($_POST) > 0) {
            echo "
            <script>
                alert('DATA BERHASIL DIUBAH!');
                document.location.href = 'admin-page.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('DATA GAGAL DIUBAH!');
                document.location.href = 'admin-page.php';
            </script>
            ";
        }
    }
?>
<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Edit Admin</h1>
        </div>
        <div>
                <?php
                    $sql = "SELECT users.username, customer.email, users.id
                            FROM users 
                            JOIN customer ON customer.id_customer = users.id_customer
                            WHERE users.id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $v = mysqli_fetch_assoc($result);
                ?>
            <form action="" method="POST">
                
                <div>
                     <input type="hidden" name="id" value="<?= ($id); ?>">
                </div>
                <div>
                    <label for="username">Username :</label>
                    <input type="text" name="username" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= $v['username']; ?>" />
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="text" name="email" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= $v['email']; ?>">
                </div>
                <button type="submit" name="submit" class=" btn custom-button px-3 py-1 rounded-md">Edit</button>
            </form>
        </div>
    </div>
</main>
<?php $conn->close();?>