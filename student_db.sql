-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `grade_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade_value`) VALUES
(1, 'AA'),
(2, 'AB'),
(3, 'BB'),
(4, 'BC'),
(5, 'CC'),
(6, 'CD'),
(7, 'DD'),
(8, 'FF');

-- --------------------------------------------------------

--
-- Table structure for table `login_infos`
--

CREATE TABLE `login_infos` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  `sid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_infos`
--

INSERT INTO `login_infos` (`id`, `username`, `email`, `password`, `role`, `sid`, `created_at`, `updated_at`) VALUES
(1, 'admin_123', 'admin_123@gmail.com', '$2y$10$ZAlxKgWuxf.F3kbR8fDGEeOhezo6MWoMUciTtcmAWR.LR5sRKKtPK', 'admin', 1, '2024-02-22 07:41:51', '2024-02-27 12:32:31'),
(83, 'robert', 'robert@gmail.com', '$2y$10$BWuqr6VjTQW.xgirdIRzv.t8kk/o6E/xT9F38D89YxrFSFtI5NwTm', 'student', 88, '2024-03-07 09:58:10', '2024-03-07 13:04:16'),
(97, 'mukeshlohar4500', 'mukeshlohar4500@gmail.com', '', 'student', 279, '2024-03-12 09:27:06', '2024-03-12 09:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_infos`
--

CREATE TABLE `notifications_infos` (
  `id` int(11) NOT NULL,
  `emails` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications_infos`
--

INSERT INTO `notifications_infos` (`id`, `emails`, `message`, `subject`) VALUES
(16, 'mark@gmail.com,larry@gmail.com,abc@gmail.com,mike@gmail.com,abcd@gmail.com', 'Hello this is testing.', 'this is subject'),
(24, 'robert@gmail.com', 'hikh', 'this is subject');

-- --------------------------------------------------------

--
-- Table structure for table `registration_infos`
--

CREATE TABLE `registration_infos` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `status` enum('active','deactive') DEFAULT 'deactive',
  `is_varified` enum('true','false') DEFAULT 'false',
  `is_approved` enum('true','false') DEFAULT 'false',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_infos`
--

INSERT INTO `registration_infos` (`id`, `firstname`, `lastname`, `phonenumber`, `gender`, `hobby`, `message`, `profile`, `grade`, `status`, `is_varified`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'abc', '9988776655', 'male', 'other', 'I am admin', '1.jpg', 'AA', 'active', 'true', 'true', '2024-02-22 07:39:04', '2024-03-08 07:27:21'),
(88, 'robert', 'downy', '7897897880', 'female', '', 'hi i am robert', '1709809816_bg-3.jpg', 'CC', 'active', 'true', 'true', '2024-03-07 09:58:10', '2024-03-08 07:27:56'),
(92, 'student', 'abc', '9985776655', 'male', 'other', 'I am student', '1.jpg', 'AA', 'deactive', 'true', 'true', '2024-03-08 07:07:16', '2024-03-11 13:23:19'),
(95, 'abc1', 'Lastname1', '9985776600', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:12:46', '2024-03-11 13:23:24'),
(96, 'abc2', 'Lastname2', '9985776601', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:12:46', '2024-03-08 07:27:21'),
(97, 'abc3', 'Lastname3', '9985776602', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:12:46', '2024-03-08 07:27:21'),
(98, 'abc4', 'Lastname4', '9985776603', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:12:46', '2024-03-11 13:23:34'),
(99, 'abc5', 'Lastname5', '9985776604', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:14:20', '2024-03-08 07:27:21'),
(100, 'abc6', 'Lastname6', '9985776605', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:14:20', '2024-03-11 13:23:29'),
(101, 'abc7', 'Lastname7', '9985776606', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:14:20', '2024-03-08 07:27:21'),
(102, 'abc8', 'Lastname8', '9985776607', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:14:20', '2024-03-08 07:27:21'),
(103, 'abc9', 'Lastname9', '9985776608', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:14:20', '2024-03-08 07:27:21'),
(104, 'abc10', 'Lastname10', '9985776609', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:14:20', '2024-03-11 13:23:08'),
(105, 'abc11', 'Lastname11', '9985776610', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:14:20', '2024-03-11 13:23:44'),
(106, 'abc12', 'Lastname12', '9985776611', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:14:20', '2024-03-08 07:27:21'),
(107, 'abc13', 'Lastname13', '9985776612', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:14:20', '2024-03-08 07:27:21'),
(108, 'abc14', 'Lastname14', '9985776613', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:14:20', '2024-03-11 13:23:40'),
(109, 'abc15', 'Lastname15', '9985776614', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:23:52'),
(110, 'abc16', 'Lastname16', '9985776615', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(111, 'abc17', 'Lastname17', '9985776616', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:23:48'),
(112, 'abc18', 'Lastname18', '9985776617', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(113, 'abc19', 'Lastname19', '9985776618', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(114, 'abc20', 'Lastname20', '9985776619', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:23:58'),
(115, 'abc21', 'Lastname21', '9985776620', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(116, 'abc22', 'Lastname22', '9985776621', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:24:03'),
(117, 'abc23', 'Lastname23', '9985776622', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(118, 'abc24', 'Lastname24', '9985776623', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:24:07'),
(119, 'abc25', 'Lastname25', '9985776624', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(120, 'abc26', 'Lastname26', '9985776625', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:24:12'),
(121, 'abc27', 'Lastname27', '9985776626', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(122, 'abc28', 'Lastname28', '9985776627', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(123, 'abc29', 'Lastname29', '9985776628', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(124, 'abc30', 'Lastname30', '9985776629', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(125, 'abc31', 'Lastname31', '9985776630', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:24:18'),
(126, 'abc32', 'Lastname32', '9985776631', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(127, 'abc33', 'Lastname33', '9985776632', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(128, 'abc34', 'Lastname34', '9985776633', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:15:03', '2024-03-11 13:24:23'),
(129, 'abc35', 'Lastname35', '9985776634', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:15:03', '2024-03-08 07:27:21'),
(130, 'abc36', 'Lastname36', '9985776635', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(131, 'abc37', 'Lastname37', '9985776636', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:28'),
(132, 'abc38', 'Lastname38', '9985776637', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(133, 'abc39', 'Lastname39', '9985776638', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:32'),
(134, 'abc40', 'Lastname40', '9985776639', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(135, 'abc41', 'Lastname41', '9985776640', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(136, 'abc42', 'Lastname42', '9985776641', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:37'),
(137, 'abc43', 'Lastname43', '9985776642', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(138, 'abc44', 'Lastname44', '9985776643', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(139, 'abc45', 'Lastname45', '9985776644', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:41'),
(140, 'abc46', 'Lastname46', '9985776645', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(141, 'abc47', 'Lastname47', '9985776646', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(142, 'abc48', 'Lastname48', '9985776647', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:46'),
(143, 'abc49', 'Lastname49', '9985776648', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(144, 'abc50', 'Lastname50', '9985776649', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(145, 'abc51', 'Lastname51', '9985776650', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(146, 'abc52', 'Lastname52', '9985776651', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:55'),
(147, 'abc53', 'Lastname53', '9985776652', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:16:00', '2024-03-11 13:24:52'),
(148, 'abc54', 'Lastname54', '9985776653', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(149, 'abc55', 'Lastname55', '9985776654', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:16:00', '2024-03-08 07:27:21'),
(189, 'abc57', 'Lastname57', '9985776656', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:24:59'),
(190, 'abc58', 'Lastname58', '9985776657', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:02'),
(191, 'abc59', 'Lastname59', '9985776658', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:05'),
(192, 'abc60', 'Lastname60', '9985776659', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(193, 'abc61', 'Lastname61', '9985776660', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(194, 'abc62', 'Lastname62', '9985776661', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:11'),
(195, 'abc63', 'Lastname63', '9985776662', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(196, 'abc64', 'Lastname64', '9985776663', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:14'),
(197, 'abc65', 'Lastname65', '9985776664', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(198, 'abc67', 'Lastname67', '9985776666', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(199, 'abc68', 'Lastname68', '9985776667', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:18'),
(200, 'abc69', 'Lastname69', '9985776668', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(201, 'abc70', 'Lastname70', '9985776669', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:21'),
(202, 'abc71', 'Lastname71', '9985776670', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(203, 'abc72', 'Lastname72', '9985776671', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(204, 'abc73', 'Lastname73', '9985776672', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:17:32', '2024-03-11 13:25:26'),
(205, 'abc74', 'Lastname74', '9985776673', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(206, 'abc75', 'Lastname75', '9985776674', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:17:32', '2024-03-08 07:27:21'),
(207, 'abc76', 'Lastname76', '9985776675', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:29'),
(208, 'abc77', 'Lastname77', '9985776676', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(209, 'abc78', 'Lastname78', '9985776677', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(210, 'abc79', 'Lastname79', '9985776678', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:35'),
(211, 'abc80', 'Lastname80', '9985776679', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:38'),
(212, 'abc81', 'Lastname81', '9985776680', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:41'),
(213, 'abc82', 'Lastname82', '9985776681', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(214, 'abc83', 'Lastname83', '9985776682', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(215, 'abc84', 'Lastname84', '9985776683', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(216, 'abc85', 'Lastname85', '9985776684', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(217, 'abc86', 'Lastname86', '9985776685', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:49'),
(218, 'abc87', 'Lastname87', '9985776686', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:45'),
(219, 'abc88', 'Lastname88', '9985776687', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(220, 'abc89', 'Lastname89', '9985776688', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(221, 'abc90', 'Lastname90', '9985776689', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:29:17'),
(222, 'abc91', 'Lastname91', '9985776690', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(223, 'abc92', 'Lastname92', '9985776691', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(224, 'abc93', 'Lastname93', '9985776692', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:59'),
(225, 'abc94', 'Lastname94', '9985776693', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:17:53', '2024-03-11 13:25:55'),
(226, 'abc95', 'Lastname95', '9985776694', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:17:53', '2024-03-08 07:27:21'),
(227, 'abc96', 'Lastname96', '9985776695', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(228, 'abc97', 'Lastname97', '9985776696', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-11 13:26:03'),
(229, 'abc98', 'Lastname98', '9985776697', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(230, 'abc99', 'Lastname99', '9985776698', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(231, 'abc100', 'Lastname100', '9985776699', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(232, 'abc101', 'Lastname101', '9985776700', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-11 13:29:24'),
(233, 'abc102', 'Lastname102', '9985776701', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(234, 'abc103', 'Lastname103', '9985776702', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(235, 'abc104', 'Lastname104', '9985776703', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-11 13:26:10'),
(236, 'abc105', 'Lastname105', '9985776704', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(237, 'abc106', 'Lastname106', '9985776705', 'Female', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(238, 'abc107', 'Lastname107', '9985776706', 'Male', 'Hobby2', 'I am a student', '1.jpg', 'B', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 13:01:05'),
(239, 'abc108', 'Lastname108', '9985776707', 'Female', 'Hobby3', 'I am a student', '1.jpg', 'C', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(240, 'abc109', 'Lastname109', '9985776708', 'Male', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(241, 'abc110', 'Lastname110', '9985776709', 'Female', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-11 13:26:14'),
(242, 'abc111', 'Lastname111', '9985776710', 'Male', 'Hobby1', 'I am a student', '1.jpg', 'A', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(243, 'abc112', 'Lastname112', '9985776711', 'Female', 'Hobby2', 'I am a student', '1.jpg', 'B', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(244, 'abc113', 'Lastname113', '9985776712', 'Male', 'Hobby3', 'I am a student', '1.jpg', 'C', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-11 13:26:26'),
(245, 'abc114', 'Lastname114', '9985776713', 'Female', 'Hobby4', 'I am a student', '1.jpg', 'D', 'active', 'true', 'true', '2024-03-08 07:18:36', '2024-03-08 07:27:21'),
(246, 'abc115', 'Lastname115', '9985776714', 'Male', 'Hobby5', 'I am a student', '1.jpg', 'E', 'deactive', 'true', 'true', '2024-03-08 07:18:36', '2024-03-11 13:26:19'),
(279, 'Mukesh kumar', 'Lohar', '', '', '', '', '', '', 'deactive', 'false', 'false', '2024-03-12 09:27:06', '2024-03-12 09:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `varified_emails`
--

CREATE TABLE `varified_emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `varified_emails`
--

INSERT INTO `varified_emails` (`id`, `email`, `token`, `sid`, `created_at`, `updated_at`) VALUES
(84, 'robert@gmail.com', '9d922b0227b05aaf692ac3aa', 88, '2024-03-07 09:58:10', '2024-03-07 09:58:10'),
(87, 'robert@gmail.com', 'f2ee718c1c1edff99719cab6', 88, '2024-03-07 11:37:31', '2024-03-07 11:37:31'),
(88, 'robert@gmail.com', '608bfca0afc7670fe8902a1e', 88, '2024-03-07 11:39:09', '2024-03-07 11:39:09'),
(89, 'robert@gmail.com', 'b0a75b1db6f010aa688ec8d6', 88, '2024-03-07 11:41:15', '2024-03-07 11:41:15'),
(90, 'robert@gmail.com', 'cefc16ca306b975df6a317db', 88, '2024-03-07 12:11:44', '2024-03-07 12:11:44'),
(91, 'robert@gmail.com', 'c7251a0ae5e9494fbb19da6e', 88, '2024-03-07 12:20:28', '2024-03-07 12:20:28'),
(92, 'robert@gmail.com', 'd8244e9e1f4849be0be55e88', 88, '2024-03-07 12:20:47', '2024-03-07 12:20:47'),
(93, 'robert@gmail.com', 'ba5c2293c779982e4a0c985b', 88, '2024-03-07 12:21:36', '2024-03-07 12:21:36'),
(94, 'robert@gmail.com', '495b825886c7a864dd094f2c', 88, '2024-03-07 12:25:34', '2024-03-07 12:25:34'),
(95, 'robert@gmail.com', '113e0272f84aa1ddeddb0be1', 88, '2024-03-07 12:32:18', '2024-03-07 12:32:18'),
(96, 'robert@gmail.com', '7e60bb596fd729c1ca8d9e05', 88, '2024-03-07 12:37:14', '2024-03-07 12:37:14'),
(97, 'robert@gmail.com', '7a7a3e6edc3557a6afecacd4', 88, '2024-03-07 12:54:45', '2024-03-07 12:54:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_infos`
--
ALTER TABLE `login_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `notifications_infos`
--
ALTER TABLE `notifications_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_infos`
--
ALTER TABLE `registration_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`);

--
-- Indexes for table `varified_emails`
--
ALTER TABLE `varified_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sid` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_infos`
--
ALTER TABLE `login_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `notifications_infos`
--
ALTER TABLE `notifications_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registration_infos`
--
ALTER TABLE `registration_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `varified_emails`
--
ALTER TABLE `varified_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_infos`
--
ALTER TABLE `login_infos`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `registration_infos` (`id`);

--
-- Constraints for table `varified_emails`
--
ALTER TABLE `varified_emails`
  ADD CONSTRAINT `varified_emails_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `registration_infos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
