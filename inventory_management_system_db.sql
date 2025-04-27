-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 07:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_management_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `account_type` enum('Admin','User') NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `first_name`, `middle_name`, `last_name`, `email`, `address`, `username`, `password`, `gender`, `account_type`, `date_of_birth`) VALUES
(1, 'Earl Kian', 'Anastacio', 'Bancayrin', 'earlkian8@gmail.com', 'Tugbungan, Zamboanga City', 'earlkian8', 'Qwerty-123', 'Male', 'Admin', '2004-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Laptops', 'Portable computers including gaming laptops, ultrabooks, and business notebooks'),
(2, 'Smartphones', 'Mobile phones with advanced computing capability and connectivity'),
(3, 'Tablets', 'Touchscreen portable devices larger than smartphones'),
(4, 'Monitors', 'Computer displays including LED, LCD, and gaming monitors'),
(5, 'PC Components', 'Internal computer parts like CPUs, GPUs, motherboards, and RAM'),
(6, 'Printers & Scanners', 'Output devices including inkjet, laser printers, and document scanners'),
(7, 'Networking Devices', 'Routers, switches, modems, and other networking equipment'),
(8, 'Storage Devices', 'SSDs, HDDs, USB flash drives, and memory cards'),
(9, 'Gaming Gear', 'Gaming peripherals like mice, keyboards, headsets, and controllers'),
(10, 'Software & Security', 'Operating systems, productivity software, and antivirus programs'),
(11, 'Accessories', 'Cables, adapters, docks, and other computer accessories'),
(12, 'Smart Home Devices', 'Smart speakers, security cameras, and home automation products');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `name`) VALUES
(1, 'KuroTech');

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `installment_id` int(11) NOT NULL,
  `installment_date` datetime DEFAULT current_timestamp(),
  `subtotal` double NOT NULL,
  `tax_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `downpayment` double NOT NULL,
  `monthly_payment` varchar(30) NOT NULL,
  `interest` double NOT NULL,
  `monthly_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`installment_id`, `installment_date`, `subtotal`, `tax_amount`, `total_amount`, `downpayment`, `monthly_payment`, `interest`, `monthly_amount`) VALUES
(1, '2025-04-27 13:25:10', 35999, 4319.88, 40318.88, 5000, '24', 4, 1533.72);

-- --------------------------------------------------------

--
-- Table structure for table `installment_items`
--

CREATE TABLE `installment_items` (
  `installment_item_id` int(11) NOT NULL,
  `installment_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` double NOT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `total_price` double NOT NULL,
  `item_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment_items`
--

INSERT INTO `installment_items` (`installment_item_id`, `installment_id`, `item_id`, `quantity`, `unit_price`, `discount_percent`, `total_price`, `item_name`) VALUES
(1, 1, 83, 1, 35999, 0, 35999, 'realme GT 6 12/512GB');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_date` datetime DEFAULT current_timestamp(),
  `subtotal` double NOT NULL,
  `tax_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `cash_received` double NOT NULL,
  `change_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_date`, `subtotal`, `tax_amount`, `total_amount`, `cash_received`, `change_amount`) VALUES
