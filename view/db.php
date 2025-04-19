<?php
// اتصال به دیتابیس
$host = "localhost";
$user = "root";
$password = "";
$dbname = "game_net";

// ساخت اتصال
$conn = mysqli_connect($host, $user, $password, $dbname);

// بررسی اتصال
if (!$conn) {
    die("اتصال با دیتابیس ناموفق بود: " . mysqli_connect_error());
}

// تنظیم charset برای پشتیبانی از فارسی
mysqli_set_charset($conn, "utf8");
?>