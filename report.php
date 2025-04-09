<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify</title>
    <link rel="stylesheet" href="style/report.css">
</head>
<body>
    <div class="header-container">
        <h1 class="company-name" id="company-name"></h1>
        <img src="images/inventify-logo-ffffff.png" alt="logo" class="icon-style">
        <div class="icon-container">
            <img src="images/notification-icon-ffffff.png" alt="Notification" class="icon-style-con">
            <img src="images/logout-icon-ffffff.png" alt="Logout" class="icon-style-con">
        </div>
    </div>
    <div class="side-container">
        <div class="navigation-container" id="dashboard-nav">
            <img src="images/dashboard-icon-ffffff.png" alt="Dashboard" class="logo-style">
            <h1 class="h1-style">DASHBOARD</h1>
        </div>
        <div class="navigation-container" id="accounts-nav">
            <img src="images/account-icon-ffffff.png" alt="Accounts" class="logo-style">
            <h1 class="h1-style">ACCOUNTS</h1>
        </div>
        <div class="navigation-container" id="categories-nav">
            <img src="images/categories-icon-ffffff.png" alt="Categories" class="logo-style">
            <h1 class="h1-style">CATEGORIES</h1>
        </div>
        <div class="navigation-container" id="suppliers-nav">
            <img src="images/suppliers-icon-ffffff.png" alt="Suppliers" class="logo-style">
            <h1 class="h1-style">SUPPLIERS</h1>
        </div>
        <div class="navigation-container" id="items-nav">
            <img src="images/items-icon-ffffff.png" alt="Items" class="logo-style">
            <h1 class="h1-style">ITEMS</h1>
        </div>
        <div class="navigation-container" id="report-nav">
            <img src="images/report-icon-ffffff.png" alt="Report" class="logo-style">
            <h1 class="h1-style">REPORT</h1>
        </div>
        <div class="space">
            
        </div>
    </div>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="reportcss.css">
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <span class="hamburger-icon">☰</span>
            <span class="top-bar-title">Report</span>
        </div>
        <div class="top-bar-center">
            <img src="logo.png" alt="Logo" class="top-bar-logo">
        </div>
        <div class="top-bar-right">
            <button class="notification-icon">🔔</button>
            <button class="logout-icon">🚪</button>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
            </div>
            <ul class="sidebar-menu">
                <li>DASHBOARD</li>
                <li>ACCOUNTS</li>
                <li>WAREHOUSE</li>
                <li>SUPPLIERS</li>
                <li>CATEGORIES</li>
                <li>ITEMS</li>
                <li class="active">REPORT</li>
            </ul>
        </div>

        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <div class="date-picker">
                        <span class="arrow left-arrow">◄</span>
                        <input type="text" value="11/12/2024" readonly>
                        <span class="arrow right-arrow">►</span>
                    </div>
                    <div class="actions">
                        <button><span class="print-icon">🖨️</span></button>
                        <button><span class="download-icon">⬇️</span></button>
                    </div>
                </div>
            </div>
            <div class="calendar-popup">
                <div class="calendar">
                    <div class="calendar-header">
                        <button class="prev-month">◄</button>
                        <span class="month-year"></span>
                        <button class="next-month">►</button>
                    </div>
                    <div class="calendar-days">
                        <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                    </div>
                    <div class="calendar-dates"></div>
                </div>
            </div>
            <div class="content-wrapper">
                <div class="table-wrapper">
                    <table class="large-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Cost Price</th>
                                <th>Selling Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="summary">
                        <div class="summary-item">
                            <span>Grand Total</span>
                            <span>₱0.00</span>
                        </div>
                        <div class="summary-item">
                            <span>Profit</span>
                            <span>₱0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const datePicker = document.querySelector('.date-picker');
            const calendarPopup = document.querySelector('.calendar-popup');
            const dateInput = datePicker.querySelector('input');
            const monthYear = document.querySelector('.month-year');
            const calendarDates = document.querySelector('.calendar-dates');
            const prevMonth = document.querySelector('.prev-month');
            const nextMonth = document.querySelector('.next-month');
            let currentDate = new Date();

            function renderCalendar(date) {
                const year = date.getFullYear();
                const month = date.getMonth();
                monthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;
                calendarDates.innerHTML = '';
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                for (let i = 0; i < firstDay; i++) {
                    calendarDates.innerHTML += '<div></div>';
                }
                for (let day = 1; day <= daysInMonth; day++) {
                    const dateDiv = document.createElement('div');
                    dateDiv.textContent = day;
                    dateDiv.addEventListener('click', () => {
                        dateInput.value = `${month + 1}/${day}/${year}`;
                        calendarPopup.style.display = 'none';
                    });
                    calendarDates.appendChild(dateDiv);
                }
            }

            datePicker.addEventListener('click', function (e) {
                e.stopPropagation();
                calendarPopup.style.display = calendarPopup.style.display === 'block' ? 'none' : 'block';
                renderCalendar(currentDate);
            });

            document.addEventListener('click', function (event) {
                if (!datePicker.contains(event.target) && !calendarPopup.contains(event.target)) {
                    calendarPopup.style.display = 'none';
                }
            });

            prevMonth.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate);
            });

            nextMonth.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate);
            });

            const notificationIcon = document.querySelector('.notification-icon');
            const notificationPanel = document.querySelector('.notification-panel');

            notificationIcon.addEventListener('click', function () {
                notificationPanel.classList.toggle('active');
            });

            document.addEventListener('click', function (event) {
                if (!notificationIcon.contains(event.target) && !notificationPanel.contains(event.target)) {
                    notificationPanel.classList.remove('active');
                }
            });

            const logoutIcon = document.querySelector('.logout-icon');
            logoutIcon.addEventListener('click', function () {
                alert('Logging out...');
            });
        });
    </script>
</body>
</html>
    <script src="js/report.js"></script>
    <script src="js/company-name.js"></script>
</body>
</html>