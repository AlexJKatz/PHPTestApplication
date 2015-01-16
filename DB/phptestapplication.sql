-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2015 at 05:01 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phptestapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE IF NOT EXISTS `hotels` (
`int_hotel_id` int(11) NOT NULL,
  `var_hotel_name` varchar(150) NOT NULL,
  `var_city` varchar(150) NOT NULL,
  `var_img_src` varchar(150) NOT NULL,
  `var_desc` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`int_hotel_id`, `var_hotel_name`, `var_city`, `var_img_src`, `var_desc`) VALUES
(1, 'The Grand', 'Cape Town', '1.jpg', 'A very fancy hotel in the cape town area!'),
(2, 'The Monte Carlo', 'Durban', '2.jpg', 'A luxurious getaway resort'),
(3, 'The Majestic House', 'PE', '3.jpg', 'Live like a king within PE''s greatest house.'),
(4, 'Pool Yard', 'Cape Town', '4.jpg', 'Feel the sun on your skin and bathe in the refreshing pool yard.');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `int_user_id` int(11) NOT NULL,
  `dte_date_arrive` date NOT NULL,
  `dte_date_out` date NOT NULL,
  `int_hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`int_user_id`, `dte_date_arrive`, `dte_date_out`, `int_hotel_id`) VALUES
(1, '2015-01-29', '2015-01-31', 1),
(36, '2015-01-14', '2015-01-27', 1),
(39, '2015-01-01', '2015-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`int_user_id` int(11) NOT NULL,
  `var_name` varchar(50) NOT NULL,
  `var_surname` varchar(50) NOT NULL,
  `var_email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`int_user_id`, `var_name`, `var_surname`, `var_email`) VALUES
(1, 'Alex', 'Katz', 'alexjoekatz@gmail.com'),
(22, 'Alex', 'Katz', 'a@a.com'),
(23, 'Alex', 'Katz', 'a@a.com'),
(24, 'Alex', 'Katz', 'a@a.com'),
(25, 'Alex', 'Katz', 'a@a.com'),
(26, 'Alex', 'Katz', 'a@a.com'),
(27, 'Alex', 'Katz', 'a@a.com'),
(28, 'Alex', 'Katz', 'a@a.com'),
(29, 'Alex', 'Katz', 'a@a.com'),
(30, 'Alex', 'Katz', 'a@a.com'),
(31, 'Alex', 'Katz', 'a@a.com'),
(32, 'Alex', 'Katz', 'a@a.com'),
(33, 'Alex', 'Katz', 'a@a.com'),
(34, 'Alex', 'Katz', 'a@a.com'),
(35, 'Alex', 'Katz', 'a@b.com'),
(36, 'Alex', 'Katz', 'a@c.vom'),
(37, 'Alex', 'Katz', 'a@a.com'),
(38, 'Alex', 'Katz', 'a@b.com'),
(39, 'Alex', 'Katz', 'a@c.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
 ADD PRIMARY KEY (`int_hotel_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
 ADD UNIQUE KEY `int_user_id` (`int_user_id`,`int_hotel_id`), ADD KEY `int_hotel_id` (`int_hotel_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`int_user_id`), ADD UNIQUE KEY `int_user_id` (`int_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
MODIFY `int_hotel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `int_user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`int_user_id`) REFERENCES `users` (`int_user_id`),
ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`int_hotel_id`) REFERENCES `hotels` (`int_hotel_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
