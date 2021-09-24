<?php 

require_once '../config/config.php';

// ambil fungsi logout

$user->logout();

// setelah logout berhasil maka redirect menuju ke login.php

header('location: login.php');



?>