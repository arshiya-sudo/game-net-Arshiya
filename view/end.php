<?php
$conn = new mysqli("localhost", "root", "", "gamenet");
if ($conn->connect_error) {
    die("خطا در اتصال: " . $conn->connect_error);
}

$system_id = isset($_GET['system_id']) ? (int) $_GET['system_id'] : 0;
$end_time = date("Y-m-d H:i:s");

// گرفتن رکورد آخر بدون پایان
$sql = "SELECT * FROM usages WHERE system_id = $system_id AND end_time IS NULL ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usage = $result->fetch_assoc();
    $start = strtotime($usage['start_time']);
    $end = strtotime($end_time);
    $duration = $end - $start;

    // گرفتن قیمت هر ثانیه
    $price_sql = "SELECT price_per_second FROM systems WHERE id = $system_id";
    $price_result = $conn->query($price_sql);
    $price_row = $price_result->fetch_assoc();
    $price_per_second = $price_row['price_per_second'];

    $total_price = $duration * $price_per_second;

    // به‌روزرسانی رکورد
    $update = "UPDATE usages SET end_time='$end_time', total_price=$total_price WHERE id=" . $usage['id'];
    if ($conn->query($update)) {
        echo "استفاده با موفقیت پایان یافت.<br>";
        echo "مدت زمان: $duration ثانیه<br>";
        echo "مبلغ قابل دریافت: $total_price تومان";
    } else {
        echo "خطا: " . $conn->error;
    }

} else {
    echo "استفاده فعالی برای این سیستم پیدا نشد.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../asset/style-e.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<br><a href="index.php">بازگشت</a>
