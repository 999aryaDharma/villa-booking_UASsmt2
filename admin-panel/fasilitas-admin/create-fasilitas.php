<?php
include_once "../layout/header.php";
require_once "function-fasilitas.php";

// untuk mengecek tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    if (createFasilitas($_POST)) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'show-fasilitas.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'show-fasilitas.php';
        </script>
        ";
    }
}
?>


<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Create Rooms</h1>
        </div>

        <div>
            <form action="" method="post">
                <div>
                    <input name="nama_fasilitas" type="text" placeholder="Nama Fasilitas" required class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <button type="submit" name="submit" class=" btn custom-button px-3 py-1 rounded-md">Add</button>
            </form>
        </div>
    </div>
</main>