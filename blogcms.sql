-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2020 at 04:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(5, 'February-10-2020 17:18:13', 'Post 2', 'Technology', 'Bibek Ghimire', 'index2.jpg', 'Second Post ...'),
(7, 'February-10-2020 19:37:03', 'Very long title here abababababababbabababab', 'CMS', 'Bibek Ghimire', 'index.jpg', 'With Bootstrap, a navigation bar can extend or collapse, depending on the screen size. A standard navigation bar is created with the .navbar class, followed by a responsive collapsing class: .navbar-expand-xl|lg|md|sm (stacks the navbar vertically on extra large, large, medium or small screens).<br>\r\nWith Bootstrap, a navigation bar can extend or collapse, depending on the screen size. A standard navigation bar is created with the .navbar class, followed by a responsive collapsing class: .navbar-expand-xl|lg|md|sm (stacks the navbar vertically on extra large, large, medium or small screens).<br>\r\nWith Bootstrap, a navigation bar can extend or collapse, depending on the screen size. A standard navigation bar is created with the .navbar class, followed by a responsive collapsing class: .navbar-expand-xl|lg|md|sm (stacks the navbar vertically on extra large, large, medium or small screens).<br>\r\nWith Bootstrap, a navigation bar can extend or collapse, depending on the screen size. A standard navigation bar is created with the .navbar class, followed by a responsive collapsing class: .navbar-expand-xl|lg|md|sm (stacks the navbar vertically on extra large, large, medium or small screens).<br>\r\nWith Bootstrap, a navigation bar can extend or collapse, depending on the screen size. A standard navigation bar is created with the .navbar class, followed by a responsive collapsing class: .navbar-expand-xl|lg|md|sm (stacks the navbar vertically on extra large, large, medium or small screens).'),
(8, 'February-11-2020 08:44:43', 'Post 2', 'Python', 'Bibek Ghimire', 'index.jpg', '					Added Image...\r\n										'),
(9, 'February-11-2020 08:42:24', 'Post 2 Updated Again', 'Technology', 'Bibek Ghimire', 'index2.jpg', '																Second Post Updated Again ...		\r\nLast night I worked on this script on my mac os x and everything was working beautifully. This morning I came to work to test the same script on a windows machine - apache 2.2.8, php 5.2.6, mysql 5.0.51b - and now I get this warning: \r\nLast night I worked on this script on my mac os x and everything was working beautifully. This morning I came to work to test the same script on a windows machine - apache 2.2.8, php 5.2.6, mysql 5.0.51b - and now I get this warning: \r\n\r\nLast night I worked on this script on my mac os x and everything was working beautifully. This morning I came to work to test the same script on a windows machine - apache 2.2.8, php 5.2.6, mysql 5.0.51b - and now I get this warning: \r\n\r\nLast night I worked on this script on my mac os x and everything was working beautifully. This morning I came to work to test the same script on a windows machine - apache 2.2.8, php 5.2.6, mysql 5.0.51b - and now I get this warning: 												'),
(10, 'February-12-2020 14:01:24', 'Author added', 'PHP', 'Helios', '84513529_3166998609981814_2745588467084820480_n.jpg', 'Author added using SESSION variable.'),
(11, 'February-12-2020 14:28:34', 'Python', 'Python', 'Helios', 'python.jpg', 'Python\r\n'),
(12, 'February-12-2020 14:29:06', 'Programming', 'Technology', 'Helios', 'index3.jpg', 'Prog\r\n'),
(13, 'February-12-2020 14:29:33', 'New Post', 'C/C++', 'Helios', 'index4.png', 'adsfbgn'),
(14, 'February-12-2020 14:29:48', 'ghkjkl', 'C/C++', 'Helios', 'index5.jpg', 'vhbjlkl;'),
(15, 'February-12-2020 14:31:11', 'javascript', 'Technology', 'Helios', 'javascript.png', 'gvjhbkjlk;l,sdafsd'),
(16, 'February-12-2020 14:31:28', 'JS', 'Technology', 'Helios', 'js.png', 'JS');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `datetime`, `name`, `creatorname`) VALUES
(1, 'February-09-2020 17:59:32', 'Technology', 'Bibek Ghimire'),
(2, 'February-09-2020 18:01:35', 'CMS', 'Bibek Ghimire'),
(4, 'February-09-2020 18:18:12', 'Python', 'Bibek Ghimire'),
(5, 'February-12-2020 09:08:37', 'PHP', 'Bibek Ghimire'),
(6, 'February-12-2020 14:05:50', 'C/C++', 'Helios');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(200) NOT NULL,
  `status` varchar(5) NOT NULL,
  `admin_panel_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `admin_panel_id`) VALUES
(3, 'February-11-2020 16:09:07', 'Bibek Ghimire', 'bibek.ghimire83@gmail.com', 'Test Comment...', 'Pending', 'ON', 8),
(6, 'February-11-2020 17:44:06', 'New', 'n@edu.com', 'New Comment You can use any modern web browser, such as Safari, Chrome, or Edge, to find your location in Google Maps. ', 'Dis-Approved', 'OFF', 8),
(7, 'February-12-2020 08:48:03', 'New', 'h@example.com', 'New Comment', 'Pending', 'OFF', 7),
(8, 'February-12-2020 08:48:28', 'helios', 'helios@gmail.com', 'Helios Commenting here...', 'Helios', 'ON', 7),
(9, 'February-12-2020 09:02:12', 'New', 'n@edu.com', 'New Comment', 'Pending', 'OFF', 9),
(10, 'February-13-2020 08:56:43', 'hello', 'h@example.com', 'This is comment...', 'Helios', 'ON', 13);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addedby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `datetime`, `username`, `password`, `addedby`) VALUES
(1, 'February-12-2020 09:29:55', 'Helios', '19319', 'Bibek Ghimire');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_panel_id` (`admin_panel_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign Key to admin_panel table` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
