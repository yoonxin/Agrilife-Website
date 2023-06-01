-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2023 at 04:42 PM
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
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `parent_comment_id` varchar(50) NOT NULL,
  `comment_content` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comment_sender_name` varchar(50) NOT NULL,
  `comment_sender_email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `parent_comment_id` (`parent_comment_id`),
  KEY `comment_sender_name` (`comment_sender_name`),
  KEY `comment_sender_email` (`comment_sender_email`(250)),
  KEY `comment_sender_email_2` (`comment_sender_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `parent_comment_id`, `comment_content`, `comment_sender_name`, `comment_sender_email`, `date`) VALUES
(1, 'POST000002', 'comment', 'test1', 'test1@gmail.com', '2023-04-16 08:01:05'),
(2, 'POST000001', 'post 1', 'test1', 'test1@gmail.com', '2023-04-16 08:01:10'),
(3, 'POST000002', 'comment', 'test1', 'test1@gmail.com', '2023-04-16 08:01:15'),
(4, 'POST000002', 'comment', 'test1', 'test1@gmail.com', '2023-04-16 08:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

DROP TABLE IF EXISTS `favourite`;
CREATE TABLE IF NOT EXISTS `favourite` (
  `favourite_id` int NOT NULL AUTO_INCREMENT,
  `parent_post_id` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favourite_id`),
  KEY `parent_post_id` (`parent_post_id`),
  KEY `user_email` (`user_email`(250)),
  KEY `user_email_2` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`favourite_id`, `parent_post_id`, `user_email`, `date`) VALUES
(1, 'POST000002', 'test1@gmail.com', '2023-04-16 08:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `news_title` varchar(100) NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_content` varchar(1200) NOT NULL,
  `news_images` varchar(1200) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_date`, `news_content`, `news_images`) VALUES
(1, 'AgriLife Launched!!!', '2023-04-16 16:03:07', 'yepi', 'uploads/love.png');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_profile` varchar(500) NOT NULL,
  `post` text NOT NULL,
  `images` varchar(500) NOT NULL,
  `post_date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id_2` (`post_id`),
  KEY `post_id` (`post_id`),
  KEY `user_name` (`user_name`),
  KEY `user_email` (`user_email`(250)),
  KEY `user_profile` (`user_profile`(250)),
  KEY `user_profile_2` (`user_profile`),
  KEY `user_email_2` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_id`, `user_name`, `user_email`, `user_profile`, `post`, `images`, `post_date`) VALUES
(1, 'POST000001', 'test1', 'test1@gmail.com', 'images/test4.png', 'post 1', 'uploads/test4.png', '2023-04-16 03:57:04'),
(2, 'POST000002', 'test1', 'test1@gmail.com', 'images/test4.png', 'post 2', 'uploads/test2.jpg', '2023-04-16 03:57:14'),
(3, 'POST000003', 'test1', 'test1@gmail.com', 'images/test4.png', 'post 3', 'uploads/test3.jpg', '2023-04-16 03:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_rpassword` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'user',
  `user_pic` varchar(500) NOT NULL DEFAULT 'images/test4.png',
  `user_background` varchar(1200) NOT NULL DEFAULT 'images/background.jpg',
  `user_about` varchar(150) NOT NULL,
  `user_join` date NOT NULL,
  `user_contact_num` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`, `user_rpassword`, `user_type`, `user_pic`, `user_background`, `user_about`, `user_join`, `user_contact_num`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 'admin123', 'admin', 'images/test4.png', 'images/background.jpg', '', '2023-04-16', 0),
(9, 'test1', 'test1@gmail.com', '123', '123', 'user', 'images/test4.png', 'images/background.jpg', '', '2023-04-16', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comment_sender_email`) REFERENCES `users` (`user_email`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`parent_comment_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`user_email`),
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`parent_post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`user_email`) REFERENCES `users` (`user_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
