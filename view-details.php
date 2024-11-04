<?php
// require "koneksi.php";
require "function.php";

// $id = $_GET['id'];
// // require "admin-panel/rooms-admin.php/function-room.php";
// $id_room = $_SESSION['id_room'];
// $auth_user = getUserById($_SESSION['auth_id'] ?? null);
// $rooms = getAllRoom($id);


$auth_user = getUserById($_SESSION['auth_id'] ?? null);
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
if ($auth_user) {
    
    $id_customer = $auth_user['id_customer']; 

   
    $sqli = showRoom("SELECT id_customer FROM customer WHERE id_customer='$id_customer'");
    
    foreach ($sqli as $row) {
        // echo $row['id_customer'] . '<br>'; 
    }
} else {
    echo "User tidak ditemukan atau tidak ada sesi auth_id."; 
}

if (isset($_GET['id'])) {
    $id_room = $_GET['id'];

    global $conn;
    $sql = "SELECT room.id_room, room.nama, room.harga, room.num_beds, room.deskripsi, room.status, GROUP_CONCAT(DISTINCT room_foto.foto) AS foto, GROUP_CONCAT(DISTINCT fasilitas.nama_fasilitas) AS fasilitas
        FROM room
        INNER JOIN room_foto ON room.id_room = room_foto.id_room
        INNER JOIN room_fasilitas ON room.id_room = room_fasilitas.id_room
        INNER JOIN fasilitas ON fasilitas.id_fasilitas = room_fasilitas.id_fasilitas
        WHERE room.id_room = ?
        GROUP BY room.id_room
        LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_room);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        $photos = explode(',', $room['foto']);
        // Tampilkan informasi kamar dan foto-fotonya
    } else {
        // Handle jika kamar tidak ditemukan
        echo "Kamar tidak ditemukan.";
    }

    $stmt->close();
    $_SESSION['nama_kamar'] = $room['nama'];
    $nama_kamar = $room['nama'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Room</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="dist/output.css" rel="stylesheet" />
    <link href="src/input.css" rel="stylesheet" />
    <link href="src/loader.css" rel="stylesheet" />
    <link href="src/hamburger.css" rel="stylesheet" />
    <script src="js/loader.js"></script>
	<script src="js/main.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
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
    
    </style>
</head>
<body class="m-0 p-0">
    <!-- Loader -->
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <!-- Loader END -->

    <!-- Button Humburger -->
    <button id="hamburger" class="md:hidden hamburger-icon m-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 ham-icon text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 6l16 0" />
            <path d="M4 12l16 0" />
            <path d="M4 18l16 0" />
        </svg>
        <svg class="w-8 h-8 close-icon hidden text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
        </svg>
    </button>
    <!-- Button Humburger END -->

    <!-- Navbar -->
    <nav class="hidden md:flex md:items-center md:space-x-4 fixed top-0 left-0 w-full justify-between px-5 py-2 items-center border-b-1 bg-neutral-400 text-white nav-blur z-50">
        <div>
            <a href="#"><img src="images/logo_putih.png" alt="Logo" class="h-12 px-2 rounded-md" /></a>
        </div>
        <div>
            <ul class="flex gap-10 text-xl">
                <li><a href="#room" class="custom-underline">Villas</a></li>
                <li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
                <li><a href="auth/register.php" class="custom-underline">Register</a></li>
                <li>
                    <?php if (!is_null($auth_user)) : ?>
                        <a href="/auth/logout.php" class="custom-underline">Log Out</a>
                    <?php else : ?>
                        <a href="/auth/login.php" class="custom-underline">Sign In</a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="md:p-20 bg-card text-card-foreground mt-10 pt-20">
        <button onclick="window.location.href='index.php#room';" type="button" class="flex items-center justify-center px-3 mb-4 ml-5 text-sm custom-button rounded-lg">
            <svg class="w-8 h-8 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
        </button>
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 relative max-md:px-5">
        <?php foreach ($photos as $photo): ?>
        <?php endforeach; ?>
        <img src="admin-panel/rooms-admin.php/images/<?= trim($photo) ?>" alt="Room image" class="room-image rounded-md md:max-w-2xl md:w-[36rem] md:h-96" loading="lazy">
        <!-- Status Room -->
        <span class="<?php
        $status = trim($room['status']);
        if ($status === 'Available') {
            echo 'bg-green-500';
        } else if ($status === 'Booked') {
            echo 'bg-red-600';
        }
    ?> text-white text-sm font-semibold px-2 py-1 rounded-full absolute top-4 left-4 max-md:ml-5">
    <?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>
    </span>
        <!-- End Status Room -->
        </div>
        <div class="md:w-2/3  md:pl-6 mt-6 md:mt-0 max-md:px-5">
            <h2 class="text-2xl font-bold"><?= $room['nama'] ?></h2>
            <p class="mt-2 text-muted-foreground"><?= $room['deskripsi'] ?></p>
            <hr class="mt-3">
            <h2 class="text-xl font-semiboldbold mt-1">Facilities</h2>
            <ul class="mt-4 list-disc list-inside space-y-1">
            <?php
                $query = "SELECT fasilitas.nama_fasilitas,fasilitas.deskripsi
                FROM room_fasilitas
                JOIN fasilitas ON room_fasilitas.id_fasilitas = fasilitas.id_fasilitas
                WHERE room_fasilitas.id_room = ?";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id_room);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $facilities = [];
                    while ($row = $result->fetch_assoc()) {
                        $facilities[] = $row['nama_fasilitas'];
                    
                }
            ?>
            <?php
            if (!empty($facilities)) {
                echo "<ul class='md:grid md:grid-cols-4'>";
                foreach ($facilities as $facility) {
                    echo "<li class='flex items-center justify-left py-2'>" . htmlspecialchars($facility) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<ul class='flex justify-center'><li>No facilities available.</li></ul>";
            } 
            ?>
            </ul>
            <p class="absolute right-0 md:mr-16 mr-5 mt-6">IDR. <?= number_format($room["harga"], 2, ',', '.'); ?></p>
            <?php
            if ($status == 'Booked') {
                echo "<button class='btn text-white bg-red-600 hover:bg-red-700 absolute right-0 md:mr-16 mr-5 mt-14 py-1 px-3 rounded-md' disabled>Booked</button>";
            } else {
                echo "<a href='rooms-booking.php?id=" . urlencode($id_room) . "' class='absolute right-0 md:mr-16 mr-5 mt-14 custom-button py-1 px-3 rounded-md'>Book Now</a>";
            }
            ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar text-white px-6 py-4">
        <nav class="">
            <div>
                <a href="#"><img src="images/logo_putih.png" alt="Logo" class=" h-12 rounded-md" /></a>
            </div>

            <div>
                <?php if (!isset($auth_user)) : ?>
                <?php else : ?>
                    <ul class="batas text-xl space-y-4 pt-3">
                    <?php endif ?>
                    <li><a href="#room" class="custom-underline sidebar-border">Villas</a></li>
                    <li><a href="#fasilitas" class="custom-underline sidebar-border">Facilities</a></li>
                    <li><a href="booking-detail.php" class="custom-underline sidebar-border">My Booking</a></li>
                    <li>
                        <?php if (!isset($auth_user['username'])) : ?>
                            <a href="auth/register.php" class="custom-underline sidebar-border">Register</a>
                        <?php endif ?>
                    </li>
                    <li>
                        <?php if (!is_null($auth_user['username'])) : ?>
                            <a href="/auth/logout.php" class="custom-underline sidebar-border">Log Out</a>
                        <?php else : ?>
                            <a href="/auth/login.php" class="custom-underline sidebar-border">Sign In</a>
                        <?php endif ?>
                    </li>
                    </ul>
            </div>
        </nav>
    </div>
    </div>
    
    <footer class="max-md:mt-32 md:fixed bottom-0 left-0 right-0 bg-card text-card-foreground py-4 border-t border-border bg-emerald-700">
    <div class="container mx-auto text-center text-md text-white">
        <p>
        © Copyright Pemuda Inguh, Villas Resort Tegallalang, JL Pantai Gili Trawangan, Gili Indah, Pemenang, Kabupaten Gianyar, Gili Indah, Bali, Indonesia 83352
        </p>
    </div>
    </footer>
    <script src="js/hamburger.js"></script>
</body>

</html>