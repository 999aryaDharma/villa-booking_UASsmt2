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

?>

<main class="mt-14">
	<link href="src/loader.css" rel="stylesheet" />
  	<script src="js/loader.js"></script>
	<!-- SECTION ABOUT -->
	

	<div id="default-carousel" class="relative w-full px-14" data-carousel="slide">
		<!-- Carousel wrapper -->
		<div class="relative h-56 overflow-hidden rounded-lg md:h-96">
			<!-- Item 1 -->
			<div class="hidden duration-700 ease-in-out" data-carousel-item>
				<img src="images/photorealistic-wooden-house-interior-with-timber-decor-furnishings (1).jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
			</div>
			<!-- Item 2 -->
			<div class="hidden duration-700 ease-in-out" data-carousel-item>
				<img src="images/photorealistic-wooden-house-interior-with-timber-decor-furnishings.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
			</div>
			<!-- Item 3 -->
			<div class="hidden duration-700 ease-in-out" data-carousel-item>
				<img src="images/room1.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
			</div>
			<!-- Item 4 -->
			<div class="hidden duration-700 ease-in-out" data-carousel-item>
				<img src="images/room3.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
			</div>
			<!-- Item 5 -->
			<div class="hidden duration-700 ease-in-out" data-carousel-item>
				<img src="images/swimming-pool-resort.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
			</div>
		</div>
		<!-- Slider indicators -->
		<div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
			<button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
			<button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
			<button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
			<button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
			<button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
		</div>
		<!-- Slider controls -->
		<button type="button" class="pl-20 absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
			<span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
				<svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
				</svg>
				<span class="sr-only">Previous</span>
			</span>
		</button>
		<button type="button" class="pr-20 absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
			<span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
				<svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
				</svg>
				<span class="sr-only">Next</span>
			</span>
		</button>
	</div>


	<!-- END ABOUT -->


	<!-- ROOM CARDS -->
	<div class="flex flex-wrap justify-center gap-14 pt-16" id="room">
		<?php foreach ($rooms as $room) : ?>
			<div class="max-w-2xl  max-h-80  dark:bg-zinc-800 rounded-lg shadow-2xl overflow-hidden flex">
				<?php foreach ($room['photos'] as $photo) : ?>
				<?php endforeach; ?>
				<img class="w-2/3 h-auto object-cover" src="admin-panel/rooms-admin.php/images/<?= trim($photo) ?>" alt="Hotel Image" />
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
				<img class="w-full h-full object-cover" src="images/room1.jpg" alt="Slide 1" />
			</div>
			<div class="carousel-item">
				<img class="w-full h-full object-cover" src="images/room2.jpg" alt="Slide 2" />
			</div>
			<div class="carousel-item">
				<img class="w-full h-full object-cover" src="images/room3.jpg" alt="Slide 3" />
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
	<!-- END Fasilitas 'what we offer' -->
	<?php
	include_once "include/footer.php";
	?>