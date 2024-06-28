<?php 
// require "koneksi.php";
require "function.php";
// $id = $_GET['id'];
// // require "admin-panel/rooms-admin.php/function-room.php";
// $id_room = $_SESSION['id_room'];
$auth_user = getUserById($_SESSION['auth_id'] ?? null );
// $rooms = getAllRoom($id);
if (isset($_GET['id'])) {
    $id_room = $_GET['id'];

    global $conn;
    $sql = "SELECT room.id_room, room.nama, room.harga, room.num_beds, room.deskripsi, room.status, GROUP_CONCAT(room_foto.foto) AS foto, GROUP_CONCAT(fasilitas.nama_fasilitas) AS fasilitas
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
    $room = $result->fetch_assoc();
    $photos = explode(',', $room['foto']);

    // if ($room) {
    //     // Tampilkan detail room
    //     echo "<h1>" . $room['nama'] . "</h1>";
    //     echo "<p>Harga: " . $room['harga'] . "</p>";
    //     echo "<p>Jumlah Tempat Tidur: " . $room['num_beds'] . "</p>";
    //     echo "<p>Deskripsi: " . $room['deskripsi'] . "</p>";
    //     echo "<p>Status: " . $room['status'] . "</p>";
    //     echo "<p>Foto: " . $room['foto'] . "</p>";
    //     echo "<p>Fasilitas: " . $room['fasilitas'] . "</p>";
    // } else {
    //     echo "Room not found.";
    // }
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
	<script src="js/main.js"></script>
</head>
<body class="">
    <nav class="fixed top-0 left-0 w-full flex justify-between px-5 py-2 items-center border-b-1 bg-neutral-400 text-white nav-blur z-50">
			<div>
				<a href="#"><img src="images/logo.png" alt="Logo" class="h-12 px-2 rounded-md" /></a>
			</div>
			<div>
				<ul class="flex gap-10 text-xl">
					<li><a href="#room" class="custom-underline">Villas</a></li>
					<li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
					<li><a href="rooms-booking.php" class="custom-underline">Contact & Booking</a></li>
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
    <div class="p-20 bg-card text-card-foreground mt-4 pt-20">
        <button onclick="window.location.href='index.php#room';" type="button" class="flex items-center justify-center px-3 mb-4 text-sm custom-button rounded-lg">
            <svg class="w-8 h-8 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
        </button>
    <div class="flex flex-col md:flex-row">
        <div class="w-1/2 relative">
        <?php foreach ($photos as $photo): ?>
        <?php endforeach; ?>
        <img src="admin-panel/rooms-admin.php/images/<?= trim($photo) ?>" alt="Room image" class="room-image rounded">
        <span class="bg-green-500 text-white text-sm font-semibold px-2 py-1 rounded-full absolute top-4 left-4">Available</span>
        </div>
        <div class="w-1/2  md:pl-6 mt-6 md:mt-0 ml-4">
            <h2 class="text-2xl font-bold"><?= $room['nama'] ?></h2>
            <p class="mt-2 text-muted-foreground"><?= $room['deskripsi'] ?></p>
            <hr class="mt-3">
            <h2 class="text-xl font-semiboldbold mt-1">Facilities</h2>
            <ul class="mt-4 list-disc list-inside space-y-1">
            <?php
                $query = "SELECT fasilitas.nama_fasilitas
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
                foreach ($facilities as $facility) {
                    echo "<li>" . htmlspecialchars($facility) . "</li>";
                }
            } else {
                echo "<li>No facilities available.</li>";
            }
            ?>
            </ul>
            <button class="mt-4 px-4 py-2 bg-primary text-primary-foreground custom-button rounded-md absolute right-0 mr-16">Book Now</button>
        </div>
    </div>
    </div>
</body>
</html>
<?php 
include "include/footer.php"
?>