<?php
require_once "../../function.php";
$auth_user = getUserById($_SESSION['auth_id'] ?? null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="/dist/output.css" rel="stylesheet" />
	<link href="/src/input.css" rel="stylesheet" />
</head>
<body>
    <aside>
        <div class="fixed pt-20 bg-slate-400 h-full w-48 pl-7">
            <ul>
                <li class="hover:text-white"><a class="flex my-2" href="../style/index.php"><svg class="mr-2"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg> Home</a></li>
                <li class="hover:text-white"><a class="flex my-5" href="../admins/admin-page.php"><svg class="mr-2"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg> Admin</a></li>
                <li class="hover:text-white"><a class="flex my-5" href="../rooms-admin.php/show-rooms.php"><svg class="mr-2"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 17v-3h-20" /><path d="M2 8v9" /><path d="M12 14h10v-2a3 3 0 0 0 -3 -3h-7v5z" /></svg> Rooms</a></li>
                <li class="hover:text-white"><a class="flex my-5" href="../bookings-admin/show-bookings.php"><svg class="mr-2"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg> Bookings</a></li>
            </ul>
        </div>
    </aside>
    <header>
        <nav class="fixed top-0 w-full flex justify-between px-32 py-3 items-center text-white bg-slate-600">
            <div>
				<a href="#"><img src="/images/logo_putih.png" alt="Logo" class="h-12 px-2 rounded-md" /></a>
			</div>

            <div>
                <ul class="flex gap-10 text-xl">
                <?php if(!isset($_SESSION['auth_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../../auth/login.php">login
                        </a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="">Home</a>
                    </li>
                
                    <li class="nav-item dropdown float-left overflow-hidden">
                        <a class="nav-link  dropdown-toggle flex" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $auth_user ?><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
                        <div class="dropdown-menu hidden absolute bg-white p-2.5 shadow-xl border w-35" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item float-none text-black flex text-sm" href="../../auth/logout.php"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg> Log Out</a>
                        </div>
                    </li>
                <?php endif; ?>   
                </ul>
            </div>
        </nav>
    </header>
</body>
</html>