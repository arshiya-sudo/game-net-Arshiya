    <?php
    $conn = new mysqli("localhost", "root", "", "gamenet");
    if ($conn->connect_error) {
        die("خطا در اتصال: " . $conn->connect_error);
    }

    $system_id = isset($_GET['system_id']) ? (int) $_GET['system_id'] : 0;
    $start_time = date("Y-m-d H:i:s");

    // شروع جدید را فقط اگر قبلاً شروع نشده، ثبت می‌کنیم
    // (یعنی رکوردی که end_time هنوز null هست برای اون سیستم وجود نداشته باشه)
    $check = $conn->query("SELECT * FROM usages WHERE system_id = $system_id AND end_time IS NULL");
    if ($check->num_rows == 0) {
        $sql = "INSERT INTO usages (system_id, start_time) VALUES ($system_id, '$start_time')";
        if ($conn->query($sql)) {
            echo "شروع ثبت شد.";
        } else {
            echo "خطا: " . $conn->error;
        }
    } else {
        echo "این سیستم در حال حاضر در حال استفاده است.";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../asset/style-s.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>
    <br><a href="index.php">بازگشت</a>
