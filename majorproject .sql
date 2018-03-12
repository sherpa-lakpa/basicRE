-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2018 at 08:39 पूर्वाह्न
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `majorproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`) VALUES
(1, 'Programming language theory'),
(2, 'Systems programming'),
(3, 'Software engineering'),
(4, 'Databases'),
(5, 'Formal methods'),
(6, 'Algorithms'),
(7, 'Computation'),
(8, 'Concurrency'),
(9, 'Artificial intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `book_id`, `rating`) VALUES
(1, 3, 1, 3.45),
(2, 3, 2, 5),
(3, 3, 3, 4.83),
(4, 4, 1, 4.58),
(5, 4, 2, 4.43),
(6, 4, 4, 2.8),
(7, 4, 3, 4.38),
(8, 4, 5, 2.42),
(9, 5, 1, 4.33),
(10, 5, 2, 3.57),
(11, 5, 6, 5),
(12, 5, 7, 4.39),
(13, 6, 5, 1.53),
(14, 6, 2, 4.6),
(15, 6, 8, 4.28),
(16, 6, 3, 3.54),
(17, 6, 4, 5),
(18, 7, 8, 2.92),
(19, 7, 5, 5),
(20, 7, 2, 2.17),
(21, 7, 6, 5),
(22, 7, 7, 3.18),
(23, 7, 1, 4.24),
(25, 8, 1, 5),
(26, 8, 2, 1.66),
(27, 8, 8, 4.62),
(28, 8, 5, 3.94),
(29, 9, 3, 3.62),
(30, 9, 5, 4.72),
(31, 9, 2, 4.38),
(32, 9, 6, 4.38),
(33, 9, 1, 4.64),
(34, 10, 2, 4.67),
(35, 10, 8, 4.14),
(36, 10, 3, 3.86),
(37, 10, 4, 5),
(38, 11, 2, 2.54),
(39, 11, 6, 2.76),
(40, 11, 7, 4.32),
(41, 11, 9, 5),
(75, 12, 3, 4.04),
(76, 12, 5, 5),
(77, 12, 2, 4.52),
(78, 12, 6, 4.92),
(79, 12, 8, 3.97),
(80, 12, 1, 4.34),
(81, 13, 2, 5),
(82, 13, 3, 3.34),
(83, 13, 9, 1.46),
(84, 14, 4, 2.32),
(85, 15, 8, 3.61),
(86, 15, 5, 3.58),
(87, 15, 2, 3.25),
(88, 15, 6, 3.03),
(89, 15, 7, 3.23),
(90, 15, 1, 4.72),
(91, 15, 9, 5),
(92, 1, 3, 3.76),
(93, 1, 5, 4.93),
(94, 1, 2, 2.76),
(95, 1, 6, 4.63),
(96, 1, 8, 5),
(97, 1, 1, 1.5),
(98, 2, 1, 4.23),
(99, 2, 2, 4.22),
(100, 2, 6, 3.95),
(101, 2, 3, 4.74),
(102, 2, 5, 3.83);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`) VALUES
(1, 'Leslie Lamport'),
(2, 'Niklaus Wirth'),
(3, 'Dennis Ritchie'),
(4, 'John Backus'),
(5, 'Donald Knuth'),
(6, 'Edgar Codd'),
(7, 'Robert Floyd'),
(8, 'Robin Milner'),
(9, 'Tony Hoare'),
(10, 'Michael Stonebraker'),
(11, 'Marvin Minsky'),
(12, 'Edsger Dijkstra'),
(13, 'Alan Perlis'),
(14, 'John McCarthy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
