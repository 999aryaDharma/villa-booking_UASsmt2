<?php
require "function.php";
// Menangani login
if (isset($_GET['login'])) {
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = 'username'; // Gantilah dengan mekanisme login yang sesungguhnya
    header("Location: index.php");
    exit();
}

// Menangani logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: auth/login.php");
    exit();
}

if (isset($_GET['logout'])) {
		logoutUser();
	}

$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
$username = $loggedIn ? $_SESSION['username'] : '';
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
					<ul class="flex gap-10 text-xl">
						<li><a href="#room" class="custom-underline">Villas</a></li>
						<li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
						<li><a href="#" class="custom-underline">Contact & Booking</a></li>
						<li><a id="authButton" onclick="handleAuth()"><?php echo $loggedIn ? 'Logout' : 'Sign In'; ?></a></li>
					</ul>
				</div>
			</nav>
			<div class="bg-cover bg-fixed bg-no-repeat bg-center min-h-screen nav-overlay" style="background-image: url('images/relax-area-resort.jpg')">
				<div class="absolute inset-0 flex flex-col justify-center items-center text-white bg-black bg-opacity-25">
					<h1 class="text-4xl font-bold mb-4">Welcome <?=$_SESSION['username'] ?> to Our Villas</h1>
					<p class="mb-4 text-xl mt-0"><i>Experience the best stay with us</i></p>
					<a href="#" class="inline-block btn bg-orange-600 hover:bg-orange-800 px-6 py-2 rounded-md text-center pointer-events-auto">Book Now</a>
				</div>
			</div>
		</header>
		<script>
        // Mengambil status login dan username dari PHP
        const loggedIn = <?php echo json_encode($loggedIn); ?>;
        const username = <?php echo json_encode($username); ?>;

        // Fungsi untuk menangani autentikasi
        function handleAuth() {
            if (loggedIn) {
                window.location.href = '?logout';
            } else {
                window.location.href = '?login';
            }
        }

        // Fungsi untuk mengupdate tampilan tombol berdasarkan status login
        function updateAuthButton() {
            const authButton = document.getElementById('authButton');
            if (loggedIn) {
                authButton.innerText = `Sign In`;
                authButton.onclick = () => window.location.href = '?logout';
            } else {
                authButton.innerText = 'Log Out';
                authButton.onclick = () => window.location.href = 'auth/login.php';
            }
        }

        // Panggil fungsi untuk mengupdate tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updateAuthButton);
    </script>
  </body>
</html>