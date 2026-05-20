-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 02:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `just_community`
--

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `status` enum('lost','found') DEFAULT 'lost',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_name` varchar(150) DEFAULT NULL,
  `status` enum('preparing','completed') DEFAULT 'preparing',
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'student',
  `isverified` tinyint(4) DEFAULT 0,
  `phone` varchar(20) DEFAULT NULL,
  `proof_file` varchar(255) DEFAULT NULL,
  `faculty` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `isverified`, `phone`, `proof_file`, `faculty`) VALUES
(1, 'asma', 'asma@gmail.com', '$2y$10$7G2EX0LzkkPnyz00FNzFsuRFpm2MvVtI1c8KkYvdK5M6jcgfEQ/x6', 'student', 0, NULL, NULL, NULL),
(2, 'barah', 'barah@just.edu.jo', '$2y$10$V1FJgkkDc/C2vth8vYmrV.6Vey4Od15WpjljW6BAAbB4dPWexWyhS', 'student', 0, NULL, NULL, NULL),
(4, 'Asma', '1234@just.edu.jo', '$2y$10$aMDfCFFthyPg9f5eUr5owe7gIt3PSn6TzozewgowiZ3/vT1gRLRfe', 'student', 1, NULL, NULL, NULL),
(5, 'Asma', '12345@just.edu.jo', '$2y$10$Wy38sOHFf9ISr96oL6I5y.K/D5l0GJUTZXIHyd69QuN8lAAQZPQay', 'student', 1, NULL, NULL, NULL),
(6, 'Asma', '123456@just.edu.jo', '$2y$10$Oo/2l6jhJtH6x9LlL8rn3OMM05.8.12gDlRmHKDqotp/BXhDiiu4y', 'student', 1, NULL, NULL, NULL),
(8, 'Asma', '123@just.edu.jo', '$2y$10$579iO8R.lNUqqtWCbYE3MOscOy2p8.E9d.T3Uj6ZCi6j7e/xkOKGi', 'student', 1, NULL, NULL, NULL),
(10, 'barah', 'ss2@just.edu.jo', '$2y$10$oNC4Z1kH64NGNxCl77wHG.gnQDsUNIkILYn6AGfDs.uUBbcrSXl3G', 'student', 0, NULL, NULL, NULL),
(12, 'asm', '1111@just.edu.jo', '$2y$10$lfkuBaCpj4KD6Wye7fgtm.qGYzlA6mqtq3xDxrC6/AbsLu4XOFnZO', 'student', 0, NULL, NULL, NULL),
(15, 'amal', 'ama@just.edu.jo', '$2y$10$FZNFvuwrmNkEQnITy6ydKun5jcJkZNNFd.Tn6Aa3SBXrQWtWyqhHq', 'student', 1, NULL, NULL, NULL),
(16, 'ahmad', 'ahmad@just.edu.jo', '$2y$10$YmzrJrXa7F3fYqp6fSFZOuceAZJkRjckeCJATYUsyBmcpWqHiHb6.', 'student', 0, NULL, NULL, NULL),
(27, 'amal', '', '', 'staff', 0, '333333', '../uploads/6a0369cef2df7.jpg', NULL),
(29, 'Asma Jarrah', 'aijarrah20@cit.just.edu.jo', '$2y$10$E.xb.kz3Uqnt063NtAs8n.nROzR2Qip.XHgueNS/ZpyXh1cAxYEJi', 'student', 0, NULL, NULL, 'IT'),
(30, 'Eman', 'eman@den.just.edu.jo', '$2y$10$r2Lcp6E3dFS5MxaoDhpwpu5rFdDkHLyQrChhmjvX3NZSjF0Q8WiaG', 'student', 0, NULL, NULL, 'Dentistry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD CONSTRAINT `lost_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
