<?php 
require_once "function.php";

if (isset($_GET['id'])) {
    $id_room = $_GET['id'];
}

$auth_user = getUserById($_SESSION['auth_id'] ?? null);
if (!isset($_SESSION['auth_id'])) {
    header("Location: /auth/register.php");
    exit();
} 

if (isset($_SESSION['nama_kamar'])) {
    $nama_kamar = $_SESSION['nama_kamar'];
} else {
    echo "Nama Kamar tidak tersedia.";
}

global $conn;
$sql = "SELECT harga FROM room WHERE id_room = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_room);
$stmt->execute();
$stmt->bind_result($harga_kamar);
$stmt->fetch();
$stmt->close();

$_SESSION['harga_kamar'] = $harga_kamar;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="dist/output.css" rel="stylesheet" />
    <link href="src/input.css" rel="stylesheet" />
    <link href="src/loader.css" rel="stylesheet" />
    <script src="js/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Booking</title>
</head>
<body>
    <!-- Loader -->
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <div class="relative min-h-screen bg-cover bg-center dark:bg-zinc-900" style="background-image: url('images/room1.jpg')">
        <div class="absolute right-0 inset-0 bg-black opacity-50"></div>
        
        <div class="absolute z-10 p-10 top-32">
            <h1 class="text-white text-2xl">Welcome <?= $auth_user['username'] ?? " " ?> to Pemuda Inguh Villas</h1>
            <h2 class="text-zinc-400 text-4xl font-bold mt-4"><?= $nama_kamar ?> Room</h2>
        </div>

        <div class="absolute top-1/4 right-1/4 transform translate-x-1/2 bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full min-h-64">
            <h3 class="text-2xl mb-4 font-thin">Book this room</h3>
            <h2 class="mb-2" id="roomPrice">Harga Kamar: Rp <?= number_format($harga_kamar, 0, ',', '.'); ?></h2>
            <form method="POST" class="space-y-4" onsubmit="bookNow(event)">
                <div class="flex space-x-4">
                    <input type="date" id="checkIn" name="checkIn" placeholder="check-in" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
                    <input type="date" id="checkOut" name="checkOut" placeholder="check-out" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
                </div>
                <h4 id="totalPrice">Total Harga: Rp 0</h4>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white py-2 rounded">BOOK NOW</button>
            </form>
        </div>
    </div>
    <script>
        var pricePerRoom = <?= $harga_kamar ?>; // Harga kamar dari server

        function calculateBookingPrice(checkInDate, checkOutDate, pricePerRoom) {
            var checkIn = moment(checkInDate);
            var checkOut = moment(checkOutDate);
            var daysDifference = checkOut.diff(checkIn, 'days');
            return daysDifference > 0 ? daysDifference * pricePerRoom : 0;
        }

        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price);
        }

        function updatePrice() {
            var checkInDate = document.getElementById("checkIn").value;
            var checkOutDate = document.getElementById("checkOut").value;
            
            if (checkInDate && checkOutDate) {
                if (moment(checkOutDate).isBefore(moment(checkInDate))) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tanggal check-out harus setelah tanggal check-in'
                    });
                    document.getElementById("checkOut").value = '';
                    return;
                }
                
                var totalPrice = calculateBookingPrice(checkInDate, checkOutDate, pricePerRoom);
                document.getElementById("totalPrice").innerText = "Total Harga: " + formatPrice(totalPrice);
            }
        }

        function getPriceFromServer() {
            $.ajax({
                url: 'proses_booking.php',
                type: 'POST',
                data: {
                    action: 'get_price',
                    id_room: <?= $id_room; ?>
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    pricePerRoom = data.price_per_room;
                    document.getElementById("roomPrice").innerText = "Harga Kamar: " + formatPrice(pricePerRoom);
                    updatePrice(); // Update harga setelah mendapatkan data dari server
                },
                error: function(xhr, status, error) {
                    console.error('Error getting price: ' + error);
                }
            });
        }

        function bookNow(event) {
            event.preventDefault();

            var checkInDate = document.getElementById("checkIn").value;
            var checkOutDate = document.getElementById("checkOut").value;
            var customerId = "<?= $auth_user['id_customer']; ?>";
            var idRoom = <?= $id_room; ?>;
            var totalPrice = calculateBookingPrice(checkInDate, checkOutDate, pricePerRoom);
            
            $.ajax({
                url: 'proses_booking.php',
                type: 'POST',
                data: {
                    action: 'book_room',
                    customer_id: customerId,
                    id_room: idRoom,
                    check_in: checkInDate,
                    check_out: checkOutDate,
                    total_price: totalPrice // Mengirim total harga ke PHP
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking Berhasil!',
                        text: response
                    }).then((result) => {
                        // Redirect atau tindakan lain setelah OK ditekan
                        window.location.href = 'index.php#room';
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Booking gagal: ' + error
                    });
                }
            });
        }

        // Dokumen siap
        $(document).ready(function() {
            // Set minimum date untuk check-in ke hari ini
            var today = moment().format('YYYY-MM-DD');
            $("#checkIn").attr('min', today); // Minimum date untuk check-in adalah hari ini

            // Set default value untuk check-in (hari ini) dan check-out (besok)
            var tomorrow = moment().add(1, 'day').format('YYYY-MM-DD');
            $("#checkIn").val(today); // Default check-in hari ini
            $("#checkOut").val(tomorrow); // Default check-out besok

            // Set minimum date untuk check-out ke tanggal check-in
            $("#checkOut").attr('min', tomorrow);

            // Ambil harga dari server saat halaman dimuat
            getPriceFromServer();

            // Update harga saat input tanggal berubah
            $("#checkIn, #checkOut").on("change", function() {
                if (this.id === "checkIn") {
                    var checkOutMinDate = moment(this.value).add(1, 'day').format('YYYY-MM-DD');
                    $("#checkOut").attr('min', checkOutMinDate);

                    // Reset nilai check-out jika sudah lebih kecil dari check-in
                    if (moment($("#checkOut").val()).isBefore(this.value)) {
                        $("#checkOut").val(checkOutMinDate);
                    }
                }
                updatePrice();
            });

            // Update harga saat halaman dimuat
            updatePrice();
        });
    </script>
</body>
</html>
