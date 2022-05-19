-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 11:34 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `surname`, `email`, `password`, `created_by`) VALUES
(1, 'super', 'admin', 'admin@gmail.com', '1234@Abc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `grade` text NOT NULL,
  `subject` text NOT NULL,
  `test_name` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `exam_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `grade`, `subject`, `test_name`, `teacher_id`, `exam_date`) VALUES
(3, '8', 'English', 'english exam', 1, ''),
(4, '8', 'EMS', 'EMS exam', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL,
  `grade_code` text NOT NULL,
  `subjects` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `grade_code`, `subjects`) VALUES
(1, '8', '\'EMS\',\'Arts & Culture \',\'Natural Science\',\'Socila Science\',\'Technology\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(2, '9', '[\'EMS\',\'Arts & Culture \',\'Natural Science\',\'Socila Science\',\'Technology\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(3, '10a', '[\'Economics\',\'Business Studies\',\'Accounting\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(4, '10b', '[\'Physics\',\'Geography\',\'Life Science\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(5, '10c', '[\'Tourism\',\'Agriculture\',\'Consumer Studies\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(6, '10d', '[\'Tourism\',\'Agriculture\',\'CAT\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics Literacy\']'),
(7, '11a', '[\'Economics\',\'Business Studies\',\'Accounting\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(8, '11b', '[\'Physics\',\'Geography\',\'Life Science\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(9, '11c', '[\'Tourism\',\'Agriculture\',\'Consumer Studies\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(10, '11d', '[\'Tourism\',\'Agriculture\',\'CAT\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics Literacy\']'),
(11, '12a', '[\'Economics\',\'Business Studies\',\'Accounting\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(12, '12b', '[\'Physics\',\'Geography\',\'Life Science\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(13, '12c', '[\'Tourism\',\'Agriculture\',\'Consumer Studies\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\']'),
(14, '12d', '[\'Tourism\',\'Agriculture\',\'CAT\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics Literacy\']');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` text NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `sender_type`, `user_id`, `user_type`, `message`, `date`, `seen`) VALUES
(1, 2, 'student', 1, 'teacher', 'Hello World', '2022-05-11 05:17:01', NULL),
(2, 1, 'teacher', 2, 'student', 'Can we meet up?', '2022-05-11 05:35:48', NULL),
(3, 1, 'admin', 1, 'teacher', 'ds', '2022-05-11 06:18:07', NULL),
(4, 2, 'student', 1, 'admin', 'Hi admin please change my transport', '2022-05-14 14:31:17', NULL),
(5, 1, 'admin', 2, 'student', 'Testing', '2022-05-15 09:43:38', NULL),
(6, 1, 'admin', 2, 'student', 'Test', '2022-05-15 09:44:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `id_number` text NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `surname`, `email`, `id_number`, `mobile`, `address`, `password`, `approved_by`, `status`) VALUES
(1, 'Parent', 'parent', 'parent@gmail.com', '8002025583086', '0610217499', '', '1234@Abc', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `q_type` text DEFAULT NULL,
  `options` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `exam_id`, `question`, `q_type`, `options`, `answer`) VALUES
(1, 3, 'Type me here', 'tbox', '', 'make a plan'),
(2, 3, 'dds', 'options', '[\"South Africa\",\"Still coming\",\"Still coming\",\"Still coming\"]', 'South Africa'),
(1, 4, 'nbghg', 'tbox', '', 'jhju');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(0, 'pending'),
(1, 'approved'),
(2, 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `id_number` text NOT NULL,
  `parent_id_number` text NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `surname`, `email`, `id_number`, `parent_id_number`, `mobile`, `address`, `password`, `grade`, `transport`, `approved_by`, `status`) VALUES
(1, 'test', '', 'james@gmail.com', '9002025583086', '8002025583086', '0610217411', '', '1234@Abc', NULL, NULL, NULL, 0),
(2, 'gg', 'ttttt', 'test1@gmail.com', '8102025583086', '8002025583086', '0610217499', '', '1234@Abc', NULL, 2, NULL, 1),
(4, 'sub', 'subs', 'testing@gmail.com', '8802025583087', '4502025583089', '0610217499', '', '1234@Abc', NULL, NULL, NULL, 0),
(5, 'stest', 'test', 'tests@gmail.com', '9907136201082', '8702025578081', '0725597811', 'aubrey matlala street', '1234@Abc', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `grade_code` text DEFAULT NULL,
  `grade_code_1` text DEFAULT NULL,
  `grade_code_2` text DEFAULT NULL,
  `grade_code_3` text DEFAULT NULL,
  `grade_code_4` text DEFAULT NULL,
  `grade_code_5` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `grade_code`, `grade_code_1`, `grade_code_2`, `grade_code_3`, `grade_code_4`, `grade_code_5`) VALUES
(1, 'EMS', '8', '9', NULL, NULL, NULL, NULL),
(2, 'Arts & Culture', '8', '9', NULL, NULL, NULL, NULL),
(3, 'Natural Science', '8', '9', NULL, NULL, NULL, NULL),
(4, 'Social Science', '8', '9', NULL, NULL, NULL, NULL),
(5, 'Technology', '8', '9', NULL, NULL, NULL, NULL),
(6, 'English', '8', '9', '10', '11', '12', NULL),
(7, 'Home Language', '8', '9', '10', '11', '12', NULL),
(8, 'Mathematics', '8', '9', '10', '11', '12', NULL),
(9, 'Life Orientation', '8', '9', '10', '11', '12', NULL),
(19, 'Economics', '10a', '11a', '12a', NULL, NULL, NULL),
(20, 'Business STudies', '10a', '11a', '12a', NULL, NULL, NULL),
(21, 'Accounting', '10a', '11a', '12a', NULL, NULL, NULL),
(22, 'Geography', '10b', '11b', '12b', NULL, NULL, NULL),
(23, 'Physics', '10b', '11b', '12b', NULL, NULL, NULL),
(24, 'Life Science', '10b', '11b', '12b', NULL, NULL, NULL),
(25, 'Consumer Studies', '10c', '11c', '12c', NULL, NULL, NULL),
(27, 'Agricultrure', '10c', '11c', '12c', NULL, NULL, NULL),
(28, 'Tourism', '10c', '11c', '12c', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `id_number` text NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `surname`, `email`, `id_number`, `mobile`, `address`, `password`, `approved_by`, `status`) VALUES
(1, 'teacher', 'tewach', 'teacher@gmail.com', '9902025583081', '0610217499', '', '1234@Abc', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transport_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `id_number` text NOT NULL,
  `mobile` text NOT NULL,
  `bus` text NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`transport_id`, `name`, `surname`, `id_number`, `mobile`, `bus`, `image`) VALUES
(1, 'driver', 'driver', '6802025553084', '0824444440', 'Skyline Bu', NULL),
(2, 'dr', 'mack', '5202025583084', '0821115554', 'Translyk', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transport_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
