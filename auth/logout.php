<?php
require_once "../function.php";
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy();
logoutUser();
