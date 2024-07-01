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

$auth_user = getUserById($_SESSION['auth_id'] ?? null);
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

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
</head>

<body class="m-0 p-0">
    <!-- Header -->
    <header class="">
        <nav class="fixed top-0 left-0 w-full flex justify-between px-5 py-2 items-center border-b-1 border-transparent text-white nav-blur z-50">
            <div>
                <a href="index.php"><img src="images/logo.png" alt="Logo" class="h-12 bg-slate-200 px-2 rounded-md" /></a>
            </div>
            <div>
                <ul class="flex gap-10 text-xl">
                    <li><a href="#room" class="custom-underline">Villas</a></li>
                    <li><a href="#fasilitas" class="custom-underline">Facilities</a></li>
                    <li><a href="auth/register.php" class="custom-underline">Register</a></li>
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
        <!-- Header End -->

        <!-- About Us -->
        <div class="font-serif py-40 px-40 flex justify-center items-center text-center text-white bg-cover bg-fixed bg-no-repeat bg-center min-h-screen nav-overlay" style="background-image: url('images/blur-bg.png')">
            <div class="object-center mx-20 lg:mx-auto">
                <div class="min-w-xl max-w-5xl">
                    <h2 class="text-3xl font-bold mb-2">- About Us -</h2>
                    <p class="my-4 text-2xl italic leading-loose tracking-widest">
                        Our villa is designed with elegant classical architecture. 
                        It offers ample space to accommodate a large family or a group of friends comfortably. 
                        The spacious balconies provide the perfect setting to freely enjoy the beautiful surrounding views and soak in the serene atmosphere.
                    </p>
                </div>
            </div>
        </div>
    </header>

    <!-- The Scenery  -->
    <div class="font-serif">
        <div class="text-3xl font-bold my-40 text-center">
            <h2>- The Scenery -</h2>
        </div>

        <div class="flex items-center mb-16 justify-start pl-20 pr-36 w-7xl">
            <div class=" md:w-2/6" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-offset="300">
                <img src="images/pegunungan-hijau.jpg" alt="Pemandangan-Hijau-image" class="drop-shadow-2xl rounded bg-cover" />
            </div>
            <div class="md:w-2/3 pl-16 mr-12 text-left" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-offset="300" data-aos-delay="300">
                <h2 class="text-2xl font-bold mb-2">Pemandangan Hijau</h2>
                <p class="my-4 text-lg italic">
                    Our villa offers stunning natural views from every angle. From the bedroom balcony to the pool terrace, you will be treated to the sight of lush green hills. 
                    Enjoy the peaceful ambiance and immerse yourself in nature's beauty during your stay.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end pr-20 pl-36 mt-36 mb-16 w-7xl">
            <div class=" md:w-2/3 pr-16 ml-12 text-right" data-aos="fade-left" data-aos-easing="ease-in-sine" data-aos-offset="300" data-aos-delay="300">
                <h2 class="text-2xl font-bold mb-2">Hutan Tropis</h2>
                <p class="my-4 text-lg italic">
                    The tropical forest surrounding the villa enhances the natural beauty with its lush trees and colorful flowers blooming year-round. 
                    The sound of chirping birds and the gentle trickle of water from the pond add to the peaceful and relaxing atmosphere.
                </p>
            </div>
            <div class="md:w-2/6" data-aos="fade-left" data-aos-easing="ease-in-sine" data-aos-offset="300">
                <img src="images/hutan-tropis.jpg" alt="Hutan-tropis-image" class="drop-shadow-2xl rounded bg-cover" />
            </div>
        </div>

        <div class="flex items-center mt-36 mb-16 justify-start pl-20 pr-36 w-7xl">
            <div class=" md:w-2/6" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-offset="300">
                <img src="images/zany-jadraque-ZCRtfop2hZY-unsplash.jpg" alt="Pemandangan-Sunset-image" class="drop-shadow-2xl rounded bg-cover" />
            </div>
            <div class="md:w-2/3 pl-16 mr-12 text-left" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-offset="300" data-aos-delay="300">
                <h2 class="text-2xl font-bold mb-2">Pemandangan Sunset</h2>
                <p class="my-4 text-lg italic">
                    Watching the sunset is an experience not to be missed. 
                    As the sun begins to set, the sky transforms into a spectacular canvas with gradients of orange, red, and purple, creating a magical and romantic atmosphere.
                </p>
            </div>
        </div>

        <div class="text-3xl mt-36 text-center" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-offset="300" data-aos-delay="300">
            <h2 class="font-bold">- The Night View -</h2>
            <p class="text-lg mx-28 mt-5">
                At night, the clear starry sky offers a perfect stargazing experience, far from the city's light pollution. 
                The tranquil sounds of nature and the fresh mountain air enhance the magical ambiance, making the nights truly special. 
                As you gaze at the stars, you feel a deep sense of connection with the universe, surrounded by the serene beauty of the natural world.
            </p>
        </div>
        <div class="flex justify-center" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-offset="300">
            <img src="images/pemandangan-malam.jpg" alt="Hutan-tropis-image" class="max-w-3xl w-[70rem] h-72 drop-shadow-2xl rounded bg-cover mb-16 mt-12 object-center" />
        </div>
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

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>

</html>