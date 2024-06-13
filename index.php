<?php
	include_once "include/header.php";
	// require "function.php";

	if (isset($_GET['login'])) {
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = 'nama_customer'; // Gantilah dengan mekanisme login yang sesungguhnya
    header("Location: index.php");
    exit();
	}

	if (isset($_GET['logout'])) {
		logoutUser();
	}

	$loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
	$username = $loggedIn ? $_SESSION['username'] : '';
?>
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
                authButton.innerText = `Logout`;
                authButton.onclick = () => window.location.href = '?logout';
            } else {
                authButton.innerText = 'Sign In';
                authButton.onclick = () => window.location.href = '?login';
            }
        }

        // Panggil fungsi untuk mengupdate tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updateAuthButton);
    </script>
			<!-- END Fasilitas 'what we offer' -->
<?php
include_once "include/footer.php";
?>
