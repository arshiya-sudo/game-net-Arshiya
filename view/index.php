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

    <script>
        // آرایه‌ای برای ذخیره سیستم‌ها
        let systems = [];

        // اضافه کردن سیستم جدید
        function addSystem() {
            const name = document.getElementById("newName").value;
            const cost = document.getElementById("newCost").value;
            const date = document.getElementById("newDate").value;

            if (name && cost && date) {
                const system = {
                    name,
                    cost,
                    date,
                    details: [] // آرایه‌ای برای ذخیره جزئیات هر سیستم
                };

                systems.push(system);
                renderSystems();
            } else {
                alert("لطفا همه فیلدها را پر کنید.");
            }
        }

        // نمایش سیستم‌ها در جدول
        function renderSystems() {
            const systemList = document.getElementById("systemList");
            systemList.innerHTML = '';

            systems.forEach((system, index) => {
                const row = document.createElement("tr");

                row.innerHTML = `
          <td>${system.name}</td>
          <td>${system.cost}</td>
          <td>${system.date}</td>
          <td>
            <button onclick="showDetails(${index})">جزئیات</button>
            <button onclick="editSystem(${index})">ویرایش</button>
            <button onclick="deleteSystem(${index})">حذف</button>
          </td>
        `;

                systemList.appendChild(row);
            });
        }

        // نمایش جزئیات سیستم
        function showDetails(index) {
            const system = systems[index];
            const detailsList = document.getElementById("detailsList");
            detailsList.innerHTML = '';

            // افزودن رکوردهای پرداخت به جدول جزئیات
            system.details.forEach(detail => {
                const row = document.createElement("tr");

                // اطلاعات جزئیات پرداخت شامل تاریخ، ساعت شروع، ساعت پایان و مبلغ دریافتی
                row.innerHTML = `
          <td>${detail.date}</td>
          <td>${detail.startTime}</td>
          <td>${detail.endTime}</td>
          <td>${detail.amount}</td>
        `;

                detailsList.appendChild(row);
            });

            // نمایش modal جزئیات
            document.getElementById("detailsModal").style.display = "flex";
        }

        // بستن modal جزئیات
        function closeDetails() {
            document.getElementById("detailsModal").style.display = "none";
        }

        // ویرایش سیستم
        function editSystem(index) {
            const system = systems[index];
            const name = prompt("نام سیستم جدید:", system.name);
            const cost = prompt("هزینه/ثانیه جدید:", system.cost);
            const date = prompt("تاریخ سرویس جدید:", system.date);

            if (name && cost && date) {
                systems[index] = {
                    name,
                    cost,
                    date,
                    details: system.details // جزئیات سیستم حفظ می‌شود
                };
                renderSystems();
            }
        }

        // حذف سیستم
        function deleteSystem(index) {
            systems.splice(index, 1);
            renderSystems();
        }

        // اضافه کردن یک رکورد پرداخت به سیستم
        function addPaymentDetail(systemIndex, date, startTime, endTime, amount) {
            const detail = {
                date,
                startTime,
                endTime,
                amount
            };
            systems[systemIndex].details.push(detail); // اضافه کردن رکورد به سیستم
        }
    </script>

</body>

</html>