<?php
require "../../function.php";

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
  // Kode halaman admin di sini...

  include_once "../layout/header.php";

?>

<main class="pl-56 pt-24 pr-9">

  <table class="border-collapse border-2 border-inherit shadow-xl w-full">
        <thead>
            <tr> 
                <th colspan="10" class="text-left border-y-2 border-inherit py-3 pl-3">Admins</th>            
            </tr>
            <tr>
                <th class="border-2 border-inherit px-3 py-1 text-left">#</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">User Name</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Email</th>>
                <th class="border-2 border-inherit px-3 py-1 text-left">Edit</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="border-2 border-inherit p-3 text-left">1</th>
                <td class="border-2 border-inherit p-3">Krisna</td>
                <td class="border-2 border-inherit p-3">krisna@gmail.com</td>
                <td class="border-2 border-inherit p-3"><a href="edit-admins.php" class="inline-block btn bg-yellow-400 hover:bg-orange-600 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Edit</a></td>
                <td class="border-2 border-inherit p-3"><a href="delete-admins.php" class="inline-block btn bg-red-600 hover:bg-red-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Delete</a></td>
            </tr>
        </tbody>
    </table>
</main>