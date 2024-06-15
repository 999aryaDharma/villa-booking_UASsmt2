<?php
    require "../function.php";
    // Memeriksa jika pengguna sudah login, langsung arahkan ke halaman yang sesuai
    // Proses form login saat formulir disubmit
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama_customer = $_POST["username"];
        $password = $_POST["password"];
        $error = loginUser($nama_customer, $password);
        if ($error) {
            echo $error; // Tampilkan pesan error jika ada
        }
    }

	if (isset($_POST['submit'])) {
        // loginAdmin($_POST['username'], $_POST['password'], $_POST[$valid_users]);
		$response = loginUser($_POST['username'], $_POST['password']);
	}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="dist/output.css" rel="stylesheet" />
    <link href="../src/input.css" rel="stylesheet" />
    <title>Sign in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Nunito+Sans:opsz,wght@6..12,200&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        h1,h2,h3,h4,h5,h6 {
            font-family: 'Montserrat',sans-serif;
        }
        p,label {
            font-family: 'Nunito',sans-serif;
            font-size: 20px;
            line-height: 30px;
            color: #6c757d;
        }
        .h-p {
            padding-top: 80px;
            padding-bottom: 80px;
        }
        body {
            background-image: url(/images/photorealistic-wooden-house-interior-with-timber-decor-furnishings.jpg);
        }
    </style>
</head>
<body class="bg-emerald-500 flex justify-center items-center h-screen bg-cover bg-fixed bg-no-repeat bg-center">
    <div class="bg-white w-3/5 rounded-xl p-7 shadow-inner">
        <div class="flex items-center mb-3"> 
            <img src="images/logo.png" alt="" class="h-10">
            <h1 class="text-sm font-bold custom-color1">Pemuda Inguh</h1>
        </div>
        <div id="sign_in" class="flex">
            <div id="image" class="w-3/5">
                <img src="images/swimming-pool-resort.jpg" alt="" class="h-72">
            </div>
            <div class="w-3/5">
                <div class="ml-4">
                    <div class="mb-3">
                        <h1 class="text-2xl font-bold custom-color2">Sign In</h1>
                    </div>
                        <form action="" method="POST">
                            <div class="mb-4">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="<?= @$_POST['username']; ?>" autocomplete="username" required placeholder="Username" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm"> 
                            </div>
                            <div class="mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" value="<?= @$_POST['password']; ?>" autocomplete="current-password" required placeholder="Password" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm">
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <input type="checkbox" id="remember-me" name="remember-me" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-zinc-300 dark:border-zinc-700 rounded">
                                    <label for="remember-me" class="ml-2 text-sm text-zinc-900 dark:text-zinc-300">Remember Me</label>
                                </div>
                    
                                <div class="text-sm">
                                    <a href="#" class="font-medium custom-color1 hover:text-emerald-400">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="text-center font-thin">
                            </div>
                            <div>
                                <p class="text-red-600"><?= @$response; ?> </p>
                            </div>
                            <div>
                                <button type="submit" class="w-full text-sm font-medium rounded-md px-3 py-2 mb-4 custom-button" value="Login">Sign In</button>
                            </div>

                            <div class="text-center">
                                <p class="text-slate-500 text-sm">Don't have an account? <a href="register.php" class="custom-color1 hover:text-emerald-400 text-sm">Sign Up</a></p>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