(1, '2025-04-15 14:39:50', 324882.9, 38985.95, 363868.85, 400000, 36131.15),
(2, '2025-04-16 20:42:35', 427.5, 51.3, 478.8, 500, 21.2),
(3, '2025-04-27 13:01:53', 60997, 7319.64, 68316.64, 70000, 1683.36),
(4, '2025-04-27 13:02:42', 35999, 4319.88, 40318.88, 50000, 9681.12),
(5, '2025-04-27 13:08:38', 284985, 34198.2, 319183.2, 400000, 80816.8),
(6, '2025-04-27 13:09:46', 117694.15, 14123.3, 131817.45, 200000, 68182.55),
(7, '2025-04-27 13:22:59', 18999, 2279.88, 21278.88, 22000, 721.12);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `invoice_item_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` double NOT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `total_price` double NOT NULL,
  `item_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`invoice_item_id`, `invoice_id`, `item_id`, `quantity`, `unit_price`, `discount_percent`, `total_price`, `item_name`) VALUES
(1, 1, 86, 18, 18999, 5, 324882.9, 'Infinix Note 40 Pro+'),
(3, 5, 86, 15, 18999, 0, 284985, 'Infinix Note 40 Pro+'),
(4, 6, 81, 1, 61999, 5, 58899.05, 'Google Pixel 9 Pro 256GB'),
(5, 6, 68, 3, 11999, 0, 35997, 'Microsoft Office 2021 Home'),
(6, 6, 58, 2, 11999, 5, 22798.1, 'Samsung T7 Shield 2TB'),
(7, 7, 86, 1, 18999, 0, 18999, 'Infinix Note 40 Pro+');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `costPrice` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` double NOT NULL,
  `sku` varchar(30) NOT NULL,
  `reorderLevel` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `costPrice`, `quantity`, `unitPrice`, `sku`, `reorderLevel`, `status`, `supplier_id`, `category_id`) VALUES
(1, 'Dell XPS 15', 66000, 15, 82499.45, 'DEL-XPS15-2023', 5, 'Active', 1, 1),
(2, 'MacBook Pro 14\" M2', 82500, 10, 109999.45, 'APP-MBP14-M2', 3, 'Active', 2, 1),
(3, 'Lenovo ThinkPad X1', 60500, 12, 76999.45, 'LEN-TPX1-2023', 4, 'Active', 3, 1),
(4, 'iPhone 15 Pro', 49445, 25, 60499.45, 'APP-IP15-PRO', 10, 'Active', 2, 2),
(5, 'Samsung Galaxy S23', 41250, 20, 49499.45, 'SAM-GS23-256', 8, 'Active', 4, 2),
(6, 'Google Pixel 7 Pro', 35750, 18, 43999.45, 'GOO-PX7-PRO', 5, 'Inactive', 5, 2),
(7, 'iPad Pro 12.9\"', 49500, 8, 60499.45, 'APP-IPADP-129', 3, 'Active', 2, 3),
(8, 'Samsung Galaxy Tab S9', 33000, 12, 41249.45, 'SAM-TABS9-256', 4, 'Inactive', 4, 3),
(9, 'LG UltraFine 32\" 4K', 22000, 10, 32999.45, 'LG-32UF-4K', 5, 'Active', 3, 4),
(10, 'Dell 27\" Gaming Monitor', 19250, 15, 27499.45, 'DEL-27GM-240HZ', 5, 'Active', 1, 4),
(11, 'NVIDIA RTX 4090', 66000, 5, 87999.45, 'NVD-RTX4090', 2, 'Active', 6, 5),
(12, 'Intel Core i9-13900K', 24750, 8, 32999.45, 'INT-I9-13GEN', 3, 'Inactive', 7, 5),
(13, 'HP LaserJet Pro M404', 13750, 7, 19249.45, 'HP-LJP-M404', 3, 'Active', 1, 6),
(14, 'Epson EcoTank ET-3850', 16500, 5, 21999.45, 'EPS-ET3850', 2, 'Active', 5, 6),
(15, 'TP-Link Archer AX6000', 9900, 12, 13749.45, 'TPL-AX6000', 5, 'Active', 4, 7),
(16, 'Netgear Nighthawk X10', 22000, 4, 30249.45, 'NET-NH-X10', 2, 'Inactive', 3, 7),
(17, 'Samsung 980 Pro 2TB', 8250, 20, 10999.45, 'SAM-980P-2TB', 10, 'Active', 4, 8),
(18, 'WD Black 5TB HDD', 6600, 15, 8799.45, 'WD-BLK-5TB', 8, 'Active', 6, 8),
(19, 'Logitech G Pro X', 4400, 25, 7149.45, 'LOG-GPROX', 10, 'Active', 7, 9),
(20, 'Razer BlackWidow V4', 6600, 10, 9349.45, 'RZR-BWV4', 5, 'Inactive', 5, 9),
(21, 'Microsoft Office 365', 6600, 50, 8249.45, 'MS-OFF365-1YR', 20, 'Active', 1, 10),
(22, 'Norton 360 Deluxe', 2200, 30, 3299.45, 'NOR-360-DLX', 15, 'Active', 2, 10),
(23, 'Dell XPS 15 (2023)', 65999, 12, 82499, 'DEL-XPS15-23', 5, 'Active', 1, 1),
(24, 'MacBook Air M2', 54999, 8, 68999, 'APP-MBA-M2', 3, 'Active', 2, 1),
(25, 'ASUS ROG Zephyrus', 72999, 5, 89999, 'ASU-ROG-ZEP', 2, 'Active', 3, 1),
(26, 'Lenovo ThinkPad T14', 48999, 10, 61999, 'LEN-TPT14', 4, 'Inactive', 4, 1),
(27, 'Acer Swift 3', 32999, 15, 41999, 'ACE-SW3', 7, 'Active', 5, 1),
(28, 'iPhone 15 Pro 256GB', 65999, 20, 79999, 'APP-IP15P', 8, 'Active', 2, 2),
(29, 'Samsung Galaxy S23 Ultra', 58999, 18, 72999, 'SAM-S23U', 7, 'Active', 4, 2),
(30, 'Xiaomi 13T Pro', 32999, 25, 41999, 'XIA-13TP', 10, 'Active', 6, 2),
(31, 'Google Pixel 8', 38999, 12, 48999, 'GOO-PX8', 5, 'Inactive', 7, 2),
(32, 'Realme 11 Pro+', 21999, 30, 27999, 'REL-11PP', 12, 'Active', 5, 2),
(33, 'iPad Air 5th Gen', 34999, 10, 43999, 'APP-IPA5', 4, 'Active', 2, 3),
(34, 'Samsung Tab S9 Ultra', 45999, 6, 57999, 'SAM-TS9U', 2, 'Active', 4, 3),
(35, 'Huawei MatePad Pro', 28999, 8, 36999, 'HUA-MPP', 3, 'Inactive', 1, 3),
(36, 'Lenovo Tab P12', 22999, 12, 29999, 'LEN-TP12', 5, 'Active', 3, 3),
(37, 'Xiaomi Pad 6', 19999, 15, 25999, 'XIA-PAD6', 7, 'Active', 6, 3),
(38, 'LG UltraFine 32UN880', 32999, 7, 41999, 'LG-32UN880', 3, 'Active', 3, 4),
(39, 'Dell 27 4K U2723QE', 28999, 9, 36999, 'DEL-U2723', 4, 'Active', 1, 4),
(40, 'Samsung Odyssey G7', 25999, 5, 32999, 'SAM-ODG7', 2, 'Inactive', 4, 4),
(41, 'ASUS ProArt PA278QV', 21999, 8, 28999, 'ASU-PA278', 3, 'Active', 7, 4),
(42, 'Acer Predator XB3', 38999, 4, 48999, 'ACE-PXB3', 2, 'Active', 5, 4),
(43, 'NVIDIA RTX 4090', 89999, 3, 109999, 'NVD-RTX4090', 1, 'Active', 6, 5),
(44, 'AMD Ryzen 9 7950X', 32999, 7, 41999, 'AMD-R97950', 3, 'Active', 7, 5),
(45, 'Corsair DDR5 32GB', 7999, 20, 10999, 'COR-D5-32G', 8, 'Active', 1, 5),
(46, 'Samsung 990 Pro 2TB', 12999, 15, 16999, 'SAM-990P2T', 6, 'Inactive', 4, 5),
(47, 'ASUS ROG Strix B650E', 14999, 10, 19999, 'ASU-B650E', 4, 'Active', 3, 5),
(48, 'HP LaserJet Pro M404dn', 18999, 6, 23999, 'HP-LJM404', 3, 'Active', 1, 6),
(49, 'Epson L3210 EcoTank', 12999, 8, 16999, 'EPS-L3210', 4, 'Active', 5, 6),
(50, 'Canon imageCLASS MF654', 21999, 5, 27999, 'CAN-MF654', 2, 'Inactive', 2, 6),
(51, 'Brother HL-L2350DW', 9999, 12, 13999, 'BR-HLL2350', 5, 'Active', 7, 6),
(52, 'Xerox VersaLink C405', 28999, 4, 36999, 'XER-VLC405', 2, 'Active', 3, 6),
(53, 'TP-Link Archer AX73', 8999, 15, 11999, 'TPL-AX73', 7, 'Active', 4, 7),
(54, 'ASUS RT-AX86U', 12999, 8, 16999, 'ASU-RTAX86', 4, 'Active', 3, 7),
(55, 'Netgear Nighthawk RAX50', 14999, 6, 18999, 'NET-RAX50', 3, 'Inactive', 6, 7),
(56, 'Ubiquiti UniFi U6-Pro', 15999, 5, 19999, 'UBI-U6PRO', 2, 'Active', 1, 7),
(57, 'MikroTik hAP ac3', 7999, 10, 10999, 'MIK-HAPAC3', 5, 'Active', 5, 7),
(58, 'Samsung T7 Shield 2TB', 8999, 16, 11999, 'SAM-T7-2TB', 8, 'Active', 4, 8),
(59, 'WD My Passport 5TB', 6999, 15, 8999, 'WD-MP5TB', 7, 'Active', 6, 8),
(60, 'SanDisk Extreme Pro 1TB', 4999, 20, 6999, 'SD-EX1TB', 10, 'Active', 1, 8),
(61, 'Seagate Expansion 8TB', 9999, 8, 12999, 'SEA-EXP8T', 4, 'Inactive', 3, 8),
(62, 'Kingston XS2000 1TB', 5999, 12, 7999, 'KIN-XS2-1T', 6, 'Active', 5, 8),
(63, 'Logitech G Pro X Headset', 7999, 10, 10999, 'LOG-GPX-HD', 5, 'Active', 7, 9),
(64, 'Razer BlackWidow V4 Pro', 9999, 8, 12999, 'RAZ-BWV4P', 4, 'Active', 2, 9),
(65, 'SteelSeries Aerox 5', 5999, 12, 7999, 'STL-AX5', 6, 'Active', 4, 9),
(66, 'Xbox Elite Series 2', 8999, 6, 11999, 'MS-XB-EL2', 3, 'Inactive', 1, 9),
(67, 'PlayStation DualSense Edge', 9999, 5, 12999, 'SONY-PS-DSE', 2, 'Active', 3, 9),
(68, 'Microsoft Office 2021 Home', 8999, 22, 11999, 'MS-OFF21-H', 10, 'Active', 1, 10),
(69, 'Adobe Creative Cloud 1YR', 19999, 15, 24999, 'ADB-CC-1Y', 7, 'Active', 2, 10),
(70, 'Norton 360 Deluxe', 2999, 30, 4999, 'NOR-360-D', 15, 'Active', 5, 10),
(71, 'Windows 11 Pro OEM', 5999, 20, 7999, 'MS-WIN11P', 8, 'Inactive', 1, 10),
(72, 'Kaspersky Total Security', 2499, 18, 3999, 'KAS-TS-1Y', 9, 'Active', 7, 10),
(73, 'Crucial MX500 2TB SSD', 7999, 10, 10999, 'CRU-MX5-2T', 5, 'Active', 6, 8),
(74, 'HyperX Cloud Alpha Wireless', 8999, 7, 11999, 'HX-CAW', 3, 'Active', 4, 9),
(75, 'McAfee Total Protection', 1999, 25, 3499, 'MCA-TP-1Y', 12, 'Active', 3, 10),
(76, 'ASUS TUF Gaming F15 (2023)', 54999, 9, 68999, 'ASU-TUF15-23', 4, 'Active', 3, 1),
(77, 'ASUS TUF F15 i7-12700H', 51999, 6, 64999, 'ASU-TF15-127H', 3, 'Active', 3, 1),
(78, 'ASUS TUF F15 RTX 4060', 61999, 5, 75999, 'ASU-TF15-4060', 2, 'Active', 3, 1),
(79, 'Samsung Galaxy S24 Ultra 512GB', 75999, 7, 89999, 'SAM-S24U-512', 3, 'Active', 4, 2),
(80, 'iPhone 16 Pro Max 1TB', 89999, 5, 109999, 'APP-IP16PM-1T', 2, 'Active', 2, 2),
(81, 'Google Pixel 9 Pro 256GB', 48999, 8, 61999, 'GOO-PX9P-256', 4, 'Active', 7, 2),
(82, 'Xiaomi 14T Pro 12/256GB', 32999, 15, 41999, 'XIA-14TP-256', 7, 'Active', 6, 2),
(83, 'realme GT 6 12/512GB', 27999, 11, 35999, 'REL-GT6-512', 6, 'Active', 5, 2),
(84, 'vivo V30 Pro 12/256GB', 29999, 10, 38999, 'VIV-V30P-256', 5, 'Inactive', 1, 2),
(85, 'Tecno Camon 30 Pro', 15999, 20, 20999, 'TEC-CM30P', 10, 'Active', 3, 2),
(86, 'Infinix Note 40 Pro+', 13999, 14, 18999, 'INF-N40PP', 9, 'Active', 4, 2),
(87, 'iPhone 14 Plus 128GB', 35999, 8, 45999, 'APP-IP14P-128', 2, 'Inactive', 2, 2),
(88, 'Samsung Galaxy S21 FE', 22999, 2, 29999, 'SAM-S21FE', 3, 'Inactive', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `payment_terms` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `email`, `contact_person`, `address`, `payment_terms`) VALUES
(1, 'TechSource Inc.', 'sales@techsource.com', 'John Smith', '123 Tech Plaza, Silicon Valley, CA 94025', 'Net 30'),
(2, 'GadgetWorld Distributors', 'orders@gadgetworld.com', 'Sarah Johnson', '456 Innovation Drive, Austin, TX 78701', 'Net 15'),
(3, 'FutureComputing Solutions', 'info@futurecomputing.com', 'Michael Chen', '789 Binary Boulevard, Seattle, WA 98101', 'Net 45'),
(4, 'SmartDevice Hub', 'support@smartdevicehub.com', 'David Wilson', '321 Circuit Street, Boston, MA 02108', 'Net 30'),
(5, 'Global Tech Suppliers', 'inquiries@globaltech.com', 'Emily Davis', '654 Microchip Lane, San Diego, CA 92101', 'Net 60'),
(6, 'Elite Electronics', 'sales@eliteelectronics.com', 'Robert Brown', '987 Transistor Road, Denver, CO 80202', 'Net 30'),
(7, 'Digital Frontier', 'orders@digitalfrontier.com', 'Jessica Lee', '159 Algorithm Avenue, Chicago, IL 60601', 'Net 15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`installment_id`);

--
-- Indexes for table `installment_items`
--
ALTER TABLE `installment_items`
  ADD PRIMARY KEY (`installment_item_id`),
  ADD KEY `installment_id` (`installment_id`),
  ADD KEY `installment_items_ibfk_2` (`item_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`invoice_item_id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `invoice_items_ibfk_2` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `installment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installment_items`
--
ALTER TABLE `installment_items`
  MODIFY `installment_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `invoice_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `installment_items`
--
ALTER TABLE `installment_items`
  ADD CONSTRAINT `installment_items_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `installment` (`installment_id`),
  ADD CONSTRAINT `installment_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`),
  ADD CONSTRAINT `invoice_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
