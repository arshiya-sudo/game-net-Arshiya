<?php
// اطلاعات اتصال به دیتابیس
$servername = "localhost";  // آدرس سرور
$username = "root";         // نام کاربری دیتابیس
$password = "";             // رمز عبور دیتابیس
$dbname = "game_net";       // نام دیتابیس

// ایجاد اتصال به دیتابیس
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("اتصال به دیتابیس موفقیت‌آمیز نبود: " . $conn->connect_error);
}
?>
