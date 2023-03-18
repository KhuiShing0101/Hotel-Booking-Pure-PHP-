-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 07:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(4, 'Alarm clock', 2, '2023-02-20 10:57:48', '2023-02-21 09:34:20', 2, 2, '2023-02-21 09:35:24', 2),
(3, '43” LED TV', 1, '2023-02-20 10:55:24', '2023-02-21 09:35:47', 2, 2, NULL, NULL),
(5, 'Wooden clothes brush', 1, '2023-02-21 07:07:57', '2023-02-21 07:07:57', 2, 2, NULL, NULL),
(6, 'Flashlight', 1, '2023-02-23 08:07:06', '2023-02-23 08:07:06', 2, 2, NULL, NULL),
(7, 'ron and ironing board', 1, '2023-02-23 08:07:15', '2023-02-23 08:07:15', 2, 2, NULL, NULL),
(8, 'Shoe horn', 1, '2023-02-23 08:07:38', '2023-02-23 08:07:38', 2, 2, NULL, NULL),
(9, 'Tele Phone', 1, '2023-03-13 02:07:32', '2023-03-13 02:07:32', 4, 4, NULL, NULL),
(10, 'Flash Lighting', 1, '2023-03-13 04:45:51', '2023-03-13 04:45:51', 4, 4, NULL, NULL),
(11, 'Music Box', 3, '2023-03-13 04:46:41', '2023-03-13 04:46:41', 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Double / Twin', '2023-02-21 09:49:29', '2023-02-21 09:49:29', 2, 2, '2023-02-28 08:10:19', 2),
(2, 'Double', '2023-02-21 09:55:05', '2023-02-21 09:55:05', 2, 2, '2023-02-21 10:05:38', 2),
(3, 'Sing Bed', '2023-02-23 07:05:31', '2023-02-23 07:05:31', 2, 2, NULL, NULL),
(4, 'Extra Bed', '2023-02-23 07:05:38', '2023-02-23 07:05:38', 2, 2, NULL, NULL),
(5, 'Triple Bed', '2023-03-13 01:42:47', '2023-03-13 01:42:47', 4, 4, NULL, NULL),
(6, 'Family Bed', '2023-03-13 02:42:23', '2023-03-13 02:42:23', 4, 4, NULL, NULL),
(7, 'Gold Bed', '2023-03-13 03:28:21', '2023-03-13 03:28:21', 4, 4, NULL, NULL),
(8, 'Model 1 Bed', '2023-03-13 04:49:00', '2023-03-13 04:49:00', 4, 4, NULL, NULL),
(9, 'Double', '2023-03-13 06:05:25', '2023-03-13 06:05:25', 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `checkout_out_date` date NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `is_extra_bed` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `price` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `occupancy` mediumint(8) UNSIGNED NOT NULL,
  `bed_id` int(10) UNSIGNED NOT NULL,
  `size` double UNSIGNED NOT NULL,
  `view_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `detail` text NOT NULL,
  `price_per_day` int(10) UNSIGNED NOT NULL,
  `extra_bed_price_per_day` int(10) UNSIGNED NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `occupancy`, `bed_id`, `size`, `view_id`, `description`, `detail`, `price_per_day`, `extra_bed_price_per_day`, `thumbnail`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Deluxe Room', 3, 1, 36.6, 4, 'LOTTE HOTEL YANGON’s sophisticated and contemporary Deluxe Rooms are located from 3rd to 10th floor and are the best options for the budget trip.', 'Extra bed is available for $50 (including VAT and service charge) per person without breakfast.\r\nAll rates are subject to a 10% service charge and a 5% tax.', 40000, 20000, NULL, '2023-02-23 09:42:01', '2023-02-23 09:42:01', 2, 2, NULL, NULL),
(2, 'Premier Lake Room', 3, 1, 30, 4, 'LOTTE HOTEL YANGON’s Premier Lake Rooms are located between the 3rd and 10th floors and offer a beautiful view of Inya lake, one of the most scenic vistas in all of Yangon.', 'Extra bed is available for $50 (including VAT and service charge) per person without breakfast\r\nAll rates are subject to a 10% service charge and a 5% tax.', 50000, 20000, NULL, '2023-02-24 07:22:53', '2023-02-24 07:22:53', 2, 2, NULL, NULL),
(3, 'sadf', 2, 3, 23, 4, 'sadf', 'sadf', 3444, 23333, NULL, '2023-03-01 09:29:28', '2023-03-01 09:29:28', 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_amenities`
--

CREATE TABLE `room_amenities` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `amenities_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_cancel`
--

CREATE TABLE `room_cancel` (
  `id` int(10) UNSIGNED NOT NULL,
  `reservation_id` int(10) UNSIGNED NOT NULL,
  `remark` mediumtext NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_gallery`
--

CREATE TABLE `room_gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_gallery`
--

INSERT INTO `room_gallery` (`id`, `room_id`, `image_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 2, 'processed-1a5b608d-da46-43e0-b370-8301271351de_rsL9WBjn_1678098652_95.jpeg', '2023-03-06 10:30:52', '2023-03-06 10:30:52', 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_special_features_id`
--

CREATE TABLE `room_special_features_id` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `special_features_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `special_features`
--

CREATE TABLE `special_features` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `special_features`
--

INSERT INTO `special_features` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Each room of the hotel commands resplendent views of Inya Lake.', '2023-02-20 10:39:10', '2023-02-21 09:35:54', 2, 2, NULL, NULL),
(2, 'Super premium bedding sets: Top class beds and bedding for a perfect night’s sleep.', '2023-02-20 10:39:37', '2023-02-20 10:39:37', 2, 2, '2023-02-21 07:00:23', 2),
(3, 'Complimentary use of our Fitness Center (including swimming pool).', '2023-02-20 10:39:54', '2023-02-20 10:39:54', 2, 2, '2023-02-20 10:41:08', 2),
(4, 'Super premium bedding sets: Top class beds and bedding for a perfect night’s sleep.', '2023-02-23 08:00:23', '2023-02-23 08:00:23', 2, 2, NULL, NULL),
(5, 'Complimentary use of our Fitness Center (including swimming pool).', '2023-02-23 08:00:36', '2023-02-23 08:00:36', 2, 2, NULL, NULL),
(6, 'Free high-speed wireless internet in all rooms.', '2023-02-23 08:00:48', '2023-02-23 08:00:48', 2, 2, NULL, NULL),
(7, 'Turndown service at guest’s request', '2023-02-23 08:01:03', '2023-02-23 08:01:03', 2, 2, NULL, NULL),
(8, 'High Internet Speed is provided.', '2023-03-13 01:49:51', '2023-03-13 01:49:51', 4, 4, NULL, NULL),
(9, 'Cool Air ', '2023-03-13 04:51:36', '2023-03-13 04:51:36', 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(4, 'admin', 'admin@email.com', '6b2ec0bb98ea745b63b72cd67d2b4534');

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `view`
--

INSERT INTO `view` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(2, 'Doubles', '2023-02-17 04:57:21', '2023-02-21 10:04:06', 2, 2, NULL, NULL),
(4, 'Lake View', '2023-02-17 07:00:22', '2023-02-21 06:54:42', 2, 2, NULL, NULL),
(5, 'Mountain View', '2023-02-17 07:05:40', '2023-02-17 07:05:40', 2, 2, '2023-02-21 10:05:28', 2),
(6, 'Root View', '2023-02-17 07:06:51', '2023-02-17 07:06:51', 2, 2, '2023-02-20 08:21:13', 2),
(9, 'Triple Bed', '2023-03-13 01:39:15', '2023-03-13 01:39:15', 4, 4, NULL, NULL),
(8, 'Sky Beach View', '2023-03-12 15:57:58', '2023-03-12 15:57:58', 4, 4, NULL, NULL),
(10, 'Triple Bed', '2023-03-13 01:40:41', '2023-03-13 01:40:41', 4, 4, NULL, NULL),
(11, 'Sky Lane View', '2023-03-13 04:53:13', '2023-03-13 04:53:13', 4, 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_cancel`
--
ALTER TABLE `room_cancel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_gallery`
--
ALTER TABLE `room_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_special_features_id`
--
ALTER TABLE `room_special_features_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_features`
--
ALTER TABLE `special_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_cancel`
--
ALTER TABLE `room_cancel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_gallery`
--
ALTER TABLE `room_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_special_features_id`
--
ALTER TABLE `room_special_features_id`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_features`
--
ALTER TABLE `special_features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `view`
--
ALTER TABLE `view`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
