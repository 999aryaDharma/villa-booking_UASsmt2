//navbar blur
window.addEventListener("scroll", function () {
	const navbar = document.querySelector("nav");
	if (window.scrollY > 50) {
		navbar.classList.add("scrolled");
	} else {
		navbar.classList.remove("scrolled");
	}
});

const items = document.querySelectorAll(".carousel-item");
let index = 0;
setInterval(() => {
	items[index].classList.remove("active");
	index = (index + 1) % items.length;
	items[index].classList.add("active");
}, 3000);

document.getElementById("hamburger-button").addEventListener("click", function () {
	var mobileMenu = document.getElementById("mobile-menu");
	mobileMenu.classList.toggle("hidden");
});



// Fungsi untuk mendapatkan parameter dari URL
function getURLParameter(name) {
    return new URLSearchParams(window.location.search).get(name);
}

// Fungsi untuk mengupdate tampilan tombol berdasarkan status login
function updateAuthButton() {
    const authButton = document.getElementById('authButton');
    const isLoggedIn = getURLParameter('loggedIn');
    
    if (isLoggedIn === 'true') {
        const username = getURLParameter('username');
        authButton.innerText = `Logout`;
        authButton.onclick = logoutUser; // Mengubah fungsi tombol menjadi logout
    } else {
        authButton.innerText = 'Sign In';
        authButton.onclick = loginUser; // Mengubah fungsi tombol menjadi login
    }
}

// Fungsi untuk login
function loginUser() {
    const username = 'username'; // Gantilah dengan mekanisme login yang sesungguhnya
    window.location.search = `?loggedIn=true&username=${username}`;
}

// Fungsi untuk logout
function logoutUser() {
    window.location.search = `?loggedIn=false`;
}

// Panggil fungsi untuk mengupdate tampilan saat halaman dimuat

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



// // Fungsi untuk mengupdate tampilan tombol berdasarkan status login
// function updateLoginStatus() {
// 	const loginButton = document.getElementById("loginButton");
// 	const isLoggedIn = localStorage.getItem("isLoggedIn");
// 	if (isLoggedIn === "true") {
// 		const username = localStorage.getItem("username");
// 		loginButton.innerText = `Hello, ${username}`;
// 		loginButton.onclick = null; // Menonaktifkan fungsi login
// 	} else {
// 		loginButton.innerText = "Sign In";
// 		loginButton.onclick = loginUser; // Mengaktifkan kembali fungsi login
// 	}
// }

// // Ketika pengguna login berhasil
// function loginUser() {
//     // Simpan status login di localStorage
//     localStorage.setItem('isLoggedIn', 'true');
//     // Anda dapat menyimpan informasi pengguna lainnya jika diperlukan
//     localStorage.setItem('username', 'namaPengguna');
//     // Ubah tampilan tombol
//     updateLoginStatus();
// }

// // Ketika pengguna logout
// function logoutUser() {
//     // Hapus status login dari localStorage
//     localStorage.removeItem('isLoggedIn');
//     localStorage.removeItem('username');
//     // Ubah tampilan tombol
//     updateLoginStatus();
// }

// // Panggil fungsi untuk mengupdate tampilan saat halaman dimuat
// document.addEventListener("DOMContentLoaded", updateLoginStatus);
