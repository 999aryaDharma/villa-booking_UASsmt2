<?php 
require_once "function.php";
$auth_user = getUserById($_SESSION['auth_id'] ?? null);
if (!isset($_SESSION['auth_id'])) {
    header("Location: /auth/register.php");
    exit();
} 
?>




<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="dist/output.css" rel="stylesheet" />
		<link href="src/input.css" rel="stylesheet" />
		<title>Villa Room</title>
	</head>
	<body>
		<div class="relative min-h-screen bg-cover bg-center dark:bg-zinc-900" style="background-image: url('images/room1.jpg')">
			<div class="absolute right-0 inset-0 bg-black opacity-50"></div>
			<div class="absolute z-10 p-10 top-32">
				<h1 class="text-white text-2xl">Welcome <?= $auth_user ?? " " ?> to Pemuda Inguh Villas</h1>
				<h2 class="text-zinc-400 text-4xl font-bold mt-4">Room PHP</h2>
			</div>
			<div class="absolute top-1/4 right-1/4 transform translate-x-1/2 bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full min-h-64">
				<h3 class="text-2xl mb-4 font-thin">Book this room</h3>
				<form class="space-y-4">
					<input type="email" placeholder="email@gmail.com" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
					<input type="text" placeholder="username" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
					<input type="password" placeholder="password" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
					<div class="flex space-x-4">
						<input type="date" placeholder="check-in" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
						<input type="date" placeholder="check-out" class="w-full p-2 border border-zinc-300 rounded bg-zinc-300" />
					</div>
					<button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white py-2 rounded">BOOK AND PAY NOW</button>
				</form>
			</div>
		</div>
	</body>
</html>
