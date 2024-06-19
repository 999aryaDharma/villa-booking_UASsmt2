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

<body class="m-0 p-0 font-serif">
    <!-- Header -->
    <header class="">
        <nav class=" fixed top-0 left-0 w-full flex justify-between px-5 py-2 items-center border-b-1 border-transparent text-white nav-blur z-50">
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
        <!-- Header End -->

        <!-- About Us -->
        <div class="py-40 px-40 flex justify-center items-center text-center text-white bg-cover bg-fixed bg-no-repeat bg-center min-h-screen nav-overlay" style="background-image: url('images/blur-bg.png')">
            <div class="object-center mx-20 lg:mx-auto">
                <div class="min-w-xl max-w-5xl">
                    <h2 class="text-3xl font-bold mb-2">- About Us -</h2>
                    <p class="my-4 text-2xl italic leading-loose tracking-widest">
                        Villa Kami dirancang dengan gaya arsitektur klasik yang elegan.
                        Dengan luas yang cukup untuk menampung keluarga besar atau rombongan teman.
                        Balkon yang ditawarkan, memungkinkan anda menikmati pemandangan sekitar secara leluasa.
                    </p>
                </div>
            </div>
        </div>
    </header>

    <!-- The Scenery  -->
    <div class="text-3xl font-bold my-40 text-center">
        <h2>- The Scenery -</h2>
    </div>

    <div class="flex items-center mb-16 justify-start pl-20 w-7xl">
        <div class=" md:w-1/2">
            <img src="images/pegunungan-hijau.jpg" alt="Pemandangan-Hijau-image" class="drop-shadow-2xl rounded bg-cover" />
        </div>
        <div class="md:w-1/2 p-5 mr-12 text-left">
            <h2 class="text-2xl font-bold mb-2">Pemandangan Hijau</h2>
            <p class="my-4 text-lg italic">
                Villa kami menawarkan pemandangan alam yang luar biasa dari setiap sudutnya.
                Dari balkon kamar tidur hingga teras kolam renang.
                Anda akan disuguhi pemandangan perbukitan hijau yang memanjakan mata.
            </p>
        </div>
    </div>

    <div class="flex items-center justify-end pr-20 pt-40 w-7xl">
        <div class=" md:w-1/2 p-5 ml-12 text-right">
            <h2 class="text-2xl font-bold mb-2">Hutan Tropis</h2>
            <p class="my-4 text-lg italic">
                Hutan tropis di sekitar villa menambah keindahan alam dengan pepohonan rindang dan bunga-bunga berwarna-warni yang bermekaran sepanjang tahun.
                Suara burung berkicau dan gemericik air dari kolam membuat suasana semakin damai dan relaks.
            </p>
        </div>
        <div class="md:w-1/2">
            <img src="images/hutan-tropis.jpg" alt="Hutan-tropis-image" class="drop-shadow-2xl rounded bg-cover" />
        </div>
    </div>

    <div class="text-3xl  pt-40 text-center">
        <h2 class="font-bold">- The Night View -</h2>
        <p class="text-lg mx-28 mt-5">
            Pada malam hari, langit berbintang yang jernih menawarkan pengalaman menatap bintang yang sempurna, jauh dari polusi cahaya kota.
            Suara alam yang tenang serta udara segar pegunungan menambah kesan magis pada malam hari,
            membuat Anda merasa benar-benar terhubung dengan alam semesta.
        </p>
    </div>
    <div class="flex justify-center">
        <img src="images/pemandangan-malam.jpg" alt="Hutan-tropis-image" class="max-w-5xl drop-shadow-2xl rounded bg-cover mb-16 mt-12 object-center" />
    </div>
    <!-- The Scenery  End -->
    <!-- About Us End -->

    <!-- Footer -->
    <?php require_once "include/footer.php"; ?>
    <!-- Footer End -->

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