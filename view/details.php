<?php
// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "gamenet");
if ($conn->connect_error) {
    die("خطا در اتصال به دیتابیس: " . $conn->connect_error);
}

// گرفتن آی‌دی سیستم از URL
$system_id = isset($_GET['system_id']) ? (int) $_GET['system_id'] : 0;

// گرفتن اطلاعات سیستم
$system_sql = "SELECT * FROM systems WHERE id = $system_id";
$system_result = $conn->query($system_sql);
$system = $system_result->fetch_assoc();

// گرفتن استفاده‌های این سیستم
$usage_sql = "SELECT * FROM usages WHERE system_id = $system_id ORDER BY start_time DESC";
$usage_result = $conn->query($usage_sql);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>جزئیات سیستم</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: sans-serif;
            direction: rtl;
        }
        .usage {
            background-color: #1e1e1e;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
        }
        a {
            color: #0af;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>جزئیات سیستم: <?php echo $system['name']; ?></h2>
<p><a href="index.php">بازگشت به لیست</a></p>

<?php if ($usage_result->num_rows > 0): ?>
    <?php while ($row = $usage_result->fetch_assoc()): ?>
        <div class="usage">
            <p>تاریخ: <?php echo date("Y/m/d", strtotime($row['start_time'])); ?></p>
            <p>شروع: <?php echo date("H:i:s", strtotime($row['start_time'])); ?></p>
            <p>پایان: <?php echo $row['end_time'] ? date("H:i:s", strtotime($row['end_time'])) : '---'; ?></p>
            <p>مبلغ دریافتی: <?php echo $row['total_price'] ?? '---'; ?> تومان</p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>هیچ استفاده‌ای برای این سیستم ثبت نشده است.</p>
<?php endif; ?>

</body>
</html>
