<?php 
require_once "function-room.php";
include_once "../layout/header.php";

if (isset($_POST['submit'])) {
    if (editRoom($_POST) > 0) {
        echo "
        <script>
        alert('DATA BERHASIL DIUBAH!');
        document.location.href = 'show-rooms.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('DATA GAGAL DIUBAH!');
        document.location.href = 'show-rooms.php';
        </script>
        ";
    }
}

// untuk mengambil id
$id = $_GET['id'];

// untuk menampilkan pilihan fasilitas yang sudah tercenntang
$selected_fasilitas = [];
$id_room = $_GET['id']; // id_room yang sedang diedit
$query_selected_fasilitas = "SELECT id_fasilitas FROM room_fasilitas WHERE id_room = '$id_room'";
$result_selected_fasilitas = mysqli_query($conn, $query_selected_fasilitas);
if ($result_selected_fasilitas) {
    while ($row = mysqli_fetch_assoc($result_selected_fasilitas)) {
        $selected_fasilitas[] = $row['id_fasilitas'];
    }
}

// untuk menampilkan status room yang sudah terpilih sebelumnya
$id_room = $_GET['id']; // id_room yang sedang diedit
$query_selected_status = "SELECT status FROM room WHERE id_room = '$id_room'";
$result_selected_status = mysqli_query($conn, $query_selected_status);
$status = '';
if ($result_selected_status && mysqli_num_rows($result_selected_status) > 0) {
    $row = mysqli_fetch_assoc($result_selected_status);
    $status = $row['status'];
}

$edit = showRoom("SELECT room.id_room, room.nama, room.harga, room.num_beds, room.deskripsi, room.status,room_foto.foto, GROUP_CONCAT(fasilitas.nama_fasilitas) AS fasilitas
                FROM room
                INNER JOIN room_foto ON room.id_room = room_foto.id_room
                INNER JOIN room_fasilitas ON room.id_room = room_fasilitas.id_room
                INNER JOIN fasilitas ON fasilitas.id_fasilitas = room_fasilitas.id_fasilitas
                WHERE room.id_room = '$id'")[0];
?>

<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Edit Rooms</h1>
        </div>
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <input type="hidden" name="id_room" placeholder="Id Room" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= ($id); ?>">
                    <input type="hidden" name="current_image" value="<?= htmlspecialchars($edit['foto']); ?>">
                </div>
                <div>
                    <label for="username">Room Name :</label>
                    <input type="text" id="username" name="room-name" placeholder="Room Name" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= $edit['nama']; ?>">
                </div>
                <div>
                    <label for="price">Price :</label>
                    <input type="text" id="price" step="0.01" name="room-price" placeholder="Price" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= $edit["harga"]; ?>">
                </div>
                <div>
                    <label for="numbed">Number of Beds :</label>
                    <input type="text" id="numbed" name="num-beds" placeholder="Number of Bed" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= $edit['num_beds']; ?>">
                </div>
                <div>
                    <label for="view">View :</label>
                    <input type="text" id="view" name="room-view" placeholder="View" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= $edit['deskripsi']; ?>">
                </div>
                <div>
                <label for="status" class="font-semibold">Status :</label><br>
                <select id="status" name="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <?php if ($status == 'Available') : ?>
                        <option value="Available" selected class="text-gray-900">Available</option>
                        <option value="Booked" class="text-gray-900">Booked</option>
                    <?php else : ?>
                        <option value="Available" class="text-gray-900">Available</option>
                        <option value="Booked" selected class="text-gray-900">Booked</option>
                    <?php endif ?>
                </select><br>
                </div>
                <div>
                <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas:</label><br>
                <?php
                $query_fasilitas = "SELECT * FROM fasilitas";
                $result_fasilitas = mysqli_query($conn, $query_fasilitas);
                if (mysqli_num_rows($result_fasilitas) > 0) {
                    while ($row_fasilitas = mysqli_fetch_assoc($result_fasilitas)) {
                        $checked = '';
                        if (in_array($row_fasilitas['id_fasilitas'], $selected_fasilitas)) {
                            $checked = 'checked';
                        }
                        echo '
                        <label class="flex items-center">
                            <input type="checkbox" name="fasilitas[]" value="' . $row_fasilitas['id_fasilitas'] . '" ' . $checked . ' class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded">
                            <span class="ml-2 text-gray-700">' . ucfirst($row_fasilitas['nama_fasilitas']) . '</span>
                        </label><br>
                        ';
                    }
                }
                ?>
                </div>
                <div>
                    <label for="room-foto">Room Photo :</label><br>
                    <img src="images/<?= $edit['foto'];?>" style="max-width: auto; height: 100px;"><br>
                    <input name="room-img" id="room-img" type="file" placeholder="Room Image" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div class="flex justify-start items-start mt-2">
                    <button type="submit" name="submit" class=" btn custom-button px-3 py-1 rounded-md">Edit</button>
                </div>
            </form>
        </div>
    </div>
</main>