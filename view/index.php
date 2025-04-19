<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت سیستم‌های گیم‌نت</title>
    <link rel="stylesheet" href="../asset/style.css">

</head>

<body>

    <!-- هدر -->
    <header>
        مدیریت سیستم‌های گیم‌نت
    </header>

    <!-- فرم افزودن سیستم -->
    <div class="add-system">
        <h3>افزودن سیستم جدید</h3>
        <input type="text" id="newName" placeholder="نام سیستم" />
        <input type="number" id="newCost" placeholder="هزینه/ثانیه" />
        <input type="text" id="newDate" placeholder="تاریخ آخرین سرویس" />
        <button onclick="addSystem()">افزودن سیستم</button>
    </div>

    <!-- جدول سیستم‌ها -->
    <table id="systemTable">
        <thead>
            <tr>
                <th>نام سیستم</th>
                <th>هزینه/ثانیه</th>
                <th>تاریخ سرویس</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody id="systemList">
            <!-- سیستم‌ها به صورت داینامیک اضافه می‌شوند -->
        </tbody>
    </table>

    <!-- Modal نمایش جزئیات -->
    <div class="details-modal" id="detailsModal">
        <div class="details-content">
            <h3>جزئیات پرداخت‌ها</h3>
            <table>
                <thead>
                    <tr>
                        <th>تاریخ</th>
                        <th>ساعت شروع</th>
                        <th>ساعت پایان</th>
                        <th>مبلغ دریافتی</th>
                    </tr>
                </thead>
                <tbody id="detailsList">
                    <!-- جزئیات پرداخت‌ها در اینجا اضافه می‌شوند -->
                </tbody>
            </table>
            <button class="close-btn" onclick="closeDetails()">بستن</button>
        </div>
    </div>
    <!-- link js -->
   <script src="../asset/function.js">
   </script>

</body>

</html>