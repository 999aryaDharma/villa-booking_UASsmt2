<?php

require "config.php";

function connect(){
  $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
  if($conn->connect_errno != 0){
    $error = $conn->$connect_error;
    $error_date = date("F j, Y, g:i a");
    $message = "{$error} | {$error_date} \r\n";
    file_put_contents("db-log.txt", $message, FILE_APPEND);
    return false;
  } else {
    return $conn;
  }
};


function registerUser($nama_customer, $alamat, $email, $no_telepon, $password, $confirm_password){
  $conn = connect();
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

  $stmt = $conn->prepare("INSERT INTO customer(nama_customer, alamat, email, no_telepon, created_at, updated_at) VALUES(?,?,?,?, NOW(), NOW())");
  $stmt->bind_param("ssss", $nama_customer, $alamat, $email, $no_telepon);
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

    $stmt = $conn->prepare("INSERT INTO users (id_customer, username, password, role, created_at, updated_at) VALUES (?, ?, ?, 2, NOW(), NOW())");
    $stmt->bind_param("iss", $id_customer, $nama_customer, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows != 1) {
      return "An error occurred while inserting into users. Please try again.";
    } else {
      return "Success";
    }
  header("location: ../index.php");
  }
};


function loginUser($nama_customer, $password) {
    $conn = connect();
    $nama_customer = trim($nama_customer);
    $password = trim($password);

    if ($nama_customer == "" || $password == "") {
        return "Both fields are required";
    }

    $nama_customer = filter_var($nama_customer, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nama_customer); // Perbaiki variabel yang di-bind
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data == NULL) {
        return "Wrong Username or Password!";
    }

    if (password_verify($password, $data['password']) == FALSE) {
        return "Wrong Username or Password!";
    }

    // Set session variables setelah login berhasil
    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    // Mengarahkan pengguna berdasarkan peran mereka
    if ($_SESSION['role'] == 1) {
        header("Location: ../admin/admin-page.php");
    } else {
        header("Location: ../index.php");
    }
    exit();
}

// Proses form login saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_customer = $_POST["username"];
    $password = $_POST["password"];
    $error = loginUser($nama_customer, $password);
    if ($error) {
        echo $error; // Tampilkan pesan error jika ada
    }
// } else {
//     header("Location: login.php");
//     exit();
};

function logoutUser(){
  session_destroy();
  header("location: auth/login.php");
  exit();
};


?>



<!-- // // Fungsi untuk melakukan login
// function loginAdmin($username, $password, $valid_users) {
//     // Daftar username dan password yang valid
//     $valid_users = array(
//         'Arya' => '999',
//         'Ngurah' => '123',
//         'Hanum' => '456',
//         'Krisna' => '789'
//     );

//     // Memeriksa apakah username ada dalam daftar valid_users
//     if (array_key_exists($username, $valid_users)) {
//         // Memeriksa apakah password cocok
//         if ($password === $valid_users[$username]) {
//             // Jika valid, atur session
//             $_SESSION['username'] = $username;
//             $_SESSION['role'] = 1; // Misalnya, set peran sebagai admin

//             // Redirect ke halaman admin.php setelah login berhasil
//             header("location: ../admin/admin-page.php");
//             exit();
//         } else {
//             // Password tidak cocok
//             echo "Password salah.";
//         }
//     } else {
//         // Username tidak valid
//         echo "Username tidak ditemukan.";
//     }
// }

// // Proses form login saat formulir disubmit
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     // Panggil fungsi loginUser() untuk memeriksa dan mengatur session
//     loginAdmin($username, $password, $valid_users);
// } -->