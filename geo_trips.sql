-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 12:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geo_trips`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `admin_pass` varchar(255) DEFAULT NULL,
  `join_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `admin_pass`, `join_date`) VALUES
(1, 'Frank Doe', 'admin1@example.com', '$2b$12$7zPUJoW4nuw35Ml27HGj1eX', '2019-05-16'),
(2, 'David Smith', 'admin2@example.com', '$2b$12$LXMTWQKrvma0EXnjEZPytOe', '2020-12-09'),
(3, 'Grace Taylor', 'admin3@example.com', '$2b$12$b8kr.DUIk0/FwVOkbDXn/eM', '2023-03-07'),
(4, 'Eva Williams', 'admin4@example.com', '$2b$12$x26NnfQq2mizNC6AQOwTWOI', '2022-09-07'),
(5, 'Henry Johnson', 'admin5@example.com', '$2b$12$LZ1fXWOEjd2YRQAcJVt.U.O', '2025-04-02'),
(6, 'Bob Brown', 'admin6@example.com', '$2b$12$tPlCtmxKG1IlNoR2OAHNjeh', '2021-08-25'),
(7, 'Grace Wilson', 'admin7@example.com', '$2b$12$r8NtWgTBTkP9DVlJCj7C3en', '2025-12-25'),
(8, 'Jane Miller', 'admin8@example.com', '$2b$12$XYvDD9fQ3s/EFDP7V8KCiuL', '2020-04-18'),
(9, 'Henry Wilson', 'admin9@example.com', '$2b$12$3OMIqXzanHMZN8pPFrej5.w', '2023-07-12'),
(10, 'John Williams', 'admin10@example.com', '$2b$12$S.BpM3K940s/pleeLZXCTuc', '2019-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate`
--

CREATE TABLE `affiliate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact_name` varchar(59) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `discount_rate` float DEFAULT NULL,
  `speciality` varchar(50) DEFAULT NULL,
  `affiliate_status` int(11) DEFAULT NULL,
  `aggreement_duration` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affiliate`
--

INSERT INTO `affiliate` (`id`, `name`, `contact_name`, `phone`, `email`, `address`, `discount_rate`, `speciality`, `affiliate_status`, `aggreement_duration`, `expiry_date`) VALUES
(5, 'Affiliate 1', 'John Smith', '+8801712345678', 'affiliate1@example.com', 'Paris, France', 0.12, 'Luxury', 1, 2, '2028-06-15'),
(6, 'Affiliate 2', 'Jane Johnson', '+8801712345123', 'affiliate2@example.com', 'London, UK', 0.15, 'Budget', 1, 3, '2029-04-21'),
(7, 'Affiliate 3', 'Alice Brown', '+8801712345345', 'affiliate3@example.com', 'Berlin, Germany', 0.08, 'Adventure', 0, 1, '2027-11-12'),
(8, 'Affiliate 4', 'Bob Davis', '+8801712345567', 'affiliate4@example.com', 'Tokyo, Japan', 0.2, 'Luxury', 1, 4, '2030-02-28'),
(9, 'Affiliate 5', 'Carol Wilson', '+8801712345789', 'affiliate5@example.com', 'New York, USA', 0.1, 'Budget', 0, 2, '2027-08-19'),
(10, 'Affiliate 6', 'David Taylor', '+8801712345901', 'affiliate6@example.com', 'Paris, France', 0.18, 'Adventure', 1, 5, '2030-12-05'),
(11, 'Affiliate 7', 'Eva Miller', '+8801712345012', 'affiliate7@example.com', 'London, UK', 0.13, 'Luxury', 1, 3, '2028-05-09'),
(12, 'Affiliate 8', 'Frank Williams', '+8801712345234', 'affiliate8@example.com', 'Berlin, Germany', 0.09, 'Budget', 0, 2, '2029-07-23'),
(13, 'Affiliate 9', 'Grace Davis', '+8801712345456', 'affiliate9@example.com', 'Tokyo, Japan', 0.11, 'Adventure', 1, 4, '2028-10-02'),
(14, 'Affiliate 10', 'Henry Brown', '+8801712345670', 'affiliate10@example.com', 'New York, USA', 0.16, 'Luxury', 0, 5, '2030-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_date` date DEFAULT curdate(),
  `arrival_date` date DEFAULT NULL,
  `people_count` int(11) DEFAULT NULL,
  `cancellation_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cancellations`
--

CREATE TABLE `cancellations` (
  `id` int(11) NOT NULL,
  `cancelled_on` date DEFAULT NULL,
  `refund_amount` float DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(20) DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `percentage`, `expire_date`) VALUES
(1, 'CODE1', 5, '2025-11-20'),
(2, 'CODE2', 15, '2026-03-19'),
(3, 'CODE3', 15, '2026-05-08'),
(4, 'CODE4', 25, '2025-10-14'),
(5, 'CODE5', 10, '2026-10-18'),
(6, 'CODE6', 25, '2026-12-14'),
(7, 'CODE7', 10, '2025-11-26'),
(8, 'CODE8', 5, '2025-01-05'),
(9, 'CODE9', 15, '2025-02-22'),
(10, 'CODE10', 20, '2026-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `pp_no` varchar(15) DEFAULT NULL,
  `user_name` varchar(15) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `f_name`, `l_name`, `dob`, `phone`, `email`, `address`, `nationality`, `pp_no`, `user_name`, `pass`) VALUES
(3, ' NUR ', 'TAMIM', '2001-10-16', '01518936461', 'nutamim2001@gmail.com', '89/24 gopibag dhaka -1203', 'Bangladeshi', 'A25151362', 'tamim', '$2y$10$vLF4.la1JtjVY');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `address`, `stars`, `availability`, `affiliate_id`, `location_id`) VALUES
(1, 'Hotel 1', 'Berlin, France', 1, 0, NULL, NULL),
(2, 'Hotel 2', 'London, France', 4, 0, NULL, NULL),
(3, 'Hotel 3', 'Tokyo, France', 2, 0, NULL, NULL),
(4, 'Hotel 4', 'Berlin, France', 5, 1, NULL, NULL),
(5, 'Hotel 5', 'Tokyo, USA', 3, 1, NULL, NULL),
(6, 'Hotel 6', 'New York, UK', 2, 0, NULL, NULL),
(7, 'Hotel 7', 'Berlin, Japan', 1, 1, NULL, NULL),
(8, 'Hotel 8', 'London, UK', 3, 1, NULL, NULL),
(9, 'Hotel 9', 'Paris, Germany', 3, 0, NULL, NULL),
(10, 'Hotel 10', 'Tokyo, Japan', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `country`, `city`, `hotel_id`) VALUES
(1, 'Japan', 'Tokyo', 9),
(2, 'Germany', 'Berlin', 9),
(3, 'France', 'Berlin', 4),
(4, 'Japan', 'New York', 5),
(5, 'Germany', 'London', 8),
(6, 'Germany', 'Tokyo', 8),
(7, 'Germany', 'London', 10),
(8, 'USA', 'Berlin', 2),
(9, 'UK', 'Tokyo', 6),
(10, 'France', 'Berlin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `commission_rate` float DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_hotel`
--

CREATE TABLE `package_hotel` (
  `package_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_location`
--

CREATE TABLE `package_location` (
  `location_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `paid_on` date DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visa_application`
--

CREATE TABLE `visa_application` (
  `id` int(11) NOT NULL,
  `submission_date` date DEFAULT curdate(),
  `visa_status` varchar(20) DEFAULT NULL,
  `admin_comment` varchar(255) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate`
--
ALTER TABLE `affiliate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancel_fk` (`cancellation_id`),
  ADD KEY `booking_payment_fk` (`payment_id`),
  ADD KEY `booking_admin_fk` (`admin_id`);

--
-- Indexes for table `cancellations`
--
ALTER TABLE `cancellations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancel_boooking_fk` (`booking_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_affiliate` (`affiliate_id`),
  ADD KEY `hotel_location` (`location_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_location_fk` (`location_id`);

--
-- Indexes for table `package_hotel`
--
ALTER TABLE `package_hotel`
  ADD PRIMARY KEY (`package_id`,`hotel_id`),
  ADD KEY `fk_hotel_package` (`hotel_id`);

--
-- Indexes for table `package_location`
--
ALTER TABLE `package_location`
  ADD PRIMARY KEY (`location_id`,`package_id`),
  ADD KEY `package_for_location` (`package_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_coupon` (`coupon_id`);

--
-- Indexes for table `visa_application`
--
ALTER TABLE `visa_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_fk` (`payment_id`),
  ADD KEY `admin_fk` (`admin_id`),
  ADD KEY `customer_fk` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `affiliate`
--
ALTER TABLE `affiliate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancellations`
--
ALTER TABLE `cancellations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_location`
--
ALTER TABLE `package_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visa_application`
--
ALTER TABLE `visa_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `booking_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `booking_payment_fk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `cancel_fk` FOREIGN KEY (`cancellation_id`) REFERENCES `cancellations` (`id`);

--
-- Constraints for table `cancellations`
--
ALTER TABLE `cancellations`
  ADD CONSTRAINT `cancel_boooking_fk` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotel_affiliate` FOREIGN KEY (`affiliate_id`) REFERENCES `affiliate` (`id`),
  ADD CONSTRAINT `hotel_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_location_fk` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Constraints for table `package_hotel`
--
ALTER TABLE `package_hotel`
  ADD CONSTRAINT `fk_hotel_package` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `fk_package_hotel` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`),
  ADD CONSTRAINT `hotel_in_package` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Constraints for table `package_location`
--
ALTER TABLE `package_location`
  ADD CONSTRAINT `location_in_package` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `package_for_location` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment_coupon` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`);

--
-- Constraints for table `visa_application`
--
ALTER TABLE `visa_application`
  ADD CONSTRAINT `admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `customer_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `payment_fk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
