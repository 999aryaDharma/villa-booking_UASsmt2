<?php
include_once "../layout/header.php";
require_once "../fasilitas-admin/function-fasilitas.php";

$data = getDataFasilitas();

?>

<main class="pl-56 pt-24 pr-9">

    <table class="border-collapse border-2 border-inherit shadow-xl w-full">
        <thead>
            <tr>
                <th colspan="3" class="text-left border-y-2 border-inherit py-3 pl-3">Rooms</th>
                <th colspan="2" class="border-y-2 border-inherit py-3"><a href="../fasilitas-admin/create-fasilitas.php" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Add Facilities</a></th>
            </tr>
            <tr>
                <th class="border-2 border-inherit px-3 py-1 text-left">#</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Nama Fasilitas</th>
                <th class="border-2 border-inherit px-3 py-1 text-left">Delete</th>
            </tr>
        </thead>
        <?php $i = 1; ?>
        <?php foreach ($data as $v) : ?>
            <tbody>
                <tr>
                    <td class="border-2 border-inherit p-3"><?= $i ?></td>
                    <td class="border-2 border-inherit p-3"><?= $v['nama_fasilitas']; ?></td>
                    <td class="border-2 border-inherit p-3 text-center w-28"><a href="<?= "delete.php?id={$v['id_fasilitas']}" ?>" onclick="return confirm('Are you sure want delete this facility?');"  class="inline-block btn bg-red-600 hover:bg-red-800 px-6 py-2 rounded-md text-center pointer-events-auto text-white">Delete</a></td>
                </tr>
                <?php $i++ ?>
            <?php endforeach; ?>
            </tbody>
    </table>
</main>