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
		<link href="src/input.css" rel="stylesheet" />
		<script src="../js/main.js"></script>
	</head>
	<body class="m-0 p-0">
		<header>
			<nav class="fixed top-0 left-0 w-full flex justify-between px-5 py-2 items-center border-b-1 border-transparent text-white nav-blur z-50">
				<div>
					<a href="#"><img src="images/logo.png" alt="Logo" class="h-12 bg-slate-200 px-2 rounded-md" /></a>
				</div>
				<div>
					<?php if(!isset($auth_user)) : ?>
						<ul class="flex gap-10	 text-xl">
					<?php else : ?>
						<ul class="flex gap-4	 text-xl">
					<?php endif ?>
						<li><a href="#room" class="custom-underline">Villas</a></li>
						<li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
						<li><a href="rooms-booking.php" class="custom-underline">Contact & Booking</a></li>
						<li>
						<?php if(!isset($auth_user)) : ?>
							<a href="auth/register.php" class="custom-underline">Register</a>
						<?php endif ?>
						</li>
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
			<div class="bg-cover bg-fixed bg-no-repeat bg-center min-h-screen nav-overlay" style="background-image: url('images/relax-area-resort.jpg')">
				<div class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black bg-opacity-25">
					<h1 class="text-4xl font-bold mb-4">Welcome <?= $auth_user ?? " " ?> to Our Villas</h1>
					<p class="mb-4 text-xl mt-0"><i>Experience the best stay with us</i></p>
					<a href="rooms-booking.php" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto">Book Now</a>
				</div>
			</div>
		</header>
  </body>
</html>