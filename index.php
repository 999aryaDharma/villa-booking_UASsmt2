<?php
	include "include/header.php";
	// require "function.php";
	
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
						<!-- start -->
						<div>
							<div>
								<label for="tw-modal" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View details</label>
							</div>
							<!-- ini adalah hidden toggle -->
							<input type="checkbox" id="tw-modal" class="peer fixed-appearance-none opacity-0">
							<label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer 
							items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 
							transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100
							peer-checked:[&>*]:scale-100 ">
								<label class="max-h-[calc(100vh - 5em)] h-fit max-w-lg scale-90 overflow-y-auto 
								overscroll-contain rounded-md bg-white p-6 text-black shadow-2xl transition" for="">
									<h3 class="text-lg font-bold">Room 1's details</h3>
									<p class="py-4">ROOM 1.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
								</label>
							</label>
						</div>
						<!-- end -->
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
						<div>
							<div>
								<label for="tw-modal" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View details</label>
							</div>
							<!-- ini adalah hidden toggle -->
							<input type="checkbox" id="tw-modal" class="peer fixed-appearance-none opacity-0">
							<label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer 
							items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 
							transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100
							peer-checked:[&>*]:scale-100 ">
								<label class="max-h-[calc(100vh - 5em)] h-fit max-w-lg scale-90 overflow-y-auto 
								overscroll-contain rounded-md bg-white p-6 text-black shadow-2xl transition" for="">
									<h3 class="text-lg font-bold">Room 2's details</h3>
									<p class="py-4">ROOM 2.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
								</label>
							</label>
						</div>
						<!-- end -->
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
						<div>
							<div>
								<label for="tw-modal" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View details</label>
							</div>
							<!-- ini adalah hidden toggle -->
							<input type="checkbox" id="tw-modal" class="peer fixed-appearance-none opacity-0">
							<label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer 
							items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 
							transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100
							peer-checked:[&>*]:scale-100 ">
								<label class="max-h-[calc(100vh - 5em)] h-fit max-w-lg scale-90 overflow-y-auto 
								overscroll-contain rounded-md bg-white p-6 text-black shadow-2xl transition" for="">
									<h3 class="text-lg font-bold">Room 3's details</h3>
									<p class="py-4">ROOM 3.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
								</label>
							</label>
						</div>
						<!-- end -->
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
						<div>
							<div>
								<label for="tw-modal" class="inline-block custom-button px-6 py-2 rounded-md text-center mt-4">View details</label>
							</div>
							<!-- ini adalah hidden toggle -->
							<input type="checkbox" id="tw-modal" class="peer fixed-appearance-none opacity-0">
							<label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer 
							items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 
							transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100
							peer-checked:[&>*]:scale-100 ">
								<label class="max-h-[calc(100vh - 5em)] h-fit max-w-lg scale-90 overflow-y-auto 
								overscroll-contain rounded-md bg-white p-6 text-black shadow-2xl transition" for="">
									<h3 class="text-lg font-bold">Room 4's details</h3>
									<p class="py-4">ROOM 4.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
									<p class="py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.</p>
								</label>
							</label>
						</div>
						<!-- end -->
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
			<script src="js/main.js"></script>
			<!-- END Fasilitas 'what we offer' -->
<?php
include_once "include/footer.php";
?>
