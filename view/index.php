
<?php
// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "gamenet");
if ($conn->connect_error) {
    die("خطا در اتصال به دیتابیس: " . $conn->connect_error);
}

// گرفتن لیست سیستم‌ها
$sql = "SELECT * FROM systems";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>گیم‌نت</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>

<body>

    <h2>لیست سیستم‌ها</h2>

<!-- دکمه مدیریت -->
<button class="btn" onclick="location.href='manage_systems.php'">مدیریت سیستم‌ها</button>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="system">
            <h3><?php echo $row['name']; ?></h3>
            <p>تاریخ آخرین سرویس: <?php echo $row['last_service_date']; ?></p>
            <p>هزینه هر ثانیه: <?php echo $row['price_per_second']; ?> تومان</p>
            <button class="btn" onclick="location.href='start.php?system_id=<?php echo $row['id']; ?>'">شروع</button>
            <button class="btn" onclick="location.href='end.php?system_id=<?php echo $row['id']; ?>'">پایان</button>
            <button class="btn" onclick="showDetails(<?php echo $row['id']; ?>)">جزئیات</button>
        </div>
        
    <?php endwhile; ?>

    <script>
        // فقط نمایش پیام فعلا، بعدا این‌ها با AJAX یا PHP تکمیل میشن
        function startTimer(id) {
            let duration = prompt("مدت زمان تقریبی استفاده (به ثانیه):");
            if (duration) {
                // اینجا میشه AJAX زد یا فرم مخفی فرستاد
                alert("سیستم " + id + " برای " + duration + " ثانیه شروع شد.");
            }
        }

        function endTimer(id) {
            alert("سیستم " + id + " به پایان رسید. محاسبه هزینه...");
        }

        function showDetails(id) {
            window.location.href = "details.php?system_id=" + id;
        }
    </script>

</body>

</html>