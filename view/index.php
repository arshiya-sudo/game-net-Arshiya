<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../././asset/style.css">
    <title>مدیریت گیم‌نت</title>

</head>

<body>

    <h2>💻 مدیریت سیستم‌های گیم‌نت 💻</h2>

    <table>
        <thead>
            <tr>
                <th>نام سیستم</th>
                <th>تایمر</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <!-- سیستم 1 -->
            <tr>
                <td>سیستم 1</td>
                <td class="timer" id="timer-1">--:--</td>
                <td>
                    <button onclick="startTimer(1)">شروع</button>
                    <button onclick="stopTimer(1)">پایان</button>
                    <button onclick="showDetails(1)">جزئیات</button>
                </td>
            </tr>

            <!-- سیستم 2 -->
            <tr>
                <td>سیستم 2</td>
                <td class="timer" id="timer-2">--:--</td>
                <td>
                    <button onclick="startTimer(2)">شروع</button>
                    <button onclick="stopTimer(2)">پایان</button>
                    <button onclick="showDetails(2)">جزئیات</button>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- start js -->
    <script>
        // نگهداری تایمرها با id سیستم
        const timers = {};

        // تابع شروع تایمر
        function startTimer(id) {
            const minutes = prompt("⏱ مدت زمان تقریبی (دقیقه):");
            if (!minutes || isNaN(minutes) || minutes <= 0) {
                return alert("لطفاً یک عدد معتبر وارد کنید.");
            }
            // تبدیل دقیه به ثانیه
            let totalSeconds = parseInt(minutes) * 60;
            const timerEl = document.getElementById("timer-" + id);

            // حذف تایمر قبلی اگر وجود داشته
            if (timers[id]) clearInterval(timers[id]);

            // شروع شمارش معکوس
            timers[id] = setInterval(() => {
                const mins = Math.floor(totalSeconds / 60);
                const secs = totalSeconds % 60;
                timerEl.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

                if (totalSeconds <= 0) {
                    clearInterval(timers[id]);
                    alert("✅ زمان سیستم " + id + " به پایان رسید.");
                }

                totalSeconds--;
            }, 1000);
        }

        // تابع پایان تایمر
        function stopTimer(id) {
            if (timers[id]) {
                clearInterval(timers[id]);
                document.getElementById("timer-" + id).textContent = "--:--";
                alert("⛔ تایمر سیستم " + id + " متوقف شد.");
            } else {
                alert("❗ تایمری برای این سیستم فعال نیست.");
            }
        }

        // تابع نمایش جزئیات (فعلاً فقط پیام)
        function showDetails(id) {
            alert("📋 جزئیات پرداختی‌های سیستم " + id + " در آینده نمایش داده می‌شود.");
        }
    </script>
    <!-- end js -->
    <div style="text-align:center; margin-top: 50px;">
        <a href="manage.html" style="text-decoration: none;">
            <button class="btn-manage">مدیریت سیستم‌ها ⚙️</button>
        </a>
    </div>




</body>

</html>