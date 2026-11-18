-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2026 at 11:31 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

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
-- Table structure for table `cafeterias`
--

DROP TABLE IF EXISTS `cafeterias`;
CREATE TABLE `cafeterias` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafeterias`
--

INSERT INTO `cafeterias` (`id`, `name`, `image`) VALUES
(64, 'Medical Cafterial', 'Logos/cafeteriaLogo.png'),
(65, 'Engineering Cafteria', 'Logos/cafeteriaLogo.png'),
(66, 'BLK Cafe', 'Logos/BLKLogo.png'),
(67, 'Camel', 'Logos/Camellogo.png'),
(68, 'Ta\'miah', 'Logos/Ta\'miahLogo.webp'),
(69, 'Shalmoaneh', 'Logos/ShalmonehLogo.png'),
(70, 'Cloud Cafe', 'Logos/CloudLogo.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

DROP TABLE IF EXISTS `lost_items`;
CREATE TABLE `lost_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `status` enum('lost','found') DEFAULT 'lost',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`id`, `user_id`, `title`, `description`, `location`, `status`, `created_at`) VALUES
(3, NULL, 'سماعات تلفون', 'سماعات ايفون', 'medical cafeteria', 'lost', '2026-05-28 11:54:41'),
(5, NULL, 'Notebook', 'Its color is green and has my name Asma on it', 'SE labs', 'lost', '2026-05-28 20:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `cafeteria_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `cafeteria_id`, `name`, `description`, `price`, `image`, `category`, `available`, `created_at`) VALUES
(1, 68, 'falafel', 'Fresh falafel with tahini sauce', 0.80, 'Meals/falafel.jpg', 'sandwich', 1, '2026-05-19 06:32:30'),
(2, 67, 'Shawrmah', 'Juicy chicken shawarma wrapped with garlic sauce, pickles, and fresh vegetables.', 1.25, 'Meals/shawrma.jfif', 'sandwich', 1, '2026-05-19 06:44:31'),
(3, 67, 'Zenjar', 'Crispy chicken zinger sandwich served with lettuce, pickles, and special sauce in a toasted bun.', 1.25, 'Meals/zenjar.jfif', 'sandwich', 1, '2026-05-19 06:44:38'),
(4, 67, 'Potato Sandwich', 'Golden crispy french fries seasoned and served hot.', 1.00, 'Meals/Batata.jfif', 'sandwich', 1, '2026-05-19 06:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('preparing','completed') DEFAULT 'preparing',
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `meal_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `payment_status`, `created_at`, `meal_id`, `quantity`) VALUES
(12, 48, 'completed', 'unpaid', '2026-05-28 18:29:54', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
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

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `title`, `description`, `price`, `image`, `status`, `created_at`) VALUES
(1, 35, 'أقلام جافة ', 'أقلام للاستخدام اليومي', 0.25, 'uploads/1779969035_قلم.jfif', 'approved', '2026-05-28 11:50:35'),
(2, 48, 'مطرزات', 'مطرزات يدوية بأشكال مختلفة مصنوعة بحب', 0.50, 'uploads/1779994365_وردة.jpg', 'approved', '2026-05-28 18:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_requests`
--

DROP TABLE IF EXISTS `product_requests`;
CREATE TABLE `product_requests` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_requests`
--

INSERT INTO `product_requests` (`id`, `product_id`, `buyer_id`, `seller_id`, `message`, `created_at`) VALUES
(6, 1, 6, 35, 'How can I contact with you?', '2026-05-28 15:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'student',
  `proof_file` varchar(255) DEFAULT NULL,
  `faculty` varchar(30) DEFAULT NULL,
  `pending` tinyint(4) DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `proof_file`, `faculty`, `pending`, `profile_image`) VALUES
(1, 'asma', 'asma@gmail.com', '$2y$10$7G2EX0LzkkPnyz00FNzFsuRFpm2MvVtI1c8KkYvdK5M6jcgfEQ/x6', 'student', NULL, NULL, 0, 'user.png'),
(2, 'barah', 'barah@just.edu.jo', '$2y$10$V1FJgkkDc/C2vth8vYmrV.6Vey4Od15WpjljW6BAAbB4dPWexWyhS', 'student', NULL, NULL, 0, 'user.png'),
(4, 'Asma', '1234@just.edu.jo', '$2y$10$aMDfCFFthyPg9f5eUr5owe7gIt3PSn6TzozewgowiZ3/vT1gRLRfe', 'student', NULL, NULL, 0, 'user.png'),
(5, 'Asma', '12345@just.edu.jo', '$2y$10$Wy38sOHFf9ISr96oL6I5y.K/D5l0GJUTZXIHyd69QuN8lAAQZPQay', 'student', NULL, NULL, 0, 'user.png'),
(6, 'Asma', '123456@just.edu.jo', '$2y$10$Oo/2l6jhJtH6x9LlL8rn3OMM05.8.12gDlRmHKDqotp/BXhDiiu4y', 'student', NULL, NULL, 0, 'user.png'),
(8, 'Asma', '123@just.edu.jo', '$2y$10$579iO8R.lNUqqtWCbYE3MOscOy2p8.E9d.T3Uj6ZCi6j7e/xkOKGi', 'student', NULL, NULL, 0, 'user.png'),
(10, 'barah', 'ss2@just.edu.jo', '$2y$10$oNC4Z1kH64NGNxCl77wHG.gnQDsUNIkILYn6AGfDs.uUBbcrSXl3G', 'student', NULL, NULL, 0, 'user.png'),
(12, 'asm', '1111@just.edu.jo', '$2y$10$lfkuBaCpj4KD6Wye7fgtm.qGYzlA6mqtq3xDxrC6/AbsLu4XOFnZO', 'student', NULL, NULL, 0, 'user.png'),
(15, 'amal', 'ama@just.edu.jo', '$2y$10$FZNFvuwrmNkEQnITy6ydKun5jcJkZNNFd.Tn6Aa3SBXrQWtWyqhHq', 'student', NULL, NULL, 0, 'user.png'),
(16, 'ahmad', 'ahmad@just.edu.jo', '$2y$10$YmzrJrXa7F3fYqp6fSFZOuceAZJkRjckeCJATYUsyBmcpWqHiHb6.', 'student', NULL, NULL, 0, 'user.png'),
(29, 'Asma Jarrah', 'aijarrah20@cit.just.edu.jo', '$2y$10$E.xb.kz3Uqnt063NtAs8n.nROzR2Qip.XHgueNS/ZpyXh1cAxYEJi', 'student', NULL, 'IT', 0, 'user.png'),
(30, 'Eman', 'eman@den.just.edu.jo', '$2y$10$r2Lcp6E3dFS5MxaoDhpwpu5rFdDkHLyQrChhmjvX3NZSjF0Q8WiaG', 'student', NULL, 'Dentistry', 0, 'user.png'),
(31, 'Asm', 'asm@just.edu.jo', '$2y$10$.As6HSrEv9XKRfEfVNzhWOFiovIP9MglWmbqxP04himzI2zw0XvgS', 'student', NULL, 'Medicine', 0, 'user.png'),
(32, 'aj3', 'aj3@just.edu.jo', '$2y$10$OWTi4WmuMp6J7PUT0oyqcuKYMxsjsBQ.V.NpvRaYcVrMEcq2JI0q2', 'student', NULL, 'Agriculture', 0, 'user.png'),
(33, 'Taima', 'taima@just.edu.jo', '$2y$12$txA037pPKOIBx0EmcOtQa.7/z8/aP0sDSrLJlzsiow28TiGV1b6Hq', 'student', NULL, 'Pharmacy', 0, '1795024381_nvd9612-butterfly-7947062.jpg'),
(34, 'asmm', 'asmm@just.edu.jo', '$2y$10$CEKYrQYGPheRhOfplMka2OZabMvjmW2zB1hyhKIJQM4SgHmyvlD4K', 'student', NULL, 'Agriculture', 0, 'user.png'),
(35, 'Eman', 'eman@med.just.edu.jo', '$2y$10$KxvVhfE5Q.cg/8Tk2aDBl.EskXd78IrdoH8GZh8Rq4P5FN/tfZIRS', 'admin', NULL, '', 0, 'user.png'),
(47, 'Mohammed', 'mohammed@gmail.com', '$2y$10$hrzmftmPAmtIrVwgGc6q0uA9TKnrBpvLqvJnGwpWPC.fQ7aZB.MhG', 'canteen', '../assets/images/6a1843743cb86.jpg', NULL, 0, 'user.png'),
(48, 'Malek', 'malek@just.edu.jo', '$2y$10$DILXwUqCgQhFTo75EFQtweboZbuPV79wiGX0vNp1pUlAfv/hUg8KW', 'student', NULL, '', 0, 'user.png'),
(49, 'Hamzah', 'hamzeh@gmail.com', '$2y$10$AVKYH5WuBFVhzPSFVf3k5.48UP1mEFZ9oVMmr7mNOmwaj/OkIGUMe', 'admin', '../assets/images/6a18a72556c1a.jpg', NULL, 0, 'user.png'),
(50, 'Laila', 'laila@just.edu.jo', '$2y$12$CvF/4//weW7usMKUud9RQ.cXb/G1r2VE5s.PCAguO66xuDGm1IdrC', 'student', NULL, NULL, 0, 'user.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cafeterias`
--
ALTER TABLE `cafeterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cafeteria_id` (`cafeteria_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_requests`
--
ALTER TABLE `product_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cafeterias`
--
ALTER TABLE `cafeterias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_requests`
--
ALTER TABLE `product_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD CONSTRAINT `lost_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`cafeteria_id`) REFERENCES `cafeterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
