-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 03:28 AM
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
-- Database: `food_ordering_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_qty` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `name`, `slug`, `description`, `image`, `status`, `popular`, `create_at`) VALUES
(1, 'Chinese', 'chinese', 'Serves the best chinese foods', '1725868173.jpg', 0, 1, '2024-09-09 07:50:48'),
(2, 'South Indian', 'south indian', 'Serves the best south indian foods', '1725868238.jpg', 0, 1, '2024-09-09 07:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `cat_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `cat_id`, `name`, `slug`, `description`, `price`, `image`, `status`, `popular`, `create_at`) VALUES
(1, '2', 'Idali', 'idali', 'south indian food', 30, '1725868330.jpg', 0, 1, '2024-09-09 07:52:10'),
(2, '1', 'Chinese Samosa', 'chinese samosa', 'Chinese food', 30, '1725868410.jpg', 0, 0, '2024-09-09 07:52:30'),
(3, '2', 'Masala Dhosa', 'masala dhosa', 'South Indian Food', 90, '1725868467.jpg', 0, 1, '2024-09-09 07:54:27'),
(4, '2', 'Paper Dhosa', 'paper dhosa', 'South Indian Food', 70, '1725868509.jpg', 0, 0, '2024-09-09 07:55:09'),
(5, '1', 'Manchurian', 'manchurian', 'Chinese Food', 100, '1725868566.jpg', 0, 1, '2024-09-09 07:56:06'),
(6, '1', 'Fried Rice', 'fried rice', 'Chinese Food', 100, '1725875592.jpg', 0, 1, '2024-09-09 09:53:12'),
(7, '2', 'Appam', 'appam', 'South Indian Food', 60, '1725875629.jpg', 0, 1, '2024-09-09 09:53:49'),
(8, '1', 'Spring Roll', 'spring roll', 'Chinese food item', 80, '1727073573.jpg', 0, 1, '2024-09-23 06:39:33'),
(9, '2', 'Coconut Rice', 'coconut rice', 'South Indian food', 125, '1727074224.jpg', 0, 1, '2024-09-23 06:50:24'),
(10, '2', 'Mendu Vada', 'menduvada', 'South Indian food', 40, '1727074283.jpg', 0, 1, '2024-09-23 06:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ordering_no` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ordering_no`, `user_id`, `username`, `email`, `phone`, `address`, `total_price`, `payment_mode`, `payment_id`, `status`, `create_at`) VALUES
(1, 'orderno75006', 2, 'user', 'user@gmail.com', 9512440022, 'Junagadh', 390, 'COD', '1', 1, '2024-09-25 16:50:13'),
(2, 'orderno84140', 2, 'user', 'user@gmail.com', 9512440022, 'Junagadh', 300, 'COD', '1', 1, '2024-09-25 16:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_qty` int(11) NOT NULL,
  `menu_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_qty`, `menu_price`) VALUES
(1, 1, 4, 3, 70),
(2, 1, 3, 2, 90),
(3, 2, 6, 1, 100),
(4, 2, 5, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneno` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phoneno`, `password`, `role`, `create_at`) VALUES
(1, 'harsh', 'harsh@gmail.com', '9512440022', 'd4e3730e8cba214f85cddae5f9331d74', 1, '2024-08-27 12:51:50'),
(2, 'user', 'user@gmail.com', '9512440022', 'ee11cbb19052e40b07aac0ca060c23ee', 0, '2024-08-27 12:52:51'),
(3, 'meet', 'meet@gmail.com', '9512440022', 'df421bd994d485f5d58ce2445cf2ee0e', 0, '2024-08-27 12:53:20'),
(4, 'jaymin', 'jaymin@gmail.com', '9512440022', '1a2643545b7abb309405aa7428557279', 0, '2024-08-27 12:53:48'),
(5, 'aarsh', 'aarsh@gmail.com', '9512440022', 'c58d7e3a3fd3e121303e49a5fae87f9a', 0, '2024-08-27 12:54:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
