<?php
// require "koneksi.php";
require_once "function.php";
$auth_user = getUserById($_SESSION['auth_id'] ?? null);

//   // Memeriksa apakah pengguna sudah login
//   if (!isset($_SESSION['auth_id'])) {
//     header("location: /auth/login.php");
//     exit();
//   }

//   if (!isset($_SESSION['role'])) {
//     echo "Access Denied. You do not have permission to access this page.";
//     exit();
//   }

//   // Memeriksa apakah pengguna memiliki peran admin
//   if ($_SESSION ['role'] !== 1) {
//     echo "Access Denied. You do not have permission to access this page.";
//     exit();
//   }
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pemuda Inguh Villa</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="dist/output.css" rel="stylesheet" />
	<link href="../src/input.css" rel="stylesheet" />
	<link href="../src/loader.css" rel="stylesheet" />
	<link href="../src/hamburger.css" rel="stylesheet" />
	<script src="../js/main.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

	<script src="../js/loader.js"></script>

</head>

<body class="m-0 p-0">
	<header>
		<!-- Loader -->
		<div id="custom-loader">
			<div class="spinner"></div>
		</div>
		<!-- Loader -->

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

		<nav class="hidden md:flex md:items-center md:space-x-4 fixed top-0 left-0 w-full justify-between px-5 py-2 items-center border-b-1 border-transparent text-white nav-blur z-50">
			<div>
				<a href="#"><img src="images/logo_putih.png" alt="Logo" class="h-12 px-2" /></a>
			</div>

			<div>
				<?php if (!isset($auth_user)) : ?>
					<ul class="flex space-x-20 text-xl">
					<?php else : ?>
						<ul class="flex space-x-5 text-xl">
						<?php endif ?>
						<li><a href="#room" class="custom-underline">Villas</a></li>
						<li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
						<li><a href="rooms-booking.php" class="custom-underline">Contact & Booking</a></li>
						<li><a href="booking-detail.php" class="custom-underline">My Booking</a></li>
						<li>
							<?php if (!isset($auth_user['username'])) : ?>
								<a href="auth/register.php" class="custom-underline">Register</a>
							<?php endif ?>
						</li>
						<li>
							<?php if (!is_null($auth_user['username'])) : ?>
								<a href="/auth/logout.php" class="custom-underline">Log Out</a>
							<?php else : ?>
								<a href="/auth/login.php" class="custom-underline">Sign In</a>
							<?php endif ?>
						</li>
						</ul>
			</div>
		</nav>
		<div class="bg-cover bg-fixed bg-no-repeat bg-center min-h-screen nav-overlay" style="background-image: url('images/relax-area-resort.jpg')">
			<div class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black bg-opacity-25">
				<h1 class="md:text-4xl text-2xl font-bold mb-4">Welcome <?= $auth_user['username'] ?? " " ?> to Our Villas</h1>
				<p class="mb-4 text-xl mt-0"><i>Experience the best stay with us</i></p>
				<a href="about-us.php" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto">About Us</a>
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
						<li><a href="rooms-booking.php" class="custom-underline sidebar-border">Contact & Booking</a></li>
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
		<!-- Sidebar END -->

		<!-- Overlay -->
		<div id="overlay" class="overlay"></div>
		<!-- Overlay END -->


	</header>

	<script src="js/hamburger.js"></script>
</body>

</html>