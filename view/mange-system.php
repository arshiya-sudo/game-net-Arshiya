<?php
$conn = new mysqli("localhost", "root", "", "gamenet");
if ($conn->connect_error) {
    die("خطا در اتصال: " . $conn->connect_error);
}

// حذف سیستم
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM systems WHERE id = $id");
    header("Location: manage_systems.php");
}

// افزودن سیستم
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $service = $_POST['last_service'];
    $price = (int) $_POST['price'];
    $conn->query("INSERT INTO systems (name, last_service_date, price_per_second) VALUES ('$name', '$service', $price)");
    header("Location: manage_systems.php");
}

// ویرایش سیستم
if (isset($_POST['edit'])) {
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $service = $_POST['last_service'];
    $price = (int) $_POST['price'];
    $conn->query("UPDATE systems SET name='$name', last_service_date='$service', price_per_second=$price WHERE id=$id");
    header("Location: manage_systems.php");
}

// گرفتن لیست سیستم‌ها
$systems = $conn->query("SELECT * FROM systems");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>مدیریت سیستم‌ها</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: sans-serif;
            direction: rtl;
        }
        .system, form {
            background-color: #1e1e1e;
            padding: 15px;
            margin: 10px 0;
            border-radius: 10px;
        }
        .btn {
            background-color: #444;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            margin: 2px;
        }
        input, select {
            padding: 5px;
            margin: 5px 0;
            border-radius: 5px;
            border: none;
        }
    </style>
</head>
<body>

<h2>مدیریت سیستم‌ها</h2>
<p><a href="index.php">بازگشت به صفحه اصلی</a></p>

<h3>افزودن سیستم جدید</h3>
<form method="POST">
    <input type="text" name="name" placeholder="نام سیستم" required><br>
    <input type="date" name="last_service" required><br>
    <input type="number" name="price" placeholder="هزینه هر ثانیه" required><br>
    <button class="btn" type="submit" name="add">افزودن</button>
</form>

<h3>لیست سیستم‌ها</h3>
<?php while ($row = $systems->fetch_assoc()): ?>
    <div class="system">
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="name" value="<?php echo $row['name']; ?>">
            <input type="date" name="last_service" value="<?php echo $row['last_service_date']; ?>">
            <input type="number" name="price" value="<?php echo $row['price_per_second']; ?>">
            <button class="btn" name="edit">ویرایش</button>
            <a href="?delete=<?php echo $row['id']; ?>" class="btn">❌ حذف</a>
        </form>
    </div>
<?php endwhile; ?>

</body>
</html>
