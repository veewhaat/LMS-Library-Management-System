-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 05:12 AM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_password_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `username`, `email`, `password`, `is_active`, `last_login`, `created`, `modified`, `reset_password_token`, `reset_token_expires`) VALUES
(2, 'Vishaall Kanagasabai', 'veewhaat', 'vishaallngat@gmail.com', '$2y$10$2vjjWzOcCY1Nw/ZtWYH2K.aRM56xl6KX7ljVPjQ8c.5iyco4Rym16', 1, NULL, '2025-10-07 08:27:23', '2025-10-13 02:25:38', 'a53dc4acdcae99b0939c6ec9025cdaea3194a2c1', '2025-10-14 02:25:38'),
(3, 'New User', 'newuser123', 'new@test.com', '$2y$10$Zv1Pue.iP8zPlw0PxLvlweRFHEg4d17PBporhq3vEJX8d78iKJo5q', 1, NULL, '2025-10-07 08:40:33', '2025-10-07 08:40:33', NULL, NULL),
(6, 'Test User', 'testuser', 'test@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NULL, '2025-10-07 16:52:11', '2025-10-07 16:52:11', NULL, NULL),
(9, 'Brenta ', 'Brenta10', 'brenta@gmail.com', '$2y$10$HZD6bJTjBZ/C4nimOIaPOOs2n93ODO.Iw842ufYu8JwPHmEzIAWLG', 1, NULL, '2025-10-08 02:35:54', '2025-10-08 02:35:54', NULL, NULL),
(14, 'admin1', 'admin1', 'admin1@gmail.com', '$2y$10$hBy9B.6nVH8iCmqoGcR81.bEOamXNFEIX2/WvLi3HCTiT7oZluBTq', 1, NULL, '2025-10-09 01:55:35', '2025-10-09 01:55:35', NULL, NULL),
(17, 'Test Admin ', 'testadmin', 'testadmin@gmail.com', '$2y$10$thuEh4rhRbjAZOh4il7hqeQSel7VCdZofkI1ntd/nN5dgbbM5eS4W', 1, NULL, '2025-10-09 02:30:04', '2025-10-09 02:30:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `book_type` varchar(100) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `purchase_date` date NOT NULL,
  `edition` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `pages` int(11) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT 'veewhaat',
  `modified_by` varchar(50) DEFAULT 'veewhaat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `book_type`, `author_name`, `quantity`, `purchase_date`, `edition`, `price`, `pages`, `publisher`, `created`, `modified`, `created_by`, `modified_by`) VALUES
('1234567898765', 'Harry Potter and the Philosopher\'s Stone', 'Novel ', 'J. K. Rowling', 10, '2025-10-06', '2', 62.90, 321, 'Bloomsbury Publishing Plc', '2025-10-09 06:31:09', '2025-10-09 06:31:20', 'veewhaat', 'veewhaat'),
('9234567898768', 'The Lion King', 'Story Book', 'Simba JR', 50, '2025-10-11', '3', 10.00, 15, 'Disney Publishing Worldwide', '2025-10-13 01:51:16', '2025-10-13 01:51:16', 'veewhaat', 'veewhaat');

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE `issued` (
  `issued_id` int(11) NOT NULL,
  `member` varchar(255) NOT NULL,
  `number` varchar(50) NOT NULL,
  `book_number` varchar(50) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('Issued','Returned','Not Returned') NOT NULL DEFAULT 'Issued',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT 'veewhaat',
  `modified_by` varchar(50) DEFAULT 'veewhaat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `issued`
--

INSERT INTO `issued` (`issued_id`, `member`, `number`, `book_number`, `book_title`, `issue_date`, `due_date`, `status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'Vishaall', 'B032210418', '1234567898765', 'Harry Potter and the Philosopher\'s Stone', '2025-10-09', '2025-10-10', 'Returned', '2025-10-09 07:13:49', '2025-10-10 02:37:39', 'testadmin', 'testadmin'),
(2, 'Eva', 'B032210418', '1234567898765', 'Harry Potter and the Philosopher\'s Stone', '2025-10-09', '2025-10-10', 'Returned', '2025-10-09 07:53:51', '2025-10-09 08:50:22', 'testadmin', 'testadmin'),
(3, 'Arveen', 'B032216473', '9234567898768', 'The Lion King', '2025-10-13', '2025-10-14', 'Issued', '2025-10-13 01:51:48', '2025-10-13 01:51:48', 'testadmin', 'testadmin');

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_receipt` date NOT NULL,
  `date_published` date NOT NULL,
  `pages` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT 'veewhaat',
  `modified_by` varchar(50) DEFAULT 'veewhaat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`id`, `type`, `name`, `date_of_receipt`, `date_published`, `pages`, `price`, `publisher`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'Academic', 'The journey of physical chemistry ', '2025-10-01', '1997-03-11', 30, 5.00, 'American Chemical Society (ACS) Publictions', '2025-10-09 06:44:49', '2025-10-09 06:45:10', 'testadmin', 'testadmin');

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE `newspapers` (
  `id` int(11) NOT NULL,
  `language` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_receipt` date NOT NULL,
  `date_published` date NOT NULL,
  `pages` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` varchar(100) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT 'veewhaat',
  `modified_by` varchar(50) DEFAULT 'veewhaat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`id`, `language`, `name`, `date_of_receipt`, `date_published`, `pages`, `price`, `type`, `publisher`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'English', 'The Sun', '2025-10-09', '2025-10-09', 10, 3.00, 'Daily News', 'News Group Newspaper Limited', '2025-10-09 06:55:44', '2025-10-09 06:55:44', 'testadmin', 'testadmin');

-- --------------------------------------------------------

--
-- Table structure for table `returned`
--

CREATE TABLE `returned` (
  `id` int(11) NOT NULL,
  `book_number` varchar(50) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date NOT NULL,
  `member` varchar(255) NOT NULL,
  `number` varchar(50) NOT NULL,
  `fine` decimal(10,2) DEFAULT 0.00,
  `status` enum('Pending','Cleared') NOT NULL DEFAULT 'Pending',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT 'veewhaat',
  `modified_by` varchar(50) DEFAULT 'veewhaat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `returned`
--

INSERT INTO `returned` (`id`, `book_number`, `book_title`, `issue_date`, `due_date`, `return_date`, `member`, `number`, `fine`, `status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, '1234567898765', 'Harry Potter and the Philosopher\'s Stone', '2025-10-09', '2025-10-10', '2025-10-11', 'Eva', 'B032210418', 10.00, 'Cleared', '2025-10-09 08:50:48', '2025-10-09 08:50:57', 'testadmin', 'testadmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `issued`
--
ALTER TABLE `issued`
  ADD PRIMARY KEY (`issued_id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned`
--
ALTER TABLE `returned`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `issued`
--
ALTER TABLE `issued`
  MODIFY `issued_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `returned`
--
ALTER TABLE `returned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
