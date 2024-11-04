<?php
include_once "../layout/header.php";
require_once "function-booking.php";

$list = showBooking("SELECT * FROM booking");


?>

<main class="pl-56 pt-24 pr-9">
    <table class="border-collapse border-2 border-inherit shadow-xl w-full">
        <thead>
            <tr> 
                <th colspan="11" class="text-left border-y-2 border-inherit py-3 pl-3">Bookings</th>
            </tr>
        </thead>
            <tr>
                <th class="border-2 border-inherit px-3 py-1 text-left">#</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">ID Booking</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">ID Room</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">ID Customer</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Tanggal Booking</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Check-in</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Check-out</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Status</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Total Harga</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Edit</th>
            </tr>
        <tbody>
         <?php $i = 1; ?>
            <?php foreach($list as $row) : ?>
            <tr>
                <th class="border-2 border-inherit p-3 text-left"><?= $i; ?></th>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["id_booking"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["id_room"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["id_customer"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["tgl_booking"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["check_in"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["check_out"]); ?></td>
                <td class="border-2 border-inherit p-3"><?= htmlspecialchars($row["status"]); ?></td>
                <td class="border-2 border-inherit p-3">IDR. <?= number_format($row["total_harga"], 2, ',', '.'); ?></td>
                <td class="border-2 border-inherit p-3">
                    <a href="edit-booking.php?id=<?= $row['id_booking']; ?>" class="inline-block btn bg-yellow-400 hover:bg-orange-600 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Edit</a>
                </td>
                <?php $i++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
</main>