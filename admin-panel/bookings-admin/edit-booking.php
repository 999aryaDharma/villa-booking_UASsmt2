<?php 
require_once "function-booking.php";
require_once "../layout/header.php";
 $id = $_GET['id'];
$query_selected_status = "SELECT status FROM booking WHERE id_booking = '$id'";
$result_selected_status = mysqli_query($conn, $query_selected_status);
$status = '';
if ($result_selected_status && mysqli_num_rows($result_selected_status) > 0) {
    $row = mysqli_fetch_assoc($result_selected_status);
    $status = $row['status'];
}

if (isset($_POST['submit'])) {
    if (editStatus($_POST)) {
        echo "
        <script>
        alert('DATA GAGAL DIUBAH!');
        document.location.href = 'show-bookings.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('DATA BERHASIL DIUBAH!');
        document.location.href = 'show-bookings.php';
        </script>
        ";
    }
}

?>

<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Edit Rooms</h1>
        </div>
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <input type="hidden" name="id_booking" placeholder="Id Room" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= ($id); ?>">
                </div>
                <div>
                    <label for="status" class="font-semibold">Status :</label><br>
                    <select id="status" name="status" class="border-2 border-black border-solid px-2 py-1 block w-full mt-1 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-40">
                        <option value="Accepted" class="text-gray-900" <?php if ($status == 'Accepted') echo 'selected'; ?>>Accepted</option>
                        <option value="Decline" class="text-gray-900" <?php if ($status == 'Decline') echo 'selected'; ?>>Decline</option>
                        <option value="Pending" class="text-gray-900" <?php if ($status == 'Pending') echo 'selected'; ?>>Pending</option>
                    </select><br>
                    <div class="flex justify-start items-start mt-2">
                    <button type="submit" name="submit" class=" btn custom-button px-3 py-1 rounded-md">Edit</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</main>