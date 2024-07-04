<?php
    // require "koneksi.php";
    require "../function.php";
    // var_dump($_POST);
    if(isset($_POST['submit'])) {
      $response = registerUser($_POST['nama_customer'], $_POST['alamat'], $_POST['email'], $_POST['no_telepon'], $_POST['password'], $_POST['confirm-password']);
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
		<title>Register</title>
	</head>
	<body class="flex justify-center items-center h-screen bg-cover bg-fixed bg-no-repeat bg-center" style="background-image: url('images/photorealistic-wooden-house-interior-with-timber-decor-furnishings.jpg');">
		<div class="bg-white md:w-3/5 rounded-xl shadow-inner">
            <div id="sign_up" class="flex p-5">

                <div class="md:flex flex-wrap w-full">
                    <!-- Left Section -->
                    <div class="w-full md:w-1/2 pr-5">
                        <div class="flex items-center mb-3">
                            <img src="images/logo.png" alt="" class="h-10">
                            <h1 class="text-sm font-bold custom-color1">Pemuda Inguh</h1>
                        </div>
                        <div class="mb-3">
                            <h1 class="text-2xl custom-color2">Sign Up</h1>
                        </div>
                        <form action="" method="POST" autocomplete="off">
                            <div class="mb-4">
                                <label for="username">Username</label>
                                <input type="text" name="nama_customer" id="nama_customer" autocomplete="nama_customer" required placeholder="Nama" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['nama_customer']; ?>"> 
                            </div>
                            <div class="mb-4">
                                <label for="address">Alamat</label>
                                <input type="text" name="alamat" required placeholder="Alamat" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['alamat']; ?>"> 
                            </div>
                
                            <div class="mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" autocomplete="current-password" required placeholder="Password" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['password']; ?>">
                            </div>
                    </div>
                    <!-- Right Section -->
                    <div class="w-full md:w-1/2 md:mt-24 pr-5">
                            <div class="mb-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" autocomplete="email" required placeholder="Email Address" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['email']; ?>"> 
                            </div>
                            <div class="mb-4">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="no_telepon"  required placeholder="Phone Number" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['no_telepon']; ?>"> 
                            </div>
                            
                            <!-- <div class="mb-4 md:hidden">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" autocomplete="current-password" required placeholder="Password" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['password']; ?>">
                            </div> -->
                            <div class="mb-4">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" name="confirm-password" id="confirm-password" autocomplete="current-password" required placeholder="Confirm Password" class="w-full px-3 py-2 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['confirm-password']; ?>">
                            </div>
                            
                    </div>
                    <div class="w-full pr-5">
                        <?php
                            if (isset($response)) {
                                if ($response == "Success") {
                                    echo "<p class='text-green-500 mb-2'>Your Registration was Successful</p>";
                                } else {
                                    echo "<p class='text-red-600 mb-2'>$response</p>";
                                }
                            }
                        ?>
                        <div>
                            <button type="submit" class="w-full text-sm font-medium rounded-md px-3 py-2 custom-button" name="submit" value="register">Sign Up</button>
                        </div>
                        <div class="text-center">
                            <p class="text-slate-500 text-sm mt-3">Already have an account? <a href="login.php" class="custom-color1 hover:text-emerald-400 text-sm">Login Here</a></p>
                        </div>
                    </div>
                </form>
                
                </div>
                
                <!-- Image Section -->
                <div id="image" class="w-full grid place-items-center mt-10 max-md:hidden">
                    <img src="images/swimming-pool-resort.jpg" alt="" class="h-96">
                </div>

	</body>
</html>
