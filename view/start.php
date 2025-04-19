<?php
include('db.php');  // اتصال به دیتابیس

if (isset($_POST['system_id'])) {
    $system_id = $_POST['system_id'];
    $start_time = date('Y-m-d H:i:s');  // زمان شروع بازی

    // ثبت زمان شروع بازی در دیتابیس (می‌توانید این رو در جدول جدیدی ذخیره کنید)
    $sql = "INSERT INTO payments (system_id, start_time) VALUES ('$system_id', '$start_time')";
    
    if ($conn->query($sql) === TRUE) {
        echo "بازی با موفقیت شروع شد!";
    } else {
        echo "خطا در شروع بازی: " . $conn->error;
    }
}

$conn->close();  // بستن اتصال به دیتابیس
?>
