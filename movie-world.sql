-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 12:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie-world`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `publication_date` date NOT NULL,
  `image_filename` varchar(255) NOT NULL,
  `total_likes` int(11) NOT NULL,
  `total_dislikes` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `publication_date`, `image_filename`, `total_likes`, `total_dislikes`, `user_id`) VALUES
(11, 'The Matrix', 'When a beautiful stranger leads computer hacker Neo to a forbidding underworld, he discovers the shocking truth--the life he knows is the elaborate deception of an evil cyber-intelligence.', '2023-02-09', 'matrix-code.webp', 2, 0, 11),
(12, 'Pan\'s Labyrinth', 'In the Falangist Spain of 1944, the bookish young stepdaughter of a sadistic army officer escapes into an eerie but captivating fantasy world.', '2023-02-09', 'panslabyrinth.jpg', 1, 1, 11),
(13, 'Wild Hunt', 'A medieval reenactment game turns into a Shakespearean tragedy when a non-player crashes the event to win back his girlfriend.', '2023-02-09', 'wildhunt.jpg', 2, 0, 11),
(14, 'Hook', 'When Captain James Hook kidnaps his children, an adult Peter Pan must return to Neverland and reclaim his youthful spirit in order to challenge his old enemy.', '2023-02-09', 'hook.jpg', 2, 0, 12),
(15, 'Seven', 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.', '2023-02-09', 'seven.jpg', 1, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(11, 'goz2040', 'goz2040@hotmail.com', '1234'),
(12, 'kostaslakkas', 'const.lakk@gmail.com', '1234'),
(13, 'john', 'johnsmith@email.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE `user_likes` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `is_dislike` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_likes`
--

INSERT INTO `user_likes` (`user_id`, `movie_id`, `is_dislike`) VALUES
(11, 14, 0),
(11, 15, 0),
(12, 11, 0),
(12, 12, 0),
(12, 13, 0),
(13, 11, 0),
(13, 12, 1),
(13, 13, 0),
(13, 14, 0),
(13, 15, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_FK` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`user_id`,`movie_id`),
  ADD KEY `likes_movie_FK` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `likes_movie_FK` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `likes_user_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
