<?php
include_once "../layout/header.php";
// require "../admins/function-admin.php";
require_once "function-room.php";

$rooms = getRooms();

?>

<main class="pl-56 pt-24 pr-9">
    <table class="border-collapse border-2 border-inherit shadow-xl w-full">
        <thead>
            <tr>
                <th colspan="8" class="text-left border-y-2 border-inherit py-3 pl-3">Rooms</th>
                <th colspan="2" class="border-y-2 border-inherit py-3">
                    <a href="create-rooms.php" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Create Rooms</a>
                </th>
            </tr>
            <tr>
                <th class="border-2 border-inherit px-3 py-1 text-left">#</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Name</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Price</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Num of Beds</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">View</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Status</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Room Facility</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Room Image</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Edit</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($rooms as $row) : ?>
            <tr>
                <th class="border-2 border-inherit p-3 text-left"><?= $i; ?></th>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["nama"]); ?></td>
                <td class="border-2 border-inherit p-3">
                    IDR. <?= number_format($row["harga"], 2, ',', '.'); ?>
                </td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["num_beds"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["deskripsi"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["status"]); ?></td>
                <td class="border-2 border-inherit p-3">
                <?php
                // Pastikan $row['fasilitas_names'] adalah array sebelum mencetak
                if (is_array($row['fasilitas_names'])) {
                    echo implode(', ', array_map('ucwords', array_map('htmlspecialchars', $row['fasilitas_names'])));
                } else {
                    echo ucwords(htmlspecialchars($row['fasilitas_names']));
                }
                ?>
                </td>
                <td class="border-2 border-inherit p-3">
                    <?php
                    $fotoPath = 'images/' . $row['foto'];
                    if (file_exists($fotoPath) && !empty($row['foto'])) {
                        echo '<img src="' . htmlspecialchars($fotoPath) . '" alt="' . htmlspecialchars($row['nama']) . '" style="max-width: auto; height: 50px;" />';
                    } else {
                        echo '<img src="images/default.jpg" alt="default image" style="max-width: auto; height: 50px;" />';
                    }
                    ?>
                </td>
                <td class="border-2 border-inherit p-3">
                    <a href="edit-rooms.php?id=<?= $row["id_room"]; ?>" class="inline-block btn bg-yellow-400 hover:bg-orange-600 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Edit</a>
                </td>
                <td class="border-2 border-inherit p-3">
                    <a href="delete-rooms.php?id=<?= $row["id_room"]; ?>" class="inline-block btn bg-red-600 hover:bg-red-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white" onclick="return confirm('Yakin ingin menghapus data?');">Delete</a>
                </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>