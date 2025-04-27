document.addEventListener("DOMContentLoaded", function() {
    const API_BASE_URL = 'api';
    const endpoints = {
        invoices: `${API_BASE_URL}/get_invoice_api.php`,
        invoiceItems: `${API_BASE_URL}/get_invoice_items_api.php`,
        installments: `${API_BASE_URL}/get_installment_api.php`,
        installmentItems: `${API_BASE_URL}/get_installment_items_api.php`,
        itemOut: `${API_BASE_URL}/item_out_stock_api.php`,
        itemLow: `${API_BASE_URL}/item_low_stock_api.php`,
        recentlyAdded: `${API_BASE_URL}/item_recently_added_api.php`
    };

    const dashboardNav = document.getElementById("dashboard-nav");
    const accountsNav = document.getElementById("accounts-nav");
    const categoriesNav = document.getElementById("categories-nav");
    const suppliersNav = document.getElementById("suppliers-nav");
    const itemsNav = document.getElementById("items-nav");
    const reportNav = document.getElementById("report-nav");
    const notificationIcon = document.getElementById("notificationIcon");
    const notificationContainer = document.getElementById("notificationContainer");
    const notificationContent = document.getElementById("notificationContent");
    const dateDisplay = document.getElementById("dateDisplay");
    const dateModal = document.getElementById("dateModal");
    const closeModal = document.querySelector(".close-modal");
    const applyBtn = document.getElementById("applyDateRange");
    const cancelBtn = document.getElementById("cancelDateSelection");
    const startDateInput = document.getElementById("startDate");
    const endDateInput = document.getElementById("endDate");
    const prevDateBtn = document.getElementById("prevDate");
    const nextDateBtn = document.getElementById("nextDate");
    const filterButtons = document.querySelectorAll(".filter-btn");
    const reportTableBody = document.getElementById("reportTableBody");
    const downloadBtn = document.getElementById("downloadReport");
    const calendarHeader = document.querySelector(".calendar-header h3");
    const calendarDays = document.querySelector(".calendar-days");

    let currentStartDate = new Date(2025, 3, 27);
    let currentEndDate = new Date(2025, 3, 27, 23, 59, 59, 999);
    let allInvoices = [];
    let allInvoiceItems = [];
    let allInstallments = [];
    let allInstallmentItems = [];
    let currentMonth = currentStartDate.getMonth();
    let currentYear = currentStartDate.getFullYear();

    const formatDate = (date) => {
        return `${(date.getMonth() + 1).toString().padStart(2, "0")}/${date.getDate().toString().padStart(2, "0")}/${date.getFullYear()}`;
    };

    const parseDate = (dateStr) => {
        const [month, day, year] = dateStr.split("/").map(Number);
        return new Date(year, month - 1, day);
    };

    const normalizeDate = (date) => {
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    };

    const formatCurrency = (amount) => {
        return `₱${parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")}`;
    };

    const updateDateDisplay = () => {
        if (normalizeDate(currentStartDate).toDateString() === normalizeDate(currentEndDate).toDateString()) {
            dateDisplay.textContent = formatDate(currentStartDate);
        } else {
            dateDisplay.textContent = `${formatDate(currentStartDate)} - ${formatDate(currentEndDate)}`;
        }
    };

    dashboardNav.addEventListener("click", () => (window.location.href = "dashboard.php"));
    accountsNav.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "accounts.php";
    });
    categoriesNav.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "categories.php";
    });
    suppliersNav.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "suppliers.php";
    });
    itemsNav.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "items.php";
    });
    reportNav.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "report.php";
    });

    notificationIcon.addEventListener("click", (e) => {
        e.preventDefault();
        notificationContainer.classList.toggle("show");
    });

    document.addEventListener("click", (e) => {
        if (!notificationContainer.contains(e.target) && !notificationIcon.contains(e.target)) {
            notificationContainer.classList.remove("show");
        }
    });

    function fetchItemOut() {
        fetch(endpoints.itemOut)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    data.itemOut.forEach((item) => {
                        notificationContent.innerHTML += `
                            <div class="notification-item">
                                <span class="notification-text">Out of stock alert: ${item.name}</span>
                            </div>`;
                    });
                }
            })
            .catch((error) => console.error("Failed Fetching Item Out", error));
    }

    function fetchItemLow() {
        fetch(endpoints.itemLow)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    data.itemLow.forEach((item) => {
                        notificationContent.innerHTML += `
                            <div class="notification-item">
                                <span class="notification-text">Low stock alert: ${item.name}</span>
                            </div>`;
                    });
                }
            })
            .catch((error) => console.error("Failed Fetching Item Low", error));
    }

    function fetchRecentlyAdded() {
        fetch(endpoints.recentlyAdded)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    data.recentlyAdded.slice(0, 5).forEach((item) => {
                        notificationContent.innerHTML += `
                            <div class="notification-item">
                                <span class="notification-text">Recently Added: ${item.name}</span>
                            </div>`;
                    });
                }
            })
            .catch((error) => console.error("Failed Fetching Recently Added", error));
    }

    const fetchReportData = async () => {
        try {
            const [invoicesRes, invoiceItemsRes, installmentsRes, installmentItemsRes] = await Promise.all([
                fetch(endpoints.invoices).then((res) => res.json()),
                fetch(endpoints.invoiceItems).then((res) => res.json()),
                fetch(endpoints.installments).then((res) => res.json()),
                fetch(endpoints.installmentItems).then((res) => res.json())
            ]);

            allInvoices = invoicesRes.invoices || [];
            allInvoiceItems = invoiceItemsRes.invoice_items || [];
            allInstallments = installmentsRes.installments || [];
            allInstallmentItems = installmentItemsRes.installment_items || [];

            console.log("Fetched Data:", { allInvoices, allInvoiceItems, allInstallments, allInstallmentItems });

            updateReportTable();
        } catch (error) {
            console.error("Error fetching report data:", error);
            alert("Failed to load report data. Please try again.");
        }
    };

    const updateReportTable = () => {
        reportTableBody.innerHTML = "";
        let grandTotal = 0;
        let totalProfit = 0;

        const startDate = normalizeDate(currentStartDate);
        const endDate = new Date(currentEndDate.getFullYear(), currentEndDate.getMonth(), currentEndDate.getDate(), 23, 59, 59, 999);

        console.log("Filtering with range:", formatDate(startDate), "to", formatDate(endDate));

        const invoiceItemsFiltered = allInvoiceItems.filter((item) => {
            const invoice = allInvoices.find((inv) => inv.invoice_id === item.invoice_id);
            if (!invoice) return false;
            const itemDate = normalizeDate(new Date(invoice.invoice_date));
            return itemDate >= startDate && itemDate <= endDate;
        });

        const installmentItemsFiltered = allInstallmentItems.filter((item) => {
            const installment = allInstallments.find((inst) => inst.installment_id === item.installment_id);
            if (!installment) return false;
            const itemDate = normalizeDate(new Date(installment.installment_date));
            return itemDate >= startDate && itemDate <= endDate;
        });

        console.log("Filtered Items:", { invoiceItemsFiltered, installmentItemsFiltered });

        const combinedItems = [
            ...invoiceItemsFiltered.map((item) => ({
                date: allInvoices.find((inv) => inv.invoice_id === item.invoice_id)?.invoice_date,
                item_name: item.item_name,
                quantity: item.quantity,
                unit_price: item.unit_price,
                cost_price: item.unit_price * 0.8,
                total_price: item.total_price
            })),
            ...installmentItemsFiltered.map((item) => ({
                date: allInstallments.find((inst) => inst.installment_id === item.installment_id)?.installment_date,
                item_name: item.item_name,
                quantity: item.quantity,
                unit_price: item.unit_price,
                cost_price: item.unit_price * 0.8,
                total_price: item.total_price
            }))
        ];

        combinedItems.forEach((item) => {
            const row = document.createElement("tr");
            const itemDate = new Date(item.date);
            const profit = (item.unit_price - item.cost_price) * item.quantity;

            row.innerHTML = `
                <td>${formatDate(itemDate)}</td>
                <td>${item.item_name}</td>
                <td>${item.quantity}</td>
                <td>${formatCurrency(item.cost_price)}</td>
                <td>${formatCurrency(item.unit_price)}</td>
                <td>${formatCurrency(item.total_price)}</td>
            `;

            reportTableBody.appendChild(row);
            grandTotal += parseFloat(item.total_price);
            totalProfit += profit;
        });

        const tfoot = document.querySelector(".report-table tfoot");
        tfoot.innerHTML = `
            <tr>
                <td colspan="5" class="summary-label">Grand Total</td>
                <td class="summary-value">${formatCurrency(grandTotal)}</td>
            </tr>
            <tr>
                <td colspan="5" class="summary-label">Profit</td>
                <td class="summary-value">${formatCurrency(totalProfit)}</td>
            </tr>
        `;
    };

    const generateCalendar = (month, year) => {
        calendarDays.innerHTML = "";
        calendarHeader.textContent = `${new Date(year, month).toLocaleString("default", { month: "long" })} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();
        const prevLastDate = new Date(year, month, 0).getDate();

        for (let i = firstDay; i > 0; i--) {
            const day = prevLastDate - i + 1;
            calendarDays.innerHTML += `<div class="prev-month">${day}</div>`;
        }

        for (let i = 1; i <= lastDate; i++) {
            const isSelected = currentEndDate.getDate() === i && currentEndDate.getMonth() === month && currentEndDate.getFullYear() === year;
            calendarDays.innerHTML += `<div class="${isSelected ? "selected" : ""}">${i}</div>`;
        }

        const totalDays = firstDay + lastDate;
        const nextDays = 42 - totalDays;
        for (let i = 1; i <= nextDays; i++) {
            calendarDays.innerHTML += `<div class="next-month">${i}</div>`;
        }

        document.querySelectorAll(".calendar-days div").forEach((day) => {
            day.addEventListener("click", function () {
                document.querySelectorAll(".calendar-days div").forEach((d) => d.classList.remove("selected"));
                this.classList.add("selected");

                let selectedDay = this.textContent;
                let selectedMonth = month;
                let selectedYear = year;

                if (this.classList.contains("prev-month")) {
                    selectedMonth = month - 1;
                    if (selectedMonth < 0) {
                        selectedMonth = 11;
                        selectedYear--;
                    }
                } else if (this.classList.contains("next-month")) {
                    selectedMonth = month + 1;
                    if (selectedMonth > 11) {
                        selectedMonth = 0;
                        selectedYear++;
                    }
                }

                endDateInput.value = `${(selectedMonth + 1).toString().padStart(2, "0")}/${selectedDay.padStart(2, "0")}/${selectedYear}`;
            });
        });
    };

    dateDisplay.addEventListener("click", () => {
        dateModal.style.display = "block";
        startDateInput.value = formatDate(currentStartDate);
        endDateInput.value = formatDate(currentEndDate);
        generateCalendar(currentMonth, currentYear);
    });

    closeModal.addEventListener("click", () => {
        dateModal.style.display = "none";
    });

    cancelBtn.addEventListener("click", () => {
        dateModal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === dateModal) {
            dateModal.style.display = "none";
        }
    });

    applyBtn.addEventListener("click", () => {
        currentStartDate = parseDate(startDateInput.value);
        currentEndDate = new Date(parseDate(endDateInput.value).setHours(23, 59, 59, 999));
        currentMonth = currentEndDate.getMonth();
        currentYear = currentEndDate.getFullYear();
        updateDateDisplay();
        updateReportTable();
        dateModal.style.display = "none";
    });

    prevDateBtn.addEventListener("click", () => {
        currentStartDate.setDate(currentStartDate.getDate() - 1);
        currentEndDate.setDate(currentEndDate.getDate() - 1);
        currentEndDate.setHours(23, 59, 59, 999);
        updateDateDisplay();
        updateReportTable();
    });

    nextDateBtn.addEventListener("click", () => {
        currentStartDate.setDate(currentStartDate.getDate() + 1);
        currentEndDate.setDate(currentEndDate.getDate() + 1);
        currentEndDate.setHours(23, 59, 59, 999);
        updateDateDisplay();
        updateReportTable();
    });

    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            filterButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");

            const now = new Date();
            switch (this.id) {
                case "todayBtn":
                    currentStartDate = normalizeDate(now);
                    currentEndDate = new Date(currentStartDate.getFullYear(), currentStartDate.getMonth(), currentStartDate.getDate(), 23, 59, 59, 999);
                    break;
                case "yesterdayBtn":
                    currentStartDate = normalizeDate(new Date(now.setDate(now.getDate() - 1)));
                    currentEndDate = new Date(currentStartDate.getFullYear(), currentStartDate.getMonth(), currentStartDate.getDate(), 23, 59, 59, 999);
                    break;
                case "thisWeekBtn":
                    currentStartDate = normalizeDate(new Date(now.setDate(now.getDate() - now.getDay())));
                    currentEndDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59, 999);
                    break;
                case "lastWeekBtn":
                    currentStartDate = normalizeDate(new Date(now.setDate(now.getDate() - now.getDay() - 7)));
                    currentEndDate = new Date(currentStartDate.getFullYear(), currentStartDate.getMonth(), currentStartDate.getDate() + 6, 23, 59, 59, 999);
                    break;
                case "thisMonthBtn":
                    currentStartDate = new Date(now.getFullYear(), now.getMonth(), 1);
                    currentEndDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59, 999);
                    break;
                case "lastMonthBtn":
                    currentStartDate = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                    currentEndDate = new Date(now.getFullYear(), now.getMonth(), 0, 23, 59, 59, 999);
                    break;
                case "thisYearBtn":
                    currentStartDate = new Date(now.getFullYear(), 0, 1);
                    currentEndDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59, 999);
                    break;
                case "lastYearBtn":
                    currentStartDate = new Date(now.getFullYear() - 1, 0, 1);
                    currentEndDate = new Date(now.getFullYear() - 1, 11, 31, 23, 59, 59, 999);
                    break;
            }
            currentMonth = currentEndDate.getMonth();
            currentYear = currentEndDate.getFullYear();
            updateDateDisplay();
            updateReportTable();
        });
    });

    downloadBtn.addEventListener("click", () => {

        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js';
        script.onload = function() {

            const workbook = XLSX.utils.book_new();
            const data = [];

            data.push(["Date", "Name", "Quantity", "Cost Price", "Selling Price", "Total"]);

            const rows = reportTableBody.querySelectorAll("tr");
            rows.forEach((row) => {
                const cells = row.querySelectorAll("td");
                const rowData = Array.from(cells).map((cell) => {

                    return cell.textContent.replace(/₱/g, "").replace(/,/g, "");
                });
                data.push(rowData);
            });

            const grandTotal = document.querySelector(".summary-value")?.textContent.replace(/₱/g, "").replace(/,/g, "") || "0";
            const profit = document.querySelectorAll(".summary-value")[1]?.textContent.replace(/₱/g, "").replace(/,/g, "") || "0";
            data.push(["", "", "", "", "Grand Total", grandTotal]);
            data.push(["", "", "", "", "Profit", profit]);

            const worksheet = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(workbook, worksheet, "Report");

            const fileName = `report_${formatDate(currentStartDate)}_to_${formatDate(currentEndDate)}.xlsx`;
            XLSX.writeFile(workbook, fileName);
        };
        
        script.onerror = function() {
            alert("Failed to load Excel conversion library. Downloading as CSV instead.");
            downloadAsCSV();
        };
        
        document.head.appendChild(script);
    });

    function downloadAsCSV() {
        const csvContent = ["Date,Name,Quantity,Cost Price,Selling Price,Total"];
    
        const rows = reportTableBody.querySelectorAll("tr");
        rows.forEach((row) => {
            const cells = row.querySelectorAll("td");
            const rowData = Array.from(cells)
                .map((cell) => cell.textContent.replace(/₱/g, "").replace(/,/g, ""))
                .join(",");
            csvContent.push(rowData);
        });
    
        const grandTotal = document.querySelector(".summary-value")?.textContent.replace(/₱/g, "").replace(/,/g, "") || "0";
        const profit = document.querySelectorAll(".summary-value")[1]?.textContent.replace(/₱/g, "").replace(/,/g, "") || "0";
        csvContent.push(`,,,,Grand Total,${grandTotal}`);
        csvContent.push(`,,,,Profit,${profit}`);
    
        const blob = new Blob([csvContent.join("\n")], { type: "text/csv" });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = `report_${formatDate(currentStartDate)}_to_${formatDate(currentEndDate)}.csv`;
        a.click();
        window.URL.revokeObjectURL(url);
    }

    fetchItemOut();
    fetchItemLow();
    fetchRecentlyAdded();
    fetchReportData();
    updateDateDisplay();
    generateCalendar(currentMonth, currentYear);
});