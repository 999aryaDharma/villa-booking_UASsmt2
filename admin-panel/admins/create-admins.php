<?php
  include_once "../layout/header.php";
  require_once "function-admin.php";

  if(isset($_POST['submit'])) {
      $response = registerAdmin($_POST['nama_customer'], $_POST['email'], $_POST['password'], $_POST['confirm-password']);
    }

?>

<main class="pl-56 pt-24 pr-9">
    <div class="border-2 border-inherit shadow-xl w-full p-5">
        <div>
            <h1 class="font-bold pb-4">Add Admin</h1>
        </div>
        <div>
            <form action="" method="POST">
                <div>
                    <label for="username">Username :</label>
                    <input type="text" name="nama_customer" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['nama_customer']; ?>" />
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="text" name="email" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['email']; ?>">
                </div>
                <div>
                    <label for="password">Password :</label>
                    <input type="password" name="password" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['password']; ?>">
                </div>
                <div>
                    <label for="password"> Confirm Password :</label>
                    <input type="password" name="confirm-password" class="w-full px-3 py-2 mb-3 border-2 rounded focus:border-1 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-400 focus:z-10 sm:text-sm" value="<?= @$_POST['confirm-password']; ?>">
                </div>
                        <?php
                            if (isset($response)) {
                                if ($response == "Success") {
                                    echo "<p class='text-green-500 mb-2'>Your Registration was Successful</p>";
                                } else {
                                    echo "<p class='text-red-600 mb-2'>$response</p>";
                                }
                            }
                        ?>
                <button type="submit" name="submit" class=" btn custom-button px-3 py-1 rounded-md">Add</button>
            </form>
        </div>
    </div>
</main>