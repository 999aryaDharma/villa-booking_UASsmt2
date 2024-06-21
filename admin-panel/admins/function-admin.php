<?php
require_once "../../function.php";

function getAllData (){
  $conn = connect();
  $sql = "SELECT * FROM users JOIN customer ON customer.id_customer = users.id_customer";
  $result = mysqli_query($conn, $sql);

  $data = [];

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
  }

  return $data;
}

function hapusAdmin($conn, $id) {
    $conn = connect();
    // Lakukan query untuk menghapus data dengan ID tertentu
    // Hapus dari tabel `users`
    $sql1 = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($conn, $sql1)) {
            echo "Data berhasil dihapus dari tabel users.<br>";
    }
       // Hapus dari tabel `customer`
      $sql2 = "DELETE FROM customer WHERE id_customer = (
              SELECT id_customer FROM users WHERE id = '$id'
              )";

        if (mysqli_query($conn, $sql2)) {
            echo "Data berhasil dihapus dari tabel customer.";
            return true;
          } else {
              echo "Error: " . mysqli_error($conn);
              return false;


    if (mysqli_query($conn, $query)) {
      return mysqli_query($conn, $query);
        echo "
          <script>
            alert('DATA BERHASIL DIHAPUS!');
            document.location.href = 'admin-page.php';
          </script>
        ";
    } else {
        return null;
        echo "
          <script>
            alert('DATA GAGAL DIHAPUS!');
            document.location.href = 'admin-page.php';
          </script>
        ";
    }
  }
}

function editAdmin($data){
  $conn = connect ();
  $id = $data['id'];
  $username = $data['username'];
  $email = $data['email'];

  // Query untuk mengupdate data
  $sql = "UPDATE users 
          JOIN customer ON users.id_customer = customer.id_customer
          SET users.username = '$username', 
              customer.email = '$email',
              users.updated_at=NOW()
          WHERE users.id = '$id'";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
  }
  
?>