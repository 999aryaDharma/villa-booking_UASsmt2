<?php
include "include/header.php";
// $id_room = $_POST['id_room'];
// require "function.php";
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
// $rooms = getAllRoom();
$auth_user = getUserById($_SESSION['auth_id'] ?? null);
global $conn;
$sql = "SELECT room.id_room, room.nama, room.harga, room.num_beds, room.deskripsi, room.status, GROUP_CONCAT(room_foto.foto) AS foto, GROUP_CONCAT(fasilitas.nama_fasilitas) AS fasilitas
        FROM room
        INNER JOIN room_foto ON room.id_room = room_foto.id_room
        INNER JOIN room_fasilitas ON room.id_room = room_fasilitas.id_room
        INNER JOIN fasilitas ON fasilitas.id_fasilitas = room_fasilitas.id_fasilitas
        GROUP BY room.id_room";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$rooms = [];
while ($row = $result->fetch_assoc()) {
	$row['photos'] = explode(',', $row['foto']);
	$rooms[] = $row;
}
$fasilitas = showRoom("SELECT * FROM fasilitas");

?>
<main class="">
	<link href="src/loader.css" rel="stylesheet" />
  <script src="js/loader.js"></script>
	<!-- SECTION ABOUT -->
	<div class="flex items-center p-5">
		<div class="md:w-1/2 px-20">
			<h2 class="text-3xl font-bold mb-2">About Us</h2>
			<p class="my-4 text-lg">Villa kami menawarkan suasana yang tenang dan pemandangan yang indah, yang bisa membuat anda bersantai bersama keluarga, teman-teman, atau pasangan</p>
			<a href="about-us.php" class="inline-block custom-button px-6 py-2 rounded-md text-center">Read More</a>
		</div>
		<div class="md:w-1/2 max-w-xl p-14">
			<img src="images/swimming-pool-resort.jpg" alt="Villa Image" class="max-w-xl min-h-60 rounded bg-cover" />
		</div>
	</div>

	<!-- END ABOUT -->


	<!-- ROOM CARDS -->
	<div class="flex flex-wrap justify-center gap-14 pt-16" id="room">
		<?php foreach ($rooms as $room) : ?>
			<div class="max-w-2xl  max-h-80  dark:bg-zinc-800 rounded-lg shadow-2xl overflow-hidden flex">
				<?php foreach ($room['photos'] as $photo) : ?>
				<?php endforeach; ?>
				<img class="w-2/3 h-auto object-cover" src="admin-panel/rooms-admin.php/images/<?= trim($photo) ?>" alt="Hotel Image" loading="lazy" />
				<div class="w-1/2 p-6 text-center font-mono font-thin">
					<h2 class="text-xl font-bold"><?= $room['nama'] ?></h2>
					<p class="text-md mt-4">Bed: <span class="font-semibold"><?= $room['num_beds'] ?></span></p>
					<p class="text-md mt-4"><span class="font-semibold">Price perNight : </span></p>
					<p class="text-md"><span class="font-semibold"> IDR <?= number_format($room['harga'], 2, ',', '.'); ?></span></p>
					<a href="view-details.php?id=<?= $room["id_room"]; ?>" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View Details</a>
				</div>
			</div>
		<?php endforeach ?>
	</div>

	<!-- END ROOM CARDS -->

	<!-- Fasilitas 'what we offer' -->
	<div class="flex flex-col md:flex-row mt-12" id="fasilitas">
		<div class="relative w-full max-w-xl ml-16 mr-14 max-h-min pt-16">
			<div class="carousel-item active z-0">
				<img class="w-full h-full object-cover" src="images/room1.jpg" alt="Slide 1" loading="lazy"/>
			</div>
			<div class="carousel-item">
				<img class="w-full h-full object-cover" src="images/room2.jpg" alt="Slide 2" loading="lazy"/>
			</div>
			<div class="carousel-item">
				<img class="w-full h-full object-cover" src="images/room3.jpg" alt="Slide 3" loading="lazy" />
			</div>
		</div>
		<div class="md:w-1/2 mb-28 pt-16">
			<h2 class="text-4xl font-bold mb-4">What we offer</h2>
			<p class="text-zinc-600 mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
			<div class="space-y-6 grid grid-cols-2">
				<?php
					$fasilitas = showRoom("SELECT * FROM fasilitas");
				?>
				<?php foreach ($fasilitas as $v) : ?>
					<div class="flex items-start mt-6">
						<div class="pr-8">
						<ul>
							<li>
								<h3 class="text-xl font-semibold"><?= $v['nama_fasilitas'] ?></h3>
								<p class="text-zinc-600"><?= $v['deskripsi'] ?>
							</li>
						</ul>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<script src="js/main.js"></script>
	<script>
    document.addEventListener("DOMContentLoaded", function() {
        var lazyloadImages = document.querySelectorAll(".lazyload");
        
        function lazyload() {
            lazyloadImages.forEach(function(img) {
                if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !== "none") {
                    img.src = img.dataset.src;
                    img.classList.remove('lazyload');
                }
            });
        }
        
        lazyload();
        
        window.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
    });
</script>
	<!-- END Fasilitas 'what we offer' -->
	<?php
	include_once "include/footer.php";
	?>