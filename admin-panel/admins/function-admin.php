<?php
require "../../koneksi.php";
// require_once "../../function.php";

// function connect(){
//   $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
//   if($conn->connect_errno != 0){
//     $error = $conn->$connect_error;
//     $error_date = date("F j, Y, g:i a");
//     $message = "{$error} | {$error_date} \r\n";
//     file_put_contents("db-log.txt", $message, FILE_APPEND);
//     return false;
//   } else {
//       return $conn;
//   }
// };

function getAllData ($conn){
  
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
    global $conn;
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
  global $conn;
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
  

function registerAdmin($nama_customer, $email, $password, $confirm_password){
  global $conn;
  $args = func_get_args();

  #hilangkan spasi lebih
  $args = array_map(function($value){
    return trim($value);
  }, $args);

  foreach ($args as $value) {
    if (empty($value)) {
      return "All fields are required";
    }
  }

  foreach ($args as  $value) {
    if(preg_match("/([<|>])/", $value)){
      return "<> characters are not allowed";
    }
  }

  #get email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return "Email is not valid";
  }
  $stmt = $conn->prepare("SELECT email FROM customer WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();
  // echo "Email Check Result: " . var_export($data, true) . "<br>";
  if ($data != NULL) {
    return "Email already exists, please use a different email";
  }

  #get username
  if (strlen($nama_customer) > 20) {
    echo "Username is too long";
    return;
  }
  $stmt = $conn->prepare("SELECT nama_customer FROM customer WHERE nama_customer = ?");
  $stmt->bind_param("s", $nama_customer);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();
  if ($data != NULL) {
    return "Username already exists, please use a different username";
  }

  #get password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO customer(nama_customer, email, created_at, updated_at) VALUES(?,?, NOW(), NOW())");
  $stmt->bind_param("ss", $nama_customer, $email,);
  $stmt->execute();

  if (strlen($password) > 50) {
    return "Password is too long";
  }
  if ($password != $confirm_password) {
    return "Password don't match";
  }

  if ($stmt->affected_rows != 1) {
    return "An error occurred while inserting into customers. Please try again.";
  } else {
    $id_customer = $stmt->insert_id;

    $stmt = $conn->prepare("INSERT INTO users (id_customer, username, password, role, created_at, updated_at) VALUES (?, ?, ?, 1, NOW(), NOW())");
    $stmt->bind_param("iss", $id_customer, $nama_customer, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
      return "An error occurred while inserting into users. Please try again.";
    } else {
      header("location: admin-page.php");
    }
    exit();
  }
};

function getAdminById($conn, $id){
  
  $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($username);
  $stmt->fetch();
  $stmt->close();

  return $username;
}
?>