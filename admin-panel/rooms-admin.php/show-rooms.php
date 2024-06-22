<?php
include_once "../layout/header.php";


  // Memeriksa apakah pengguna sudah login
  if (!isset($_SESSION['auth_id'])) {
    header("location: /auth/login.php");
    exit();
  }

  // if (!isset($_SESSION['role'])) {
  //   echo "Access Denied. You do not have permission to access this page.";
  //   exit();
  // }

  // // Memeriksa apakah pengguna memiliki peran admin
  // if ($_SESSION ['role'] !== 1) {
  //   echo "Access Denied. You do not have permission to access this page.";
  //   exit();
  // }
  // Kode halaman admin di sini...

?>

<main class="pl-56 pt-24 pr-9">

    <table class="border-collapse border-2 border-inherit shadow-xl w-full">
        <thead>
            <tr> 
                <th colspan="8" class="text-left border-y-2 border-inherit py-3 pl-3">Rooms</th>
                <th colspan="2" class="border-y-2 border-inherit py-3"><a href="../rooms-admin.php/create-rooms.php" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Create Rooms</a></th>
            </tr>
            <tr>
                <th class="border-2 border-inherit px-3 py-1 text-left">#</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Name</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Price</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Num of Persons</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Size</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">View</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Num of Beds</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Status Value</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Edit</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="border-2 border-inherit p-3 text-left">1</th>
                <td class="border-2 border-inherit p-3">Suite Room</td>
                <td class="border-2 border-inherit p-3">Rp. 2000000</td>
                <td class="border-2 border-inherit p-3">12</td>
                <td class="border-2 border-inherit p-3">50</td>
                <td class="border-2 border-inherit p-3">Sea View</td>
                <td class="border-2 border-inherit p-3">3</td>
                <td class="border-2 border-inherit p-3">1</td>
                <td class="border-2 border-inherit p-3"><a href="edit-rooms.php" class="inline-block btn bg-yellow-400 hover:bg-orange-600 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Edit</a></td>
                <td class="border-2 border-inherit p-3"><a href="delete-rooms.php" class="inline-block btn bg-red-600 hover:bg-red-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Delete</a></td>
            </tr>
        </tbody>
    </table>
</main>