<?php
include('db.php');  // اتصال به دیتابیس

if (isset($_POST['system_id'])) {
    $system_id = $_POST['system_id'];
    $end_time = date('Y-m-d H:i:s');  // زمان پایان بازی

    // گرفتن زمان شروع بازی
    $sql = "SELECT start_time FROM payments WHERE system_id = '$system_id' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $start_time = $result->fetch_assoc()['start_time'];

    // محاسبه مدت زمان بازی
    $start_timestamp = strtotime($start_time);
    $end_timestamp = strtotime($end_time);
    $duration = $end_timestamp - $start_timestamp;  // مدت زمان به ثانیه

    // گرفتن هزینه هر ثانیه برای سیستم
    $sql = "SELECT cost_per_second FROM systems WHERE id = '$system_id'";
    $result = $conn->query($sql);
    $cost_per_second = $result->fetch_assoc()['cost_per_second'];

    // محاسبه مبلغ دریافتی
    $amount = $duration * $cost_per_second;

    // به‌روزرسانی جدول پرداخت‌ها
    $sql = "UPDATE payments SET end_time = '$end_time', amount = '$amount' WHERE system_id = '$system_id' AND end_time IS NULL";
    if ($conn->query($sql) === TRUE) {
        echo "بازی به پایان رسید. مبلغ دریافتی: " . $amount . " تومان.";
    } else {
        echo "خطا در پایان بازی: " . $conn->error;
    }
}

$conn->close();  // بستن اتصال به دیتابیس
?>
