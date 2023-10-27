-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2023 at 02:02 PM
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
  `car_id` int DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `fk_car_id` (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10041 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_email`, `pickup_location`, `district`, `dropoff_location`, `booking_status`, `pickup_datetime`, `created_at`, `car_id`) VALUES
(10040, 'diggajpro7@gmail.com', 'porvorim goa', 'North Goa', 'Ponda, goa', 'Confirmed', '2023-10-11 20:31:00', '2023-10-13 15:01:48', 2),
(10039, 'diggajpro7@gmail.com', 'porvorim goa', 'North Goa', 'Ponda, goa', 'Confirmed', '2023-10-18 18:14:00', '2023-10-13 12:44:03', 3);

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
('diggajugvekar@gmail.com', 944540, '2023-09-03 06:52:32', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`) VALUES
(1, 'Diggaj U', 918275294820, 'diggajpro7@gmail.com', '$2y$10$O5B6EpOvzN7LWDFv872XBup07nohm4zyxrrFRF0g80PNuk2NE6M2.');

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
  `taxi_status` varchar(255) DEFAULT NULL,
  `taxi_image` varchar(255) DEFAULT NULL,
  `taxi_location` varchar(255) DEFAULT NULL,
  `taxi_drivername` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`taxi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `taxis`
--

INSERT INTO `taxis` (`taxi_id`, `taxi_regno`, `taxi_model`, `taxi_color`, `taxi_capacity`, `taxi_type`, `taxi_status`, `taxi_image`, `taxi_location`, `taxi_drivername`) VALUES
(1, 'GA01AB1234', 'Mercedes S-Class', 'Black', 4, 'Premium', 'Booked', 'img/taxi1.jpg', 'Calangute, North Goa', 'Rajesh Kumar'),
(2, 'GA02CD5678', 'Toyota Corolla', 'White', 4, 'Standard', 'Booked', 'img/taxi2.jpg', 'Panaji, North Goa', 'Priya Sharma'),
(3, 'GA03EF9012', 'Audi A6', 'Silver', 4, 'Premium', 'Booked', 'img/taxi3.jpg', 'Porvorim, North Goa', 'Amit Patel'),
(4, 'GA04GH3456', 'Honda Civic', 'Blue', 4, 'Standard', 'Available', 'img/taxi4.jpg', 'Anjuna, North Goa', 'Sneha Verma'),
(5, 'GA05IJ7890', 'BMW 3 Series', 'Black', 4, 'Premium', 'Booked', 'img/taxi5.jpg', 'Vagator, North Goa', 'Vikram Singh'),
(6, 'GA06KL2345', 'Toyota Camry', 'White', 4, 'Standard', 'Booked', 'img/taxi6.jpg', 'Canacona, South Goa', 'Shalini Mishra'),
(7, 'GA07MN6789', 'Lexus RX', 'Silver', 4, 'Premium', 'Booked', 'img/taxi7.jpg', 'Margao, South Goa', 'Amit Kumar'),
(8, 'GA08OP1234', 'Nissan Altima', 'Red', 4, 'Standard', 'Available', 'img/taxi8.jpg', 'Quepem, South Goa', 'Kavita Gupta'),
(9, 'GA09QR5678', 'Mercedes E-Class', 'White', 4, 'Premium', 'Available', 'img/taxi9.jpg', 'Cortalim, South Goa', 'Sanjay Singh'),
(10, 'GA10ST9012', 'Honda Accord', 'White', 4, 'Standard', 'Available', 'img/taxi10.jpg', 'Ponda, South Goa', 'Priyanka Sharma');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
