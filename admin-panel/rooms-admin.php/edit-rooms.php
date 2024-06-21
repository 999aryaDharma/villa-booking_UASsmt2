<?php
include_once "../layout/header.php";
$id = $_GET['id'];

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
  $conn = connect();


?>

<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Edit Rooms</h1>
        </div>

        <div>
            <form action="" method="post">
                <div>
                    <input type="text" placeholder="Room Name" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="file" placeholder="Room Image" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="text" placeholder="Price" class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="text" placeholder="Number Of Persons" class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="text" placeholder="Size" class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="text" placeholder="View" class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="text" placeholder="Number Of Beds" class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input type="text" placeholder="Status Value" class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div class="flex justify-start items-start mt-2">
                <button type="submit" class="btn leading-5 space-x-2 px-6 text-white transform bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-800" name="submit">
                  <svg class="w-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                  </svg>
                  <span class="text-lg">Konfirmasi Edit</span>
                </button>
              </div>
            </form>
        </div>
    </div>
</main>