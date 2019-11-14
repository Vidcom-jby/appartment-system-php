-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2018 at 04:55 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appartment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_reg_table`
--

CREATE TABLE `course_reg_table` (
  `id` varchar(512) NOT NULL,
  `department` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `matric_number` varchar(128) NOT NULL,
  `user_id` varchar(512) NOT NULL,
  `registered_courses` varchar(1028) NOT NULL,
  `created` varchar(128) NOT NULL,
  `updated` varchar(128) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_reg_table`
--

INSERT INTO `course_reg_table` (`id`, `department`, `level`, `matric_number`, `user_id`, `registered_courses`, `created`, `updated`, `amount`) VALUES
('c2306569c37cdeb7f2d8711aa61a899dd545cfb1', 'Computer Science', '400', 'TEST', '14f222a6670fe9613813b05ede768c81e4f35ea0', 'CIT411: Microcomputers And Microprocessors: 3; CIT432: Software Engineering Ii: 3; CIT412: Modelling And Simulation: 3; CIT474: Expert Systems: 2; CIT478: Artificial Intelligence: 3; ', '', '', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `code` varchar(128) NOT NULL,
  `title` varchar(512) NOT NULL,
  `department` varchar(512) NOT NULL,
  `unit` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `created` varchar(128) NOT NULL,
  `updated` varchar(128) NOT NULL,
  `semester` varchar(128) NOT NULL,
  `level` varchar(128) NOT NULL,
  `id` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`code`, `title`, `department`, `unit`, `status`, `created`, `updated`, `semester`, `level`, `id`) VALUES
('CIT467', 'Visual Programming Language', 'Computer Science', 3, 'Elective', '2018-10-26 05:20:22', '', '1', '400', '51b3a5c320911b7f26d9844ff32808b7522220dd'),
('#53da8e', 'Finishing Up Frontend Site Design', 'Mathematics & Statistics', 3, 'Core', '2018-10-26 05:16:00', '', '1', '300', '6055d984df3e2caae85d6d830d7f14eec85125ba'),
('CIT478', 'Artificial Intelligence', 'Computer Science', 3, 'Elective', '2018-10-26 05:14:30', '', '2', '400', '65e37f76f2a8b0abb38ef66a4d5d2fff96e44e28'),
('GST301', 'Entrepreneurship Studies', 'Computer Science', 2, 'Core', '2018-10-26 05:17:03', '', '1', '300', '8db15f3d1b48a4c17533e4ae8eefde0aae3a669e'),
('CIT474', 'Expert Systems', 'Computer Science', 2, 'Elective', '2018-10-24 09:09:19', '', '2', '400', '97f589229791da365d11f0cf1478a7e778d25626'),
('CIT411', 'Microcomputers And Microprocessors', 'Computer Science', 3, 'Elective', '2018-10-26 05:19:33', '', '1', '400', '9bd3783718d95f1d3c5af6de09e009bdb2844013'),
('MTH213', 'Introduction To Mathematics', 'Mathematics & Statistics', 3, 'Core', '2018-10-24 09:06:53', '', '2', '200', '9f9791c897f582bf1dc91208fb9b95477b73995d'),
('CIT432', 'Software Engineering Ii', 'Computer Science', 3, 'Core', '2018-10-26 05:12:59', '', '2', '400', 'c3f76e025ac6e38a0c1f9ce80985a54169ad4ea3'),
('CIT412', 'Modelling And Simulation', 'Computer Science', 3, 'Core', '2018-10-26 05:13:40', '', '2', '400', 'e83f36ce604e26a041c50f77c05b5fd74d2845a6');

-- --------------------------------------------------------

--
-- Table structure for table `dept_table`
--

