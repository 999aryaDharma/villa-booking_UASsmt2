<?php 
require_once "function.php";
function showRoom($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rooms = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rooms[] = $row;
	}
	return $rooms;
}
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
$sql = showRoom("SELECT r.id_room, r.nama,r.deskripsi,r.harga,r.num_beds,r.status,rf.foto FROM room r INNER JOIN room_foto rf
ON r.id_room = rf.id_room
WHERE r.id_room ='$id_room'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <link href="dist/output.css" rel="stylesheet" />
    <link href="src/input.css" rel="stylesheet" />
    <link href="src/loader.css" rel="stylesheet" />
    <script src="js/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Booking</title>
     
    <style>
        p,h1,h2,h3,h4 {
        font-family: "Inconsolata", monospace;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
        font-variation-settings:
            "wdth" 100;
        padding: 10px;
        }
        body {
            background-image: url("images/irina-iriser-2Y4dE8sdhlc-unsplash.jpg");
            background-size: cover; /* Mengatur ukuran gambar untuk menutupi seluruh elemen */
            background-position: center; /* Posisi gambar di tengah elemen */
            background-repeat: no-repeat;   
        }
    </style>
</head>
<?php foreach($sql as $v) : ?>
<?php endforeach ?>
<div class="bg-card dark:bg-card-foreground p-6 rounded-lg shadow-lg max-w-4xl mx-auto mt-10 ">
  <div class="flex justify-between items-center mb-6 rounded-md bg-teal-50">
    <!-- <button class="bg-white p-2 rounded-md shadow-md flex items-center"> -->
        <a href="index.php"><img aria-hidden="true" alt="home-icon" src="images/logo.png" class="h-12 pl-5 rounded-md"/></a>
    <!-- </button> -->
  </div>

  <div class=" dark:bg-card-foreground p-6 rounded-lg shadow-md bg-teal-50">
    <h1 class="text-green-600 font-bold text-3xl mb-4 text-center"><?= $v['nama']?></h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <label class="block text-center mb-2"><strong>Select date to order</strong></label>
        <form method="POST" class="space-y-4 shadow " onsubmit="bookNow(event)">
          <div class="flex flex-col space-y-4">
            <input type="date" id="checkIn" name="checkIn" class="w-full p-2 border border-gray-300 rounded bg-teal-50" />
            <input type="date" id="checkOut" name="checkOut" class="w-full p-2 border border-gray-300 rounded bg-teal-50" />
          </div>
          <button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white py-2 rounded mt-4">BOOK NOW</button>
        </form>
        
        <h2 class="text-center mt-8">This room accommodates up to:</h2>
        <div class="flex justify-center space-x-2 mt-2">
          <?php for ($i = 0; $i < $v['num_beds']; $i++) : ?>
            <img class="h-6 w-6" aria-hidden="true" alt="guests-icon" src="https://openui.fly.dev/openui/24x24.svg?text=👤"/>
          <?php endfor; ?>
        </div>
        <h3 class="text-center"><?= $v['num_beds']?></h3>
        <p class="text-center">Guest's</p>
        <div class="bg-green-200">
            <h4 id="totalPrice" class="text-center mt-2">Total Harga: Rp 0</h4>
        </div>
      </div>

      <div class="col-span-2">
        <img class="w-full h-full object-cover rounded-md" src="admin-panel/rooms-admin.php/images/<?= $v['foto']?>" alt="Room image" />
      </div>
    </div>
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
