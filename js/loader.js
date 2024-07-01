document.addEventListener("DOMContentLoaded", function () {
	const loader = document.getElementById("loader");

	function showLoader() {
		loader.style.visibility = "visible";
	}

	function hideLoader() {
		loader.style.visibility = "hidden";
	}

	// Tampilkan loader sebelum halaman baru dimuat
	window.addEventListener("beforeunload", showLoader);

	// Sembunyikan loader setelah halaman selesai dimuat
	window.addEventListener("load", hideLoader);

	// Menangani klik pada link di navbar
	document.querySelectorAll("nav a").forEach((anchor) => {
		anchor.addEventListener("click", function (e) {
			// Tampilkan loader
			showLoader();

			// Cek apakah link adalah anchor link
			if (this.getAttribute("href").startsWith("#")) {
				e.preventDefault();
				const targetId = this.getAttribute("href").substring(1);
				const targetElement = document.getElementById(targetId);

				// Scroll ke elemen target
				targetElement.scrollIntoView({ behavior: "smooth" });

				// Sembunyikan loader setelah scroll selesai
				setTimeout(hideLoader, 1000); // Durasi sesuai dengan waktu scroll
			}
		});
	});
});
