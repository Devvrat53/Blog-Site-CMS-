-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 30, 2019 at 04:44 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Python'),
(2, 'Java'),
(3, 'PHP'),
(4, 'HTML'),
(5, 'CSS'),
(6, 'JavaScript'),
(7, 'C'),
(8, 'C++'),
(11, 'TypeScript');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 13, 'aaron', 'aaron_@gmail.com', 'Nice one mate.. Great work.', 'Unapproved', '2019-09-28'),
(9, 3, 'devvrat53', 'devvrat53@gmail.com', 'Nice work bro.', 'Approved', '2019-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) DEFAULT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(1, 2, 'Java', 'Devvrat', '2019-09-21', 'oracle-java.jpg', 'lfkfcruiruiruivit7obonouoif5dhu', 'java, oracle, oopm, oop', NULL, 'published', 3),
(3, 1, 'Python', 'Aaron', '2019-09-22', 'python_image.png', '            erbvurebervkbehevbvyrvyirbgnfirgcgfcrgiegcreffgerfer        ', 'python, interpreted, oopm, simple', NULL, 'published', 0),
(13, 3, 'Back-end language- PHP', 'Nick', '2019-09-26', 'php_image.png', '<p><strong>PHP</strong> (recursive acronym for <strong>PHP</strong>: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.</p><p><strong>PHP</strong>: Hypertext Preprocessor is a general-purpose programming language originally designed for web development. It was originally created by Rasmus Lerdorf in 1994; the PHP reference implementation is now produced by The PHP Group.</p>', 'php, web, back-end, backend, server, laravel', NULL, 'published', 0),
(14, 7, 'Getting started with C', 'Himani', '2019-09-28', 'C_pic.png', '<p><strong>C</strong> is a general-purpose, procedural computer programming language supporting <strong>structured programming, lexical variable scope, and recursion</strong>, while a static type system prevents unintended operations.</p>', 'c, C, programming_language, programming ', NULL, 'draft', 0),
(15, 8, 'Object-oriented C - C++', 'Devvrat', '2019-09-28', 'C++_pic.png', '<p><strong>C++</strong> is a general-purpose programming language created by Bjarne Stroustrup as an <strong>extension </strong>of the C programming language, or \"<strong>C with Classes\".</strong></p>', 'c++, C++, oopm, oop, class', NULL, 'draft', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` text NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(1, 'devvrat53', '$2y$12$DSR1Ot0RYe6/AGOpQvjvzuS1LImA8O9i9l54AI5OTzolCafvifek2', 'Devvrat', 'Mungekar', 'devvratmungekar53@gmail.com', 'image', 'admin', '$2y$10$iusesomecrazystrings22'),
(2, 'aaron', '$2y$10$iusesomecrazystrings2urndIQVfRd8F8CfQcyp7xRGyv0V7mQGm', 'Aaron', 'Finch', 'aaron@gmail.com', 'image', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(3, 'himani11', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Himani', 'Joshi', 'himani11@gmail.com', NULL, 'admin', '$2y$10$iusesomecrazystrings22'),
(5, 'michael11', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Michael', 'Denis', 'michael11@gmail.com', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22'),
(11, 'nick12', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'Nick', 'Hen', 'nick12@outlook.com', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22'),
(12, 'Raj101', '$2y$12$1cv/cdgRuIAJK2xfEJLrVuK/k3aP.wBkGlVA4s0lTIm3mkQuwkrbK', 'Raj', 'Raval', 'raj101@outlook.com', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22'),
(13, 'Aditya28', '$2y$12$G1wepHMgsDjCvtdCyBDnNu2utrRMFn6KEY2QN1dUyBSOFaLgYzl.K', 'Aditya', 'Jadhav', 'aditya28@gmail.com', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(4, 'd3b99bfc9b5b90b052942e3f8296445f', 1569425435),
(5, '9d1776cf5b3dfc7283313aacdcfd139b', 1569424705),
(6, '2c46bebd6d94951fa7c223e610a54153', 1569432569),
(7, 'b488e3ff4894061e1716c883b4f2e0af', 1569432461),
(8, 'b6070b5c7525299226ad9a5223a466ce', 1569461404),
(9, 'bbb98b63e03b4b752e749d506b5ef5a5', 1569512653),
(10, '93e7780984a15dfefd120846057eb411', 1569638046),
(11, '02aad8f108fa73949c6aeb2654c21704', 1569653543),
(12, '4b50a0013540511895f2e8ca57977825', 1569693761);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_post_id` (`comment_post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_category_id` (`post_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_category_id`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
