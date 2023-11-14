-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2023 at 07:02 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boltcabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `admin_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_name`, `admin_password`) VALUES
('diggaj@boltcabs.com', '$2y$10$i00Tj9o3KpLYq2eiw1pr7uWVJBanOLHUWoeXGoOyh9fZDt0nudMSi'),
('vishwam@boltcabs.com', '$2y$10$Z3cB9Ov/i.eUC8RwK1he8ehqkS.fryIcjlx9ksLYkIg8ZP3nJkBl.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `district` varchar(30) NOT NULL,
  `dropoff_location` varchar(255) DEFAULT NULL,
  `booking_status` varchar(50) DEFAULT NULL,
  `pickup_datetime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expiration_datetime` datetime DEFAULT NULL,
  `car_id` int DEFAULT NULL,
  `distance` int DEFAULT NULL,
  `cost` int DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `fk_car_id` (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_email`, `pickup_location`, `district`, `dropoff_location`, `booking_status`, `pickup_datetime`, `created_at`, `expiration_datetime`, `car_id`, `distance`, `cost`) VALUES
(10114, 'diggajpro7@gmail.com', 'unnamed road, North Goa District, - 403107, Goa, India', 'North Goa', 'margao, goa', 'Confirmed', '2023-11-08 20:23:00', '2023-11-06 05:53:56', '2023-11-08 21:06:10', 1, 45, 1400),
(10115, 'diggajpro7@gmail.com', 'GOA UNIVERSITY, GOA', 'North Goa', 'butterfly beach, goa', 'Confirmed', '2023-11-09 20:26:00', '2023-11-06 05:56:26', '2023-11-09 21:37:31', 1, 64, 1640);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

DROP TABLE IF EXISTS `otp`;
CREATE TABLE IF NOT EXISTS `otp` (
  `user_id` varchar(200) NOT NULL,
  `otpnum` int DEFAULT NULL,
  `expiry` timestamp NULL DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`user_id`, `otpnum`, `expiry`, `token`) VALUES
('diggajpro7@gmail.com', 621962, '2023-10-02 12:06:32', '99999'),
('diggajugvekar@gmail.com', 944540, '2023-09-03 06:52:32', NULL),
('ugvekarmanasi@gmail.com', 104448, '2023-10-30 03:50:51', NULL),
('diggajinindia123@gmail.com', 423741, '2023-11-05 06:22:56', NULL),
('ugvekardiggaj13@gmail.com', 245025, '2023-11-13 20:56:17', '99999');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_phone` bigint NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`) VALUES
(1, 'Diggaj Ugvekar', 918275294821, 'diggajpro7@gmail.com', '$2y$10$O5B6EpOvzN7LWDFv872XBup07nohm4zyxrrFRF0g80PNuk2NE6M2.'),
(8, 'Diggaj Ugvekar', 918390299421, 'diggajinindia123@gmail.com', '$2y$10$AEPZyk5cx8baxU2gccb.qeR51HxoSA4VkN0FvLTd0Bn7/.QjnliH6'),
(9, 'DJ', 918390299421, 'ugvekardiggaj13@gmail.com', '$2y$10$kZbEaVqd025KRGB2vbf5YOqQ95i59lPbtMBZ4AswlcYijSbjRzeNG');

-- --------------------------------------------------------

--
-- Table structure for table `taxis`
--

DROP TABLE IF EXISTS `taxis`;
CREATE TABLE IF NOT EXISTS `taxis` (
  `taxi_id` int NOT NULL AUTO_INCREMENT,
  `taxi_regno` varchar(255) DEFAULT NULL,
  `taxi_model` varchar(255) DEFAULT NULL,
  `taxi_color` varchar(255) DEFAULT NULL,
  `taxi_capacity` int DEFAULT NULL,
  `taxi_type` varchar(255) DEFAULT NULL,
  `taxi_image` varchar(255) DEFAULT NULL,
  `taxi_location` varchar(255) DEFAULT NULL,
  `taxi_drivername` varchar(255) DEFAULT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`taxi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taxis`
--

INSERT INTO `taxis` (`taxi_id`, `taxi_regno`, `taxi_model`, `taxi_color`, `taxi_capacity`, `taxi_type`, `taxi_image`, `taxi_location`, `taxi_drivername`, `base_price`) VALUES
(1, 'GA01AB1234', 'Mercedes S-Class', 'Black', 4, 'Premium', 'img/taxi1.jpg', 'Calangute, North Goa', 'Rajesh Kumar', '1000.00'),
(2, 'GA02CD5678', 'Toyota Corolla', 'White', 4, 'Standard', 'img/taxi2.jpg', 'Panaji, North Goa', 'Priya Sharma', '200.00'),
(3, 'GA03EF9012', 'Audi A6', 'Silver', 4, 'Premium', 'img/taxi3.jpg', 'Porvorim, North Goa', 'Amit Patel', '450.00'),
(4, 'GA04GH3456', 'Honda Civic', 'Blue', 4, 'Standard', 'img/taxi4.jpg', 'Anjuna, North Goa', 'Sneha Verma', '200.00'),
(5, 'GA05IJ7890', 'BMW 3 Series', 'Black', 4, 'Premium', 'img/taxi5.jpg', 'Vagator, North Goa', 'Vikram Singh', '1500.00'),
(6, 'GA06KL2345', 'Toyota Camry', 'White', 4, 'Standard', 'img/taxi6.jpg', 'Canacona, South Goa', 'Shalini Mishra', '210.00'),
(7, 'GA07MN6789', 'Lexus RX', 'Silver', 4, 'Premium', 'img/taxi7.jpg', 'Margao, South Goa', 'Amit Kumar', '500.00'),
(8, 'GA08OP1234', 'Nissan Altima', 'Red', 4, 'Standard', 'img/taxi8.jpg', 'Quepem, South Goa', 'Kavita Gupta', '150.00'),
(9, 'GA09QR5678', 'Mercedes E-Class', 'White', 4, 'Premium', 'img/taxi9.jpg', 'Cortalim, South Goa', 'Sanjay Singh', '1000.00'),
(10, 'GA10ST9012', 'Honda Accord', 'White', 4, 'Standard', 'img/taxi10.jpg', 'Ponda, South Goa', 'Priyanka Sharma', '200.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
