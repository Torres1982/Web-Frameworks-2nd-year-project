-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2016 at 08:23 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `researchers`
--

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `username`, `password`, `role`) VALUES
(13, 'Artur', '$2y$10$ejK3rlRaa39UpXcLkC84GujIUPfNLXQ5GtqC7HHGa1A0QZ5rVhfDe', 'admin'),
(15, 'John', '$2y$10$aMOqkU83JBlDLgjrVZDZvuGrifBpwiUux5JZO3MVtmdo4qGhTdSYS', 'student'),
(16, 'Mary', '$2y$10$5APY0LNe4YHUeWrpFft4/OA3WVFYYuoFUO8WxDl3escRNE1AC5x4W', 'member'),
(18, 'Maria', '$2y$10$SPS63bQ/7n3TWGpbM91t5.O1q/kzooE6NSkYZHISyiBAjYwbzDj22', 'member'),
(20, 'Josh', '$2y$10$sisLSMSTZK6Xp4B7ZMV3sOV.ttx.mQ7C3LNfpKv0Gr0yAZvKHOLc2', 'member'),
(21, 'Giselle', '$2y$10$bhVev08ImvYn6HBSLMhd3O1kkERRwNk7oVux9T2lOHacJFZW7Clmu', 'member'),
(22, 'Aoife', '$2y$10$t.8JXYQdQtVdEx28VUB1xenG4a/1yWIYUcCfl2eXmn/w2CT466wHC', 'member'),
(23, 'Brian', '$2y$10$ZTBmNhgRULHwgxAK6HAWtO09kF6hDVDkBveIK6nywndm2oLRJUnQa', 'student'),
(24, 'Aoife', '$2y$10$km8MgWPhUmGvbHsua2Uu7.isLWMC6tYLlIi9nMfWR2yd1ZFMRNh6C', 'student'),
(25, 'Anna', '$2y$10$frA1bZlsZ5wfMApLfxtn3OsOxI3VVqDVg7iV8GyMAk5Otc3zhuVFG', 'student'),
(26, 'Mary', '$2y$10$WJOXmZLB5G.qeQ7ItAShxuCX4yvzGSnkBNtEygfG46i1QDrYYRPRW', 'student'),
(27, 'Barry', '$2y$10$Fp15ClM21AaMz8uZGQy7Q.yhX684rWj9SqopxCAgnopqTLB9B66U2', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `memberName` varchar(30) NOT NULL,
  `memberSurname` varchar(30) NOT NULL,
  `projectId` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `memberStatus` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `memberName`, `memberSurname`, `projectId`, `email`, `memberStatus`) VALUES
(1, 'Mary', 'Stew', 0, 'marystew@gmail.com', 'past'),
(2, 'Maria', 'Kinlay', 6, 'kinlay@gmail.com', 'current'),
(3, 'Josh', 'Kirk', 7, 'joshkirk@gmail.com', 'current'),
(4, 'Giselle', 'OBrian', 10, 'giselleobrien@gmail.com', 'current'),
(5, 'Aoife', 'Mercy', 0, 'aoifemercy@gmail.com', 'past');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `projectName` varchar(30) NOT NULL,
  `projectTitle` varchar(45) NOT NULL,
  `projectSupervisor` int(11) DEFAULT NULL,
  `projectStatus` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectName`, `projectTitle`, `projectSupervisor`, `projectStatus`) VALUES
(1, 'Graphics', '3D Innovation', 5, 'past'),
(2, 'Gaming', 'Unity Engine Development', 2, 'current'),
(3, 'Gaming', '2D Unity Games', 1, 'current'),
(4, 'Graphics', 'Graphic Design Approaches', 3, 'past'),
(5, 'Gaming', 'Implications of Gaming Activities', 1, 'past'),
(6, 'Graphics', 'Graphics in Modern World', 2, 'current'),
(7, 'Graphics', 'Motion Graphics', 3, 'current'),
(8, 'Graphics', 'Asteroids 3D', 4, 'current'),
(9, 'Graphics', 'Pixel Art Algorithm', 5, 'past');

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `authorId` int(9) NOT NULL,
  `url` varchar(30) NOT NULL,
  `datePublished` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `title`, `authorId`, `url`, `datePublished`) VALUES
(1, 'Graphics - 3D Innovations', 4, 'graphics_3d_innovations.pdf', '2016-04-08'),
(3, 'Graphics Layout', 5, 'graphics_layouts.pdf', '2016-04-10'),
(4, 'Unity Engine Development', 2, 'unity_engine_development.pdf', '2016-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studentName` varchar(30) NOT NULL,
  `studentSurname` varchar(30) NOT NULL,
  `projectId` int(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `memberId` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentName`, `studentSurname`, `projectId`, `email`, `memberId`) VALUES
(2, 'Brian', 'Murphy', 2, 'stevenmurphy@gmail.com', 3),
(3, 'Aoife', 'McCarthy', 4, 'aoifemccarthy@gmail.com', 1),
(4, 'Anna', 'Stew', 8, 'annastew@gmail.com', 5),
(5, 'Mary', 'Brown', 6, 'marybrown@gmail.com', 2),
(8, 'Barry', 'Manning', 2, 'manning@gmail.com', 4),
(9, 'John', 'Clark', 7, 'clark@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
