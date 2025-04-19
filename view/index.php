<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../asset/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت سیستم‌های گیم‌نت</title>

</head>

<body>

    <!-- هدر -->
    <header>
        مدیریت سیستم‌های گیم‌نت
    </header>

    <!-- بخش افزودن سیستم -->
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

    <script>
        let systems = [{
                id: 1,
                name: "سیستم 1",
                cost: 3,
                lastService: "1402/10/01"
            },
            {
                id: 2,
                name: "سیستم 2",
                cost: 2,
                lastService: "1402/11/15"
            }
        ];

        function renderSystems() {
            const list = document.getElementById("systemList");
            list.innerHTML = "";

            systems.forEach(system => {
                const row = document.createElement("tr");

                row.innerHTML = `
          <td>${system.name}</td>
          <td>${system.cost} تومان</td>
          <td>${system.lastService}</td>
          <td>
            <button class="btn btn-edit" onclick="editSystem(${system.id})"><i class="fas fa-edit icon"></i> ویرایش</button>
            <button class="btn btn-delete" onclick="deleteSystem(${system.id})"><i class="fas fa-trash-alt icon"></i> حذف</button>
          </td>
        `;
                list.appendChild(row);
            });
        }

        function deleteSystem(id) {
            if (confirm("آیا مطمئن هستید؟")) {
                systems = systems.filter(sys => sys.id !== id);
                renderSystems();
            }
        }

        function editSystem(id) {
            const sys = systems.find(s => s.id === id);
            const newName = prompt("نام جدید سیستم:", sys.name);
            const newCost = prompt("هزینه جدید به ازای هر ثانیه:", sys.cost);
            const newDate = prompt("تاریخ آخرین سرویس:", sys.lastService);

            if (newName && newCost && newDate) {
                sys.name = newName;
                sys.cost = parseInt(newCost);
                sys.lastService = newDate;
                renderSystems();
            }
        }

        function addSystem() {
            const name = document.getElementById("newName").value;
            const cost = parseInt(document.getElementById("newCost").value);
            const date = document.getElementById("newDate").value;

            if (!name || !cost || !date || cost <= 0) {
                alert("لطفاً همه فیلدها را پر کنید.");
                return;
            }

            const newId = systems.length > 0 ? systems[systems.length - 1].id + 1 : 1;
            systems.push({
                id: newId,
                name,
                cost,
                lastService: date
            });

            document.getElementById("newName").value = "";
            document.getElementById("newCost").value = "";
            document.getElementById("newDate").value = "";

            renderSystems();
        }

        renderSystems();
    </script>

</body>

</html>