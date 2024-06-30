<?php
include_once "../layout/header.php";
// require "../rooms-admin.php/function-room.php";
require_once "../rooms-admin.php/function-room.php";

// untuk mengecek tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    // var_dump($_FILES);
    // uploadImage();
    if( createRoom($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            document.location.href = '../rooms-admin.php/create-rooms.php';
        </script>
        "; }
    // } else {
    //     echo "
    //     <script>
    //         alert('Data gagal ditambahkan');
    //         document.location.href = '../rooms-admin.php/create-rooms.php';
    //     </script>
    //     ";
    // }
}
?>


<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Create Rooms</h1>
        </div>

        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <input name="room-name" type="text" placeholder="Room Name" required class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input name="room-price" type="text" id="price" placeholder="Price" required class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input name="num-beds" type="text" placeholder="Number Of Beds" required class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div>
                    <input name="room-view" type="text" placeholder="Views" required class="w-full px-3 py-2 mb-4 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <div class="space-y-2 m-2">
                    <label for="status" class="font-semibold">Status :</label><br>
                    <select id="status" name="status" class="border-2 border-black border-solid px-2 py-1 block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="available" <?php echo (isset($status) && $status == 'Available') ? 'selected' : ''; ?> class="text-gray-900">Available</option>
                        <option value="booked" <?php echo (isset($status) && $status == 'Booked') ? 'selected' : ''; ?> class="text-gray-900">Booked</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-semibold">Fasilitas:</label><br>
                    <?php
                    $query_fasilitas = "SELECT * FROM fasilitas";
                    $result_fasilitas = mysqli_query($conn, $query_fasilitas);
                    if (mysqli_num_rows($result_fasilitas) > 0) {
                        while ($row_fasilitas = mysqli_fetch_assoc($result_fasilitas)) {
                            $checked = '';
                            if (isset($selected_fasilitas) && in_array($row_fasilitas['id_fasilitas'], $selected_fasilitas)) {
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
                    <input name="room-img" type="file" placeholder="Room Image" required class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                </div>
                <button type="submit" name="submit" class=" btn custom-button px-3 py-1 rounded-md">Add</button>
            </form>
            <script>
            $(document).ready(function(){
            $('#price').inputmask('currency', {
                prefix: 'IDR. ',
                groupSeparator: '.',
                radixPoint: ',',
                digits: 2,
                autoGroup: true,
                rightAlign: false,
                removeMaskOnSubmit: true
                });
            });
    </script>
        </div>
    </div>
</main>