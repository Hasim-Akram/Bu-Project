-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 09:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_courses`
--

CREATE TABLE `assign_courses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assign_courses`
--

INSERT INTO `assign_courses` (`id`, `teacher_id`, `course_id`, `department_id`, `batch_id`, `semester`) VALUES
(25, 2, 3, 5, 3, 2),
(26, 3, 3, 5, 7, 1),
(27, 3, 4, 5, 7, 1),
(28, 3, 5, 5, 7, 2),
(29, 3, 2, 5, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `batchs`
--

CREATE TABLE `batchs` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `current_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batchs`
--

INSERT INTO `batchs` (`id`, `department_id`, `name`, `current_semester`) VALUES
(3, 5, '20-A', 2),
(6, 4, '45-A', 3),
(7, 5, '20-B', 3),
(8, 4, '20TH', 2),
(9, 4, '45-J', 0),
(10, 5, '21-F', 1),
(11, 5, '434', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_code` varchar(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `course_code`, `name`, `credit`) VALUES
(1, 4, 'bba203', 'managnent', 3),
(2, 5, 'CSE 221', 'Data Structure', 3),
(3, 5, 'CSE 201', 'Programming in C', 3),
(4, 5, 'CSE 203', 'Basic Networking', 2),
(5, 5, 'CSE 311', 'E Commerce', 1),
(6, 5, 'CSE 304', 'Object Oriented Programming', 3);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(4, 'BBA'),
(5, 'Computer Science & Engineering'),
(6, 'Pharmacy');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `is_current` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `roll` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll`, `department_id`, `batch_id`) VALUES
(1, 'azad', '234234', 5, 3),
(3, 'Alauddin', '123123', 4, 6),
(5, 'rony', '2535', 5, 3),
(6, 'rahim', '3456', 5, 3),
(7, '7', '898998', 5, 0),
(8, '7', '88888', 5, 0),
(9, 'hgghghghghg', '787878', 5, 7),
(10, 'Abdur Rahim', '980988', 5, 7),
(11, 'hjhjhfvgjfghdff', '878798', 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

CREATE TABLE `student_marks` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `mid_mark` int(11) NOT NULL,
  `final_mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_marks`
--

INSERT INTO `student_marks` (`id`, `student_id`, `department_id`, `batch_id`, `semester`, `course_id`, `mid_mark`, `final_mark`) VALUES
(1, 3, 4, 6, 1, 1, 16, 23),
(2, 1, 5, 3, 1, 3, 25, 36),
(3, 5, 5, 3, 1, 3, 12, 42),
(4, 1, 5, 3, 2, 2, 34, 60),
(5, 5, 5, 3, 2, 2, 34, 80),
(6, 9, 5, 7, 1, 4, 18, 10),
(7, 9, 5, 7, 1, 5, 23, 50),
(8, 10, 5, 7, 1, 5, 34, 45),
(9, 11, 5, 7, 1, 5, 28, 50),
(10, 10, 5, 7, 1, 4, 40, 60),
(11, 11, 5, 7, 1, 4, 25, 56),
(12, 9, 5, 7, 2, 3, 25, 40),
(13, 10, 5, 7, 2, 3, 27, 40),
(14, 11, 5, 7, 2, 3, 28, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `IsActive` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`id`, `full_name`, `user_name`, `mobile`, `address`, `password`, `role`, `IsActive`) VALUES
(1, 'Innitum Nayem', 'nayem', '01744807624', 'Dhaka', 'f3269242495861c5d657306aa3856daf1c74458d', '1', 1),
(2, 'Shawon', 'shawon', '01745682', 'dhaka', '7b90e58c1ba133fd9e4515dfa57eb50e5d386758', '2', 1),
(3, 'Shawon Nayem', '201411038028', '012596874', 'rangpur', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(4, 'azad', '234234', '01723012317', '', '123456', '3', 1),
(5, 'Alauddin', '123123', '0174432322', 'dhaka', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(6, 'robiul islam', '23562356', '0174432322', 'dhaka', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 0),
(7, 'jknhjljknhlj', '098i09', '8768687967', 'dhaka', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 0),
(8, 'azad', 'azad7749@gmail.com', '45435435345', 'dhaka', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2', 0),
(9, 'Innitum Nayem', 'innitum24@gmail.com', '45435435345', 'dhaka', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2', 1),
(10, 'rony', '2535', '02145879', 'dhaka', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(11, 'azam', 'azam@gmail', '0124587', 'dhaka', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2', 1),
(12, 'rahim', '3456', '456465465767567', 'fdfg fdgdg fg ', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(13, '7', '898998', '76767879890809', 'kjhkjhkljlkj', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(14, '7', '88888', '909090900000909', 'lklklklklklk', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(15, 'hgghghghghg', '787878', '879898980890909', 'bnbvncn', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(16, 'Abdur Rahim', '980988', '098989867656', 'hbkjjkljk', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(17, 'hjhjhfvgjfghdff', '878798', '98776564323232', 'kjhdfxytjhulk', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3', 1),
(18, 'Administration', 'admin', '0199 99 99 99', 'Dhaka', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `department_id`) VALUES
(2, 'Innitum Nayem', 'innitum24@gmail.com', 5),
(3, 'azam', 'azam@gmail', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_courses`
--
ALTER TABLE `assign_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batchs`
--
ALTER TABLE `batchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `student_marks`
--
ALTER TABLE `student_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`user_name`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_courses`
--
ALTER TABLE `assign_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `batchs`
--
ALTER TABLE `batchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `student_marks`
--
ALTER TABLE `student_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
