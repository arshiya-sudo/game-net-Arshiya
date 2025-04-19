
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
      const detail = { date, startTime, endTime, amount };
      systems[systemIndex].details.push(detail); // اضافه کردن رکورد به سیستم
    }