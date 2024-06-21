<?php
require "../../function.php";

  // // Memeriksa apakah pengguna sudah login
  // if (!isset($_SESSION['auth_id'])) {
  //   header("location: /auth/login.php");
  //   exit();
  // }

  // if (!isset($_SESSION['role'])) {
  //   echo "Access Denied. You do not have permission to access this page.";
  //   exit();
  // }

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
                <th colspan="5" class="text-left border-y-2 border-inherit py-3 pl-3">Admins</th>            
            </tr>
            <tr>
                <th class="border-2 border-inherit px-3 py-1 text-left">#</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">User Name</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Email</th>
                <th class="border-2 border-inherit px-3 py-1 text-center">Edit</th>
                <th class="border-2 border-inherit px-3 py-1 text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
          <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $admin => $value) : ?>
              <tr>
                  <td class="border-2 border-inherit p-3 text-left"> <?= $value->id ?> </td>
                  <td class="border-2 border-inherit p-3"><?= $value->username ?></td>
                  <td class="border-2 border-inherit p-3"><?= $value->email ?></td>
                  <td class="border-2 border-inherit w-24">
                    <a href="<?= "edit-admins.php?id={$value->id}" ?>" class="flex justify-center btn bg-yellow-400 hover:bg-orange-600 px-6 py-2 rounded-md text-center text-white">Edit</a>
                  </td>
                  <td class="border-2 border-inherit w-24">  
                    <button type="submit" name="submit"><a href="<?= "delete-admins.php?id={$value->id}" ?>" class="flex justify-center btn bg-red-600 hover:bg-red-800 px-6 py-2 rounded-md text-center text-white ">Delete</a></button>
                  </td> 
              </tr>
            <?php endforeach ?>
          <?php else: ?>
                <tr>
                    <td colspan="4" class="border-2 border-inherit p-3 text-center">No data available</td>
                </tr>  
          <?php endif ?> 
        </tbody>
  </table>
</main>