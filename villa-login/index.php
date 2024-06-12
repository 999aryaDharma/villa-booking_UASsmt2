<?php
require_once "koneksi.php";
session_start();
if (!isset($_SESSION['auth_id'])) {
    header("Location:/login.php");
};

$query = "SELECT username FROM belajar_login WHERE id = {$_SESSION['auth_id']}";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
} else {
    $username = "Tidak ditemukan"; 
};

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Pemuda Inguh Villa</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="dist/output.css" rel="stylesheet" />
		<link href="src/input.css" rel="stylesheet" />
		<style></style>
	</head>
	<body class="m-0 p-0">

		<header>
			<nav class="fixed top-0 left-0 w-full flex justify-between px-5 py-2 items-center border-b-1 border-transparent text-white nav-blur z-50">
				<div>
					<a href="#"><img src="images/logo.png" alt="Logo" class="h-12 bg-slate-200 px-2 rounded-md bg-transparent" /></a>
				</div>
				<div>
					<ul class="flex gap-10 text-xl">
						<li><a href="#room" class="custom-underline">Villas</a></li>
						<li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
						<li><a href="#" class="custom-underline">Contact & Booking</a></li>
						<li><a href="logout.php" class="text-white bg-red-800 hover:bg-red-950 px-4 py-1.5 rounded-md">Log-out</a></li>
					</ul>
				</div>
			</nav>
			<div class="bg-cover bg-fixed bg-no-repeat bg-center min-h-screen nav-overlay" style="background-image: url('images/relax-area-resort.jpg')">
				<div class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black bg-opacity-25">
					<h1 class="text-4xl font-bold mb-4">Welcome to Our Villas</h1>
					<p class="mb-4 text-xl mt-0"><i>Experience the best stay with us</i></p>
					<a href="#" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto">Book Now</a>
				</div>
			</div>
		</header>
		<main class="">
			<!-- SECTION ABOUT -->
			<div class="flex items-center p-5">
				<div class="md:w-1/2 px-20">
					<h2 class="text-3xl font-bold mb-2">About Us</h2>
					<p class="my-4 text-lg">Villa kami menawarkan suasana yang tenang dan pemandangan yang indah, yang bisa membuat anda bersantai bersama keluarga, teman-teman, atau pasangan</p>
					<a href="#" class="inline-block custom-button px-6 py-2 rounded-md text-center">Read More</a>
				</div>
				<div class="md:w-1/2 max-w-xl p-14">
					<img src="images/swimming-pool-resort.jpg" alt="Villa Image" class="max-w-xl min-h-60 rounded bg-cover" />
				</div>
			</div>
			<!-- END ABOUT -->

			<!-- ROOM CARDS -->
			<div class="flex flex-wrap justify-center gap-14 pt-16" id="room">
				<div class="max-w-2xl max-h-full dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden flex">
					<img class="w-2/3 h-auto object-cover" src="images/room1.jpg" alt="Hotel Image" />
					<div class="w-1/3 p-6 text-center font-mono font-thin">
						<h2 class="text-xl font-bold">Suite Room</h2>
						<p class="text-md mt-3">Max: <span class="font-semibold">3 Persons</span></p>
						<p class="text-md">Size: <span class="font-semibold">45 m2</span></p>
						<p class="text-md">View: <span class="font-semibold">Sea View</span></p>
						<p class="text-md">Bed: <span class="font-semibold">1</span></p>
						<a href="#" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View Details</a>
					</div>
				</div>
				<div class="max-w-2xl dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden flex">
					<img class="w-2/3 h-auto object-cover" src="images/room2.jpg" alt="Hotel Image" />
					<div class="w-1/3 p-6 text-center font-mono font-thin">
						<h2 class="text-xl font-bold">Suite Room</h2>
						<p class="text-md mt-3">Max: <span class="font-semibold">3 Persons</span></p>
						<p class="text-md">Size: <span class="font-semibold">45 m2</span></p>
						<p class="text-md">View: <span class="font-semibold">Sea View</span></p>
						<p class="text-md">Bed: <span class="font-semibold">1</span></p>
						<a href="#" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View Details</a>
					</div>
				</div>
				<div class="max-w-2xl dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden flex">
					<img class="w-2/3 h-auto object-cover" src="images/room3.jpg" alt="Hotel Image" />
					<div class="w-1/3 p-6 text-center font-mono font-thin">
						<h2 class="text-xl font-bold">Suite Room</h2>
						<p class="text-md mt-3">Max: <span class="font-semibold">3 Persons</span></p>
						<p class="text-md">Size: <span class="font-semibold">45 m2</span></p>
						<p class="text-md">View: <span class="font-semibold">Sea View</span></p>
						<p class="text-md">Bed: <span class="font-semibold">1</span></p>
						<a href="#" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View Details</a>
					</div>
				</div>
				<div class="max-w-2xl bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden flex">
					<img class="w-2/3 h-auto object-cover" src="images/photorealistic-wooden-house-interior-with-timber-decor-furnishings (1).jpg" alt="Hotel Image" />
					<div class="w-1/3 p-6 text-center font-mono font-thin">
						<h2 class="text-xl font-bold">Suite Room</h2>
						<p class="text-md mt-3">Max: <span class="font-semibold">3 Persons</span></p>
						<p class="text-md">Size: <span class="font-semibold">45 m2</span></p>
						<p class="text-md">View: <span class="font-semibold">Sea View</span></p>
						<p class="text-md">Bed: <span class="font-semibold">1</span></p>
						<a href="#" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View Details</a>
					</div>
				</div>
			</div>
			<!-- END ROOM CARDS -->

			<!-- Fasilitas 'what we offer' -->
			<div class="flex flex-col md:flex-row mt-12" id="fasilitas">
				<div class="relative w-full max-w-xl ml-16 mr-14 max-h-min pt-16">
					<div class="carousel-item active">
						<img class="w-full h-full object-cover" src="images/room1.jpg" alt="Slide 1" />
					</div>
					<div class="carousel-item next">
						<img class="w-full h-full object-cover" src="images/room2.jpg" alt="Slide 2" />
					</div>
					<div class="carousel-item next">
						<img class="w-full h-full object-cover" src="images/room3.jpg" alt="Slide 3" />
					</div>
				</div>
				<div class="md:w-1/2 mb-28 pt-16">
					<h2 class="text-4xl font-bold mb-4">What we offer</h2>
					<p class="text-zinc-600 mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
					<div class="space-y-6 grid grid-cols-2">
						<div class="flex items-start mt-6">
							<div class="bg-orange-200 text-white rounded-full p-4 mr-4">
								<img src="https://placehold.co/40x40" alt="Tea Coffee" aria-hidden="true" />
							</div>
							<div class="pr-8">
								<h3 class="text-xl font-semibold">Tea Coffee</h3>
								<p class="text-zinc-600">A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
						<div class="flex items-start">
							<div class="bg-orange-200 text-white rounded-full p-4 mr-4">
								<img src="https://placehold.co/40x40" alt="Hot Showers" aria-hidden="true" />
							</div>
							<div class="pr-8">
								<h3 class="text-xl font-semibold">Hot Showers</h3>
								<p class="text-zinc-600">A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
						<div class="flex items-start">
							<div class="bg-orange-200 text-white rounded-full p-4 mr-4">
								<img src="https://placehold.co/40x40" alt="Laundry" aria-hidden="true" />
							</div>
							<div class="pr-8">
								<h3 class="text-xl font-semibold">Laundry</h3>
								<p class="text-zinc-600">A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
						<div class="flex items-start">
							<div class="bg-orange-200 text-white rounded-full p-4 mr-4">
								<img src="https://placehold.co/40x40" alt="Air Conditioning" aria-hidden="true" />
							</div>
							<div class="pr-8">
								<h3 class="text-xl font-semibold">Air Conditioning</h3>
								<p class="text-zinc-600">A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
						<div class="flex items-start">
							<div class="bg-orange-200 text-white rounded-full p-4 mr-4">
								<img src="https://placehold.co/40x40" alt="Free Wifi" aria-hidden="true" />
							</div>
							<div class="pr-8">
								<h3 class="text-xl font-semibold">Free Wifi</h3>
								<p class="text-zinc-600">A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
						<div class="flex items-start">
							<div class="bg-orange-200 text-white rounded-full p-4 mr-4">
								<img src="https://placehold.co/40x40" alt="Kitchen" aria-hidden="true" />
							</div>
							<div class="pr-8">
								<h3 class="text-xl font-semibold">Kitchen</h3>
								<p class="text-zinc-600">A small river named Duden flows by their place and supplies it with the necessary</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Fasilitas 'what we offer' -->

			<!-- FOOTER -->
			<div class="bg-green-800 text-white p-6 px-40">
				<div class="max-w-7xl grid grid-cols-1 md:grid-cols-4 gap-8">
					<div>
						<h3 class="font-bold mb-2 text-xl">Pemuda Inguh Villa</h3>
						<p>Welcome to Pemuda Inguh Villas</p>
					</div>
					<div class="text-xl">
						<h3 class="font-bold mb-2">Services</h3>
						<ul>
							<li class="mt-2">Map Direction</li>
							<li class="mt-2">Accomodation Services</li>
							<li class="mt-2">Great Experiences</li>
							<li class="mt-2">Perfect Central Location</li>
						</ul>
					</div>
					<div>
						<h3 class="font-bold mb-2 text-xl">Follow Us</h3>
						<div class="flex space-x-2">
							<img src="https://placehold.co/24x24" alt="Instagram" class="w-6 h-6" />
							<img src="https://placehold.co/24x24" alt="Twitter" class="w-6 h-6" />
							<img src="https://placehold.co/24x24" alt="YouTube" class="w-6 h-6" />
						</div>
					</div>
					<div class="text-xl">
						<h3 class="font-bold mb-2">Visit Us</h3>
						<p class="italic">Our Location</p>
					</div>
				</div>
			</div>
			<!-- END FOOTER -->
		</main>
		<script src="js/main.js"></script>
	</body>
</html>