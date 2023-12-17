-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 17, 2023 at 03:28 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kakai_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_contact` varchar(255) NOT NULL,
  `prod_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `prod_img`, `prod_price`, `prod_desc`, `prod_contact`, `prod_status`, `user_id`) VALUES
(1, 'iphone15 edited', '04-pic.jpeg', 60000, '                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.                                ', 'https://www.facebook.com/patiphannnedited', 1, 1),
(2, 'Honda Civic Type R', 'civic-type-r.jpeg', 1000000, 'The best honda civic type r', 'https://www.facebook.com/patiphannn', 1, 1),
(4, 'product 3', 'product-3.png', 5000, 'product 3 description', 'https://facebook.com/user1', 1, 1),
(5, 'product 4', 'product-4.png', 6000, 'product 4 description', 'https://facebook.com/user1', 1, 1),
(6, 'product 5', 'product-5.png', 8000, 'product 5 description', 'https://facebook.com/user1', 1, 1),
(7, 'product 6 ', 'product-6.png', 1000, 'product 6 description', 'https://facebook.com/user1', 1, 1),
(8, 'product 7', 'product-7.png', 50000, 'product 7 description', 'https://facebook.com/user1', 1, 1),
(9, 'product 8', 'product-8.png', 30000, 'product 8 description', 'https://facebook.com/user1', 1, 1),
(10, 'product 9', 'product-9.png', 3000, 'product 9 description', 'https://facebook.com/user1', 1, 1),
(11, 'product 10', 'product-10.png', 9900, 'product 10 description', 'https://facebook.com/user1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'milerdev', 'milerdev@gmail.com', '$2y$10$6usSZxTqdUMSx0WeislDBunpYsceXyPOiNkvrtOzCAbTJ7NwvsTtm'),
(2, 'john', 'johndoe@gmail.com', '$2y$10$d0zVYBJskIKfMIDQI0UBLuimomBMpOocSMwJFrsQ1TjJ/Vu4eCRPW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
