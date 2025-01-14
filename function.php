<?php

require "koneksi.php";
session_start();

$auth_user = null;

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
// function getAllData ($conn){
  
//   $sql = "SELECT * FROM users JOIN customer ON customer.id_customer = users.id_customer";
//   $result = mysqli_query($conn, $sql);

//   $data = [];

//   if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//       $data[] = $row;
//     }
//   }

//   return $data;
// }


function registerUser($nama_customer, $alamat, $email, $no_telepon, $password, $confirm_password){
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

  if (strlen($password) > 50) {
    return "Password is too long";
  }
  if ($password != $confirm_password) {
    return "Password don't match";
  }

  #get password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO customer(nama_customer, alamat, email, no_telepon, created_at, updated_at) VALUES(?,?,?,?, NOW(), NOW())");
  $stmt->bind_param("ssss", $nama_customer, $alamat, $email, $no_telepon);
  $stmt->execute();

  
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
      header("location: login.php");
      die();
    }
  }
  mysqli_close($conn);
};


function loginUser($nama_customer, $password) {

    global $conn;
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
    $stmt->close();
    
    if (password_verify($password, $data['password']) == FALSE) {
        return "Wrong Username or Password!";
    }

    // Set session variables setelah login berhasil
    $_SESSION['auth_id'] = $data['id'];
    $_SESSION['role'] = $data['role'];

    // Mengarahkan pengguna berdasarkan peran mereka
    if ($data['role'] == 1) {
        header("Location: /admin-panel/style/index.php");
    } else {
        header("Location: /index.php");
    }
    exit();

}

function logoutUser(){
  unset($_SESSION['auth_id']);
  $auth_user = null;
  header("location: /index.php");
  exit();
};

function getUserById($id){
  global $conn;
  $stmt = $conn->prepare("SELECT id_customer, username FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($id_customer, $username);
  $stmt->fetch();
  $stmt->close();

  return array('id_customer' => $id_customer, 'username' => $username);
}


function getAllRoom(){
    global $conn;
    $sql = "SELECT room.id_room, room.nama, room.harga, room.num_beds, room.deskripsi, room.status, GROUP_CONCAT(room_foto.foto) AS foto, GROUP_CONCAT(fasilitas.nama_fasilitas) AS fasilitas
        FROM room
        INNER JOIN room_foto ON room.id_room = room_foto.id_room
        INNER JOIN room_fasilitas ON room.id_room = room_fasilitas.id_room
        INNER JOIN fasilitas ON fasilitas.id_fasilitas = room_fasilitas.id_fasilitas
        GROUP BY room.id_room";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$rooms = [];
		while ($row = $result->fetch_assoc()) {
				$row['photos'] = explode(',', $row['foto']);
				$rooms[] = $row;
		}
}


// if (is_null($id)) {
//   return null;
// }
//   return [
//     "id" => 1,
//     "username" => "arya",
//     "role" => 2
//   ];


?>