CREATE TABLE `dept_table` (
  `name` varchar(512) NOT NULL,
  `code` varchar(512) NOT NULL,
  `faculty` varchar(512) NOT NULL,
  `id` varchar(512) NOT NULL,
  `created` varchar(512) NOT NULL,
  `updated` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_table`
--

INSERT INTO `dept_table` (`name`, `code`, `faculty`, `id`, `created`, `updated`) VALUES
('Computer Science', 'CSC', 'Sciences', '377858b43eb978f901b85ec76ec770f93285dd8f', '2018-10-24 09:02:31', '2018-10-24 09:03:55'),
('Mathematics & Statistics', 'MS', 'Sciences', '6cb06795329248a18b73bf5dc691fb4078415e27', '2018-10-24 09:03:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `exam_reg_table`
--

CREATE TABLE `exam_reg_table` (
  `id` varchar(512) NOT NULL,
  `department` varchar(512) NOT NULL,
  `level` varchar(128) NOT NULL,
  `matric_number` varchar(128) NOT NULL,
  `user_id` varchar(512) NOT NULL,
  `registered_exam_courses` varchar(1024) NOT NULL,
  `created` varchar(128) NOT NULL,
  `updated` varchar(128) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_reg_table`
--

INSERT INTO `exam_reg_table` (`id`, `department`, `level`, `matric_number`, `user_id`, `registered_exam_courses`, `created`, `updated`, `amount`) VALUES
('4ced61f239f0088452a7d45dc17eab4b197626b9', 'Computer Science', '400', 'TEST', '14f222a6670fe9613813b05ede768c81e4f35ea0', 'CIT411: Microcomputers And Microprocessors: 3; CIT412: Modelling And Simulation: 3; CIT432: Software Engineering Ii: 3; CIT474: Expert Systems: 2; ', '', '', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `id` varchar(512) NOT NULL,
  `date` varchar(128) NOT NULL,
  `bank_name` varchar(128) NOT NULL,
  `bank_branch` varchar(128) NOT NULL,
  `amount` double NOT NULL,
  `teller_image` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `created` varchar(128) NOT NULL,
  `updated` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_table`
--

INSERT INTO `payment_table` (`id`, `date`, `bank_name`, `bank_branch`, `amount`, `teller_image`, `user_id`, `created`, `updated`, `status`) VALUES
('65cb7fed765335205a6c79b4fdc23e7b58e75ede', '25/10/2018 04:00:48', 'Fidelity', 'Fidelity', 50000, 'http://127.0.0.1/student_reg//teller_uploads/14f222a6670fe9613813b05ede768c81e4f35ea02018.10.25_050109.jpg', '14f222a6670fe9613813b05ede768c81e4f35ea0', '2018-10-25 16:01:09', '2018-10-25 23:42:27', 'APPROVED'),
('6f9dcb9cd1d3e436d993a2a82746919cf0a585f2', '16/10/2018', 'Fidelity', 'Fidelity', 12, 'http://127.0.0.1/student_reg//teller_uploads/14f222a6670fe9613813b05ede768c81e4f35ea02018.10.25_121401.jpg', '14f222a6670fe9613813b05ede768c81e4f35ea0', '2018-10-25 11:14:01', '', 'PENDING'),
('7181e26fe2d242f82886287a040090dd5d867283', '23/10/2018 09:00:38', 'Fidelity', 'Fidelity', 50000, 'http://127.0.0.1/student_reg//teller_uploads/14f222a6670fe9613813b05ede768c81e4f35ea02018.10.25_101229.jpg', '14f222a6670fe9613813b05ede768c81e4f35ea0', '2018-10-25 21:12:29', '2018-10-27 10:44:40', 'APPROVED'),
('902508c97eda1e2716c58814a828a8c3116d9ab1', '29/10/2018 05:00:16', 'GTBank', 'GTBank', 0, 'http://127.0.0.1/student_reg//teller_uploads/14f222a6670fe9613813b05ede768c81e4f35ea02018.10.25_050025.jpg', '14f222a6670fe9613813b05ede768c81e4f35ea0', '2018-10-25 16:00:26', '2018-10-25 23:39:18', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` varchar(512) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `other_name` varchar(128) NOT NULL,
  `matric_number` varchar(128) NOT NULL,
  `phone_number` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `department` varchar(256) NOT NULL,
  `level` varchar(128) NOT NULL,
  `password` varchar(512) NOT NULL,
  `state` varchar(128) NOT NULL,
  `lga` varchar(128) NOT NULL,
  `study_centre` varchar(128) NOT NULL,
  `created` varchar(128) NOT NULL,
  `updated` varchar(128) NOT NULL,
  `user_group` varchar(128) NOT NULL,
  `wallet_balance` double NOT NULL,
  `total_expenses` double NOT NULL,
  `image` varchar(512) NOT NULL,
  `registered_courses` varchar(1024) NOT NULL,
  `registered_exam_courses` varchar(1024) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `surname`, `other_name`, `matric_number`, `phone_number`, `email`, `department`, `level`, `password`, `state`, `lga`, `study_centre`, `created`, `updated`, `user_group`, `wallet_balance`, `total_expenses`, `image`, `registered_courses`, `registered_exam_courses`, `gender`) VALUES
('14f222a6670fe9613813b05ede768c81e4f3510111ea', 'Inya', 'Lawrence', '', '8148129284', 'enyinnaotuu@yahoo.com', '', '', '206c80413b9a96c1312cc346b7d2517b84463edd', '', '', '', '', '2018-10-25 23:42:52', 'PERSONNEL', 0, 0, '', '', '', ''),
('14f222a6670fe9613813b05ede768c81e4f35ea0', 'Inya', 'eee', 'TEST', '2343223333', 'emeka@gnail.com', 'Computer Science', '400', 'b444ac06613fc8d63795be9ad0beaf55011936ac', 'Abuja', 'Gwagwalada', 'gg', '2018-10-25 04:34:04', '2018-10-27 10:09:47', 'STUDENT', 54000, 16000, 'http://127.0.0.1/student_reg//uploads/f5b3b6ebf2ccce86e7dbbb715157c8e17b1bbbdb.jpg', 'CIT411; CIT432; CIT412; CIT474; CIT478; ', 'CIT411; CIT412; CIT432; CIT474; ', ''),
('2cvf30013b9a96c1312cc346b7d2517b84463edd', 'Lawrence', 'Inya', '', '2343223333', 'enyinnai@brightspotcreative.com', '', '', '206c80413b9a96c1312cc346b7d2517b84463edd', 'Rivers', 'Port Harcourt', '', '', '2018-10-25 04:04:15', 'ADMINISTRATOR', 0, 0, '', '', '', ''),
('3add0cee2a206a828b4189e2f27b694be747096b', 'Inya', 'eee', 'TEST2', '2343223333', 'emeka@gnail.com', 'Computer Science', '300', '7278934df282ee1027073d9eedbfee4735c627a5', 'Ogun', 'Ado Odo/Otta', 'gg', '2018-10-25 04:36:58', '', 'STUDENT', 0, 0, '', '', '', ''),
('5018b8374943fb3d5cd3afd3f298d91127704960', 'Inya', 'Michael Kenneth', 'UN2017/CSC', '2343223333', 'enyinnai@brightspotcreative.com', 'Mathematics & Statistics', '300', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Abuja', 'Bwari', 'Port Harcourt Study Centre', '2018-10-26 10:50:37', '', 'STUDENT', 0, 0, '', '', '', ''),
('697d4faa346c0bc1b7cb6eef5ec32da81575cfc5', 'Inya', 'eee', 'TEST1', '2343223333', 'emeka@gnail.com', 'Mathematics & Statistics', '300', '7278934df282ee1027073d9eedbfee4735c627a5', 'Abia', 'Arochukwu', 'gg', '2018-10-25 04:35:59', '', 'STUDENT', 0, 0, '', '', '', ''),
('99fe55c4d6e8ad0e7cf42937e30836474c683197', 'Inya', 'Michael Kenneth', 'TEST12', '2343223333', 'emeka@gnail.com', 'Computer Science', '200', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', 'Borno', 'Bayo', 'Port Harcourt Study Centre', '2018-10-26 11:07:00', '', 'STUDENT', 0, 0, 'http://127.0.0.1/student_reg//uploads/99fe55c4d6e8ad0e7cf42937e30836474c683197.jpg', '', '', ''),
('b7a5a5a5e02e06458ad95b67493fb625ceb2744b', 'ddd', 'eee', 'TEST3', '2343223333', 'emeka@gnail.com', 'Mathematics & Statistics', '300', '7278934df282ee1027073d9eedbfee4735c627a5', 'Nasarawa', 'Doma', 'gg', '2018-10-25 04:37:44', '', 'STUDENT', 0, 0, '', '', '', ''),
('c2d05a35de29d6f02efbce4e7d6380946694da5f', 'Inya', 'Michael Kenneth', 'NOU123456780', '2343223333', 'enyinnai@brightspotcreative.com', 'Mathematics & Statistics', '100', '207e7ae7c7c61d77ad79be51537523123ecc2b75', 'Abuja', 'Bwari', 'Port Harcourt Study Centre', '2018-10-24 19:56:37', '2018-10-25 04:06:25', 'STUDENT', 0, 0, '', '', '', ''),
('d9a8b3cbc9a5de8f07cefa3a08f625278bc6b2a3', 'Inya', 'Michael Kenneth', 'NOU123456789', '', 'enyinnai@brightspotcreative.com', 'Computer Science', '300', '206c80413b9a96c1312cc346b7d2517b84463edd', 'Adamawa', 'Fufore', 'Port Harcourt Study Centre', '2018-10-24 12:01:55', '', 'STUDENT', 0, 0, '', '', '', ''),
('e8092981cd5734dbce125aca69ec56d2c451d710', 'Okorie', 'Test', 'TEST121', '8036009397', 'enyinnaotuu@yahoo.com', 'Computer Science', 'HND 1', '207e7ae7c7c61d77ad79be51537523123ecc2b75', 'Ekiti', 'Ikole', '', '2018-10-28 23:41:45', '2018-10-28 23:48:08', 'STUDENT', 0, 0, 'http://127.0.0.1/appartment_system//uploads/ccf56d4b2a073f940b3397adf4a3ee76411ed953.jpg', '', '', 'Male'),
('ee6e7d31ca007d049365b01e91e62ceff2833409', 'Inya', 'Michael Kenneth', 'UN2018/CSC', '2343223333', 'enyinnai11@brightspotcreative.com', 'Mathematics & Statistics', '300', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', 'Akwa Ibom', 'Eastern Obolo', 'Port Harcourt Study Centre', '2018-10-26 10:55:21', '2018-10-26 11:05:01', 'STUDENT', 0, 0, 'http://127.0.0.1/student_reg//uploads/dfda53f7d312cd20e91f5bfd680e13f34fe4b7ed.jpg', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_reg_table`
--
ALTER TABLE `course_reg_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_table`
--
ALTER TABLE `dept_table`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `exam_reg_table`
--
ALTER TABLE `exam_reg_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
