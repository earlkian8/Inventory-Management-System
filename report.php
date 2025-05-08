<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventify - Report</title>
    <link rel="stylesheet" href="style/report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    
    <div class="header-container">
        <h1 class="company-name" id="company-name"></h1>
        <img src="images/inventify-logo-ffffff.png" alt="logo" class="icon-style">
        <div class="icon-container">
            <img src="images/notification-icon-ffffff.png" alt="Notification" class="icon-style-con" id="notificationIcon">
            <div class="notification-container" id="notificationContainer">
                <div class="notification-header">
                    <h3>Notifications</h3>
                </div>
                <div class="notification-content" id="notificationContent">
                </div>
            </div>
            <img src="images/logout-icon-ffffff.png" alt="Logout" class="icon-style-con" id="logoutId">
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
        <div class="navigation-container active" id="report-nav">
            <img src="images/report-icon-ffffff.png" alt="Report" class="logo-style">
            <h1 class="h1-style">REPORT</h1>
        </div>
        <div class="space">
            
        </div>
    </div>
    <div class="content-container">
        <div class="report-container">
            <div class="date-filter-container">
                <button class="date-nav-btn" id="prevDate"><</button>
                <div class="date-display" id="dateDisplay">11/12/2024</div>
                <button class="date-nav-btn" id="nextDate">></button>
                <button class="download-btn" id="downloadReport">
                <i class="fa-solid fa-download"></i>
                </button>
                <div class="filter-options">
                    <button class="filter-btn" id="todayBtn">Today</button>
                    <button class="filter-btn" id="yesterdayBtn">Yesterday</button>
                    <button class="filter-btn" id="thisWeekBtn">This Week</button>
                    <button class="filter-btn" id="lastWeekBtn">Last Week</button>
                    <button class="filter-btn" id="thisMonthBtn">This Month</button>
                    <button class="filter-btn" id="lastMonthBtn">Last Month</button>
                    <button class="filter-btn" id="thisYearBtn">This Year</button>
                    <button class="filter-btn" id="lastYearBtn">Last Year</button>
                </div>
            </div>
            <div class="report-table-container">
                <table class="report-table">
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
                    <tbody id="reportTableBody">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="summary-label">Grand Total</td>
                            <td class="summary-value">₱32,528</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="summary-label">Profit</td>
                            <td class="summary-value">₱4,641</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Date Selection Modal -->
    <div id="dateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Select Date Range</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <h3>November 2024</h3>
                    </div>
                    <div class="calendar">
                        <div class="calendar-weekdays">
                            <div>S</div>
                            <div>M</div>
                            <div>T</div>
                            <div>W</div>
                            <div>T</div>
                            <div>F</div>
                            <div>S</div>
                        </div>
                        <div class="calendar-days">
                            <div class="prev-month">27</div>
                            <div class="prev-month">28</div>
                            <div class="prev-month">29</div>
                            <div class="prev-month">30</div>
                            <div class="prev-month">31</div>
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>5</div>
                            <div>6</div>
                            <div>7</div>
                            <div>8</div>
                            <div>9</div>
                            <div>10</div>
                            <div>11</div>
                            <div class="selected">12</div>
                            <div>13</div>
                            <div>14</div>
                            <div>15</div>
                            <div>16</div>
                            <div>17</div>
                            <div>18</div>
                            <div>19</div>
                            <div>20</div>
                            <div>21</div>
                            <div>22</div>
                            <div>23</div>
                            <div>24</div>
                            <div>25</div>
                            <div>26</div>
                            <div>27</div>
                            <div>28</div>
                            <div>29</div>
                            <div>30</div>
                            <div class="next-month">1</div>
                            <div class="next-month">2</div>
                            <div class="next-month">3</div>
                            <div class="next-month">4</div>
                            <div class="next-month">5</div>
                            <div class="next-month">6</div>
                            <div class="next-month">7</div>
                        </div>
                    </div>
                </div>
                <div class="date-range-inputs">
                    <div class="date-input-group">
                        <label for="startDate">Start Date</label>
                        <input type="text" id="startDate" value="11/7/2024" readonly>
                    </div>
                    <div class="date-input-group">
                        <label for="endDate">End Date</label>
                        <input type="text" id="endDate" value="11/12/2024" readonly>
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="applyDateRange" class="apply-btn">Apply</button>
                    <button id="cancelDateSelection" class="cancel-btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/report.js"></script>
    <script src="js/company-name.js"></script>
    <script>
        document.getElementById("logoutId").addEventListener("click", function(){
            window.location.href = "login.php"
        });
    </script>
</body>
</html>