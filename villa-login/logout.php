<?php
session_start();

unset($_SESSION['auth_id']);

header("Location: /login.php");
die();

