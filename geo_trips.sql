-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 07:22 PM
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
(1, 'Rakib Hossain', 'rakibrazcse@gmail.com', 'rakib123', '2019-05-16'),
(2, 'Nur uddin Tamim', 'ntamim2001@gmail.com', 'tamim123', '2020-12-09'),
(3, 'Nahid hasan', 'nahid@gmail.com', 'nahid123', '2023-03-07'),
(4, 'Pratay pal', 'pratay@gmail.com', 'pratay123', '2022-09-07');

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
  `package_id` int(11) DEFAULT NULL,
  `check_out` date DEFAULT NULL
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
(3, ' Fardin ', 'Mizan', '2001-10-16', '01512345678', 'fardin@gmail.com', 'Mughda', 'Bangladeshi', 'A25151362', 'fardin', 'fardin123'),
(5, ' Marziul ', 'Rafi', '2001-10-16', '01912345678', 'rafi@gmail.com', 'purbo nurer chala, family bazar', 'Bangladeshi', 'A25151362', 'rafi', 'rafi123');

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
(1, 'Hotel Paris Luxe', '123 Champs Elysees, Paris', 5, 10, 5, 1),
(2, 'Hotel Paris Budget', '456 Rue de Rivoli, Paris', 3, 5, 6, 1),
(3, 'Hotel Paris Adventure', '789 Montmartre, Paris', 4, 8, 7, 1),
(4, 'Hotel Nice Breeze', '111 Promenade des Anglais, Nice', 4, 6, 10, 2),
(5, 'Hotel Nice Sea View', '222 Avenue de la Mer, Nice', 3, 12, 12, 2),
(6, 'Hotel London Royal', '1 Buckingham Palace Road, London', 5, 7, 11, 3),
(7, 'Hotel London Budget', '2 Oxford Street, London', 3, 10, 5, 3),
(8, 'Hotel London Adventure', '3 Covent Garden, London', 4, 9, 8, 3),
(9, 'Hotel Manchester Elite', '101 Deansgate, Manchester', 5, 4, 14, 4),
(10, 'Hotel Manchester Comfort', '202 Manchester Road, Manchester', 3, 8, 9, 4),
(11, 'Hotel Berlin Grand', '300 Alexanderplatz, Berlin', 5, 15, 12, 5),
(12, 'Hotel Berlin Budget', '400 Kurfurstendamm, Berlin', 3, 6, 12, 5),
(13, 'Hotel Berlin Adventure', '500 Brandenburg Gate, Berlin', 4, 10, 7, 5),
(14, 'Hotel Munich Bavaria', '600 Marienplatz, Munich', 5, 9, 10, 6),
(15, 'Hotel Munich Garden', '700 Theresienwiese, Munich', 4, 11, 8, 6),
(16, 'Hotel Tokyo Tower', '800 Tokyo Tower Street, Tokyo', 5, 18, 6, 7),
(17, 'Hotel Tokyo Shibuya', '900 Shibuya Crossing, Tokyo', 4, 14, 13, 7),
(18, 'Hotel Osaka Bay', '100 Osaka Bay Area, Osaka', 4, 10, 9, 8),
(19, 'Hotel Osaka Central', '200 Namba, Osaka', 3, 20, 13, 8),
(20, 'Hotel New York Skyline', '500 Times Square, New York', 5, 8, 14, 9);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `country`, `city`) VALUES
(1, 'France', 'Paris'),
(2, 'France', 'Nice'),
(3, 'UK', 'London'),
(4, 'UK', 'Manchester'),
(5, 'Germany', 'Berlin'),
(6, 'Germany', 'Munich'),
(7, 'Japan', 'Tokyo'),
(8, 'Japan', 'Osaka'),
(9, 'USA', 'New York'),
(10, 'USA', 'Los Angeles');

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
  `location_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `price`, `duration`, `descriptions`, `availability`, `commission_rate`, `image_url`, `location_id`, `start_date`, `expire_date`) VALUES
(31, 10, 10, '**Berlin: A Blend of History and Modernity**\r\n\r\nBerlin, the capital of **Germany**, is a vibrant city rich in history, culture, and modern-day innovation. From historic landmarks to lively arts scenes, Berlin offers something for every traveler. Here\'s a glimpse of what makes Berlin an amazing destination:\r\n\r\n### **1. Berlin Wall and East Side Gallery**\r\n\r\nThe **Berlin Wall**, once a symbol of division during the Cold War, is now an important part of the city\'s history. Visitors can explore the **East Side Gallery**, a 1.3-kilometer stretch of the wall that has been transformed into an open-air gallery, showcasing murals and artworks reflecting the spirit of freedom and unity.\r\n\r\n### **2. Brandenburg Gate**\r\n\r\nOne of Berlin’s most iconic landmarks, the **Brandenburg Gate** is a neoclassical monument that has stood through significant moments in history. Originally a symbol of division, today it represents the reunification of Germany and is a must-see for anyone visiting Berlin.\r\n\r\n### **3. Reichstag Building**\r\n\r\nThe **Reichstag**, the seat of the German parliament, is a stunning blend of historic and modern architecture. Its glass dome offers spectacular panoramic views of Berlin and symbolizes transparency in Germany\'s democracy.\r\n\r\n### **4. Museum Island**\r\n\r\nBerlin is home to one of the most important collections of art and antiquities in the world, housed on **Museum Island**. The **Pergamon Museum** and the **Altes Museum** are among the top attractions for art and history lovers.\r\n\r\n### **5. Alexanderplatz**\r\n\r\nA bustling square at the heart of Berlin, **Alexanderplatz** is filled with shops, restaurants, and historic landmarks. The **Berlin TV Tower** offers incredible views of the city, and nearby, you’ll find the iconic **World Clock**.\r\n\r\n### **6. Berlin Cathedral (Berliner Dom)**\r\n\r\nBerlin\'s **Berliner Dom** is an architectural masterpiece. Its impressive baroque design and stunning interiors make it a popular attraction. The dome also offers incredible views of the city’s skyline.\r\n\r\n### **7. Checkpoint Charlie**\r\n\r\nAnother historical site that played a significant role during the Cold War is **Checkpoint Charlie**, the famous crossing point between East and West Berlin. Today, the museum offers an insight into the stories of escape attempts and the history of Berlin during this era.\r\n\r\n### **8. The Memorial to the Murdered Jews of Europe (Holocaust Memorial)**\r\n\r\nThis solemn and thought-provoking site is dedicated to the memory of the Jewish victims of the Holocaust. The **memorial** is made up of 2,711 concrete slabs arranged in a grid pattern, offering visitors a chance to reflect on the past.\r\n\r\n### **9. Tiergarten Park**\r\n\r\n**Tiergarten** is Berlin’s largest and most famous park, offering peaceful walking paths, lakes, and beautiful greenery. It’s the perfect place for a relaxing day or a picnic amidst the city’s hustle and bustle.\r\n\r\n### **10. Modern Art and Nightlife**\r\n\r\nBerlin is also known for its cutting-edge art galleries, vibrant street art scene, and lively nightlife. The city is home to numerous underground clubs, trendy cafes, and experimental music scenes, making it a great destination for young and creative travelers.\r\n\r\nBerlin’s mix of historical sites, modern attractions, and progressive culture makes it a must-visit city for those interested in experiencing both the past and future. Whether you’re a history buff, an art lover, or simply someone looking to explore a city full of energy and life, Berlin has something to offer!\r\n', 10, 10, 'https://drive.google.com/file/d/1qPbUz-qT4MmmHcR2LdDPDEcesa1mqpZ5/view?usp=sharing', 5, NULL, NULL),
(32, 20, 20, '**Nice, France: A Mediterranean Gem**\r\n\r\nNice, located on the **French Riviera**, is one of the most picturesque and celebrated cities in France. Known for its stunning coastal views, Mediterranean charm, and vibrant cultural scene, Nice attracts visitors from around the world. Here\'s a look at what makes **Nice** so special:\r\n\r\n### **1. Beautiful Mediterranean Views**\r\n\r\nNice is renowned for its stunning **blue waters** and the famous **Promenade des Anglais**, which stretches along the **seafront**. The city offers sweeping views of the Mediterranean Sea, making it the perfect destination for beach lovers and those seeking tranquility by the water. The surrounding hills and lush greenery create a perfect contrast with the turquoise sea.\r\n\r\n### **2. Old Town (Vieux Nice)**\r\n\r\nThe **Old Town**, or **Vieux Nice**, is a maze of narrow streets, colorful buildings, and charming squares. Here, visitors can explore the lively **Cours Saleya Market**, filled with flowers, fruits, and local goods. The vibrant atmosphere of the Old Town, with its cafes, shops, and bars, captures the essence of Nice’s rich history.\r\n\r\n### **3. Castle Hill (Colline du Château)**\r\n\r\nOne of the best spots in Nice to take in panoramic views of the city is **Castle Hill**. From here, you can enjoy stunning vistas of the city, the bay, and the surrounding hills. Though the original castle was destroyed, the park and the **viewpoint** still stand as a popular attraction.\r\n\r\n### **4. Beautiful Beaches**\r\n\r\nNice is home to some beautiful beaches along its coastline, both private and public. The beaches are a perfect place to relax and enjoy the sun, or you can take part in various water sports like **swimming**, **yachting**, and **kayaking**.\r\n\r\n### **5. Art and Culture**\r\n\r\nNice is also a hub for art and culture. The city is home to the **Marc Chagall National Museum**, which showcases works by the famous artist. The **Matisse Museum** also highlights the city’s vibrant arts scene. Nice is also known for its **Theatre de Verdure** and various music festivals, which offer a rich cultural experience.\r\n\r\n### **6. French Cuisine and Markets**\r\n\r\nNice is a haven for food lovers, offering delicious **Mediterranean cuisine**, including **salads**, **fresh seafood**, and the local specialty, **socca** (a type of chickpea pancake). Don’t miss a visit to the **Cours Saleya Market**, where you can sample local produce, flowers, and artisanal products.\r\n\r\n### **7. The Niçoise Lifestyle**\r\n\r\nThe relaxed pace of life in Nice is part of its charm. The **Niçoise lifestyle** revolves around spending time with family and friends, enjoying the beautiful surroundings, and taking leisurely walks along the seafront. The Mediterranean climate allows for outdoor dining, enjoying a café, and indulging in some local delicacies.\r\n\r\n### **8. Day Trips**\r\n\r\nNice serves as a perfect base for exploring the **French Riviera**. Nearby towns like **Cannes**, **Monaco**, and **Antibes** are just a short drive away, offering more stunning beaches, cultural attractions, and a taste of the luxurious Mediterranean lifestyle.\r\n\r\n### **In Conclusion:**\r\n\r\nNice is a beautiful mix of **natural beauty**, **culture**, and **relaxation**, with something to offer for every type of traveler. Whether you\'re here to explore history, soak up the sun, or simply enjoy the laid-back Mediterranean life, **Nice** promises to be an unforgettable experience.\r\n', 20, 20, 'https://drive.google.com/file/d/18-LjvpPzv0wdBhezb8jAAqPJFWH4YCo1/view?usp=sharing', 2, NULL, NULL),
(34, 34, 10, 'wewe', 2, 3, 'wewew', 10, '2025-05-31', '2025-06-10');

--
-- Triggers `package`
--
DELIMITER $$
CREATE TRIGGER `update_expire_date` BEFORE INSERT ON `package` FOR EACH ROW BEGIN
    SET NEW.expire_date = DATE_ADD(NEW.start_date, INTERVAL NEW.duration DAY);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `package_hotel`
--

CREATE TABLE `package_hotel` (
  `package_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_hotel`
--

INSERT INTO `package_hotel` (`package_id`, `hotel_id`) VALUES
(31, 11),
(32, 5);

-- --------------------------------------------------------

--
-- Table structure for table `package_location`
--

CREATE TABLE `package_location` (
  `location_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_location`
--

INSERT INTO `package_location` (`location_id`, `package_id`) VALUES
(2, 32),
(5, 31);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `package_location`
--
ALTER TABLE `package_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
