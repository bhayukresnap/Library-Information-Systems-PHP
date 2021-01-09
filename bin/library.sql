-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 07:01 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_description` text NOT NULL,
  `price_before` int(11) NOT NULL,
  `price_after` int(11) DEFAULT NULL,
  `rack_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `book_year` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `book_type_id` int(11) NOT NULL,
  `book_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `book_description`, `price_before`, `price_after`, `rack_id`, `quantity`, `book_year`, `publisher_id`, `book_type_id`, `book_image`) VALUES
(1, 'Harry Potter: Ambition: A Guided Journal for Embracing Your Inner Slytherin', '<h2><strong>Harry Potter: Ambition: A Guided Journal for Embracing Your Inner Slytherin</strong></h2>', 650000, 459999, 4, 500, 2024, 16, 3, '/images/harry_potter__ambition__a_guided_journal_for_embracing_your_inner_slytherin.jpg'),
(2, 'Monster hunter', '<p>Monster hunter</p>', 1250000, 0, 4, 51, 2020, 14, 5, '/images/monster_hunter.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books_tags`
--

CREATE TABLE `books_tags` (
  `book_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_tags`
--

INSERT INTO `books_tags` (`book_id`, `tag_id`) VALUES
(2, 30),
(2, 15),
(2, 16),
(2, 31),
(1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update_by` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `last_update_by`, `status`) VALUES
('ID147003014', 2, '2021-01-09 01:43:02', '2021-01-08 18:50:49', 2),
('ID271932253', 2, '2021-01-09 01:12:48', '2021-01-08 18:35:57', 4),
('ID335284392', 2, '2021-01-09 01:44:19', '2021-01-09 17:07:51', 3),
('ID343244324', 5, '2021-01-09 01:11:06', '2021-01-08 18:28:45', 4),
('ID414298438', 2, '2021-01-09 01:11:36', '2021-01-08 18:48:08', 4),
('ID569252247', 2, '2021-01-09 01:11:08', '2021-01-08 18:22:53', 4),
('ID775744327', 2, '2021-01-09 01:12:10', '2021-01-08 18:22:54', 4),
('ID896543550', 2, '2021-01-07 17:22:58', '2021-01-08 18:22:55', 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` varchar(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `book_id`) VALUES
('ID569252247', 2),
('ID569252247', 1),
('ID414298438', 1),
('ID414298438', 2),
('ID343244324', 1),
('ID896543550', 2),
('ID775744327', 1),
('ID271932253', 2),
('ID147003014', 2),
('ID335284392', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `publisher_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `publisher_name`) VALUES
(17, 'Bonnier Books'),
(10, 'Cengage Learning'),
(18, 'Editis'),
(20, 'Egmont Books'),
(16, 'Grupo Santillana'),
(2, 'Hachette Livre'),
(3, 'HarperCollins'),
(7, 'Houghton Mifflin Harcourt'),
(19, 'Klett'),
(14, 'Kodansha'),
(4, 'Macmillan Publishers'),
(6, 'McGraw-Hill Education'),
(13, 'Oxford University Press'),
(8, 'Pearson Education'),
(1, 'Penguin Random House'),
(9, 'Scholastic'),
(15, 'Shueisha'),
(5, 'Simon & Schuster'),
(11, 'Springer Nature'),
(12, 'Wiley (John Wiley & Sons)');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `rack_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `rack_name`) VALUES
(3, 'Horror - 1'),
(4, 'Horror - 2'),
(5, 'Horror - 3');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`) VALUES
(41, 5),
(47, 1),
(48, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_details`
--

CREATE TABLE `shopping_cart_details` (
  `shopping_cart_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart_details`
--

INSERT INTO `shopping_cart_details` (`shopping_cart_id`, `book_id`) VALUES
(48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`) VALUES
(14, 'Action and Adventure'),
(30, 'Biographies and Autobiographies'),
(15, 'Classics'),
(16, 'Comic Book or Graphic Novel'),
(31, 'Cookbooks'),
(18, 'Detective and Mystery'),
(32, 'Essays'),
(19, 'Fantasy'),
(20, 'Historical Fiction'),
(33, 'History'),
(21, 'Horror'),
(23, 'Literary Fiction'),
(34, 'Memoir'),
(35, 'Poetry'),
(25, 'Romance'),
(26, 'Science Fiction (Sci-Fi)'),
(36, 'Self-Help'),
(27, 'Short Stories'),
(28, 'Suspense and Thrillers'),
(37, 'True Crime'),
(29, 'Women\'s Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `book_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `book_type`) VALUES
(4, '1 issue'),
(5, '12 issues'),
(3, 'Hardcover'),
(2, 'Paperback');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', '', 2),
(2, 'test', 'test', '', 0),
(4, 'owner', 'owner', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_name` (`book_name`);

--
-- Indexes for table `books_tags`
--
ALTER TABLE `books_tags`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publisher` (`publisher_name`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rack_name` (`rack_name`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart_details`
--
ALTER TABLE `shopping_cart_details`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `shopping_cart_id` (`shopping_cart_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_type` (`book_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books_tags`
--
ALTER TABLE `books_tags`
  ADD CONSTRAINT `books_tags_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart_details`
--
ALTER TABLE `shopping_cart_details`
  ADD CONSTRAINT `shopping_cart_details_ibfk_1` FOREIGN KEY (`shopping_cart_id`) REFERENCES `shopping_cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
