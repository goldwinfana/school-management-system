-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 12:03 PM
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
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `date`) VALUES
(1, 6, '2022-06-07 22:45:00'),
(2, 2, '2022-06-06 22:57:00'),
(3, 2, '2022-06-07 22:58:00'),
(4, 6, '2022-06-08 00:18:00'),
(5, 6, '2022-06-08 00:18:00'),
(6, 6, '2022-06-08 12:00:00'),
(7, 6, '2022-06-08 12:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`) VALUES
(2, 'DSO'),
(4, 'c++'),
(5, 'sql');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL DEFAULT current_timestamp(),
  `return_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `student_id`, `book_id`, `borrow_date`, `return_date`, `status`) VALUES
(5, 6, 5, '2022-06-08 12:02:28', NULL, 0),
(6, 6, 2, '2022-06-08 12:03:10', NULL, 1);

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
  `exam_date` text NOT NULL,
  `duration` int(11) NOT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `grade`, `subject`, `test_name`, `teacher_id`, `exam_date`, `duration`, `status`) VALUES
(26, '9', 'EMS', 'EMS exam', 1, '2022-05-24 20:11:55', 1, 'active'),
(27, '9', 'Arts & Culture ', 'EMS exam', 1, '2022-05-24 20:11:55', 2, 'active'),
(28, '9', 'Natural Science', 'english exam', 1, '2022-05-24 20:11:55', 3, NULL),
(30, '9', 'Arts & Culture ', 'EMS examination', 1, '2022-05-25T09:15', 3, NULL),
(31, '9', 'EMS', 'english exam', 2, '2022-06-07', 3, NULL),
(32, '9', 'Natural Science', 'english exam', 2, '2022-06-07', 3, NULL),
(33, '9', 'Arts & Culture ', 'english exam', 2, '2022-06-07', 3, NULL),
(34, '9', 'Technology', 'english exam', 2, '2022-06-07', 3, NULL);

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
(2, '9', '\'EMS\',\'Arts & Culture \',\'Natural Science\',\'Socila Science\',\'Technology\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(3, '10a', '\'Economics\',\'Business Studies\',\'Accounting\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(4, '10b', '\'Physics\',\'Geography\',\'Life Science\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(5, '10c', '\'Tourism\',\'Agriculture\',\'Consumer Studies\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(6, '10d', '\'Tourism\',\'Agriculture\',\'CAT\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics Literacy\''),
(7, '11a', '\'Economics\',\'Business Studies\',\'Accounting\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(8, '11b', '\'Physics\',\'Geography\',\'Life Science\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(9, '11c', '\'Tourism\',\'Agriculture\',\'Consumer Studies\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(10, '11d', '\'Tourism\',\'Agriculture\',\'CAT\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics Literacy\''),
(11, '12a', '\'Economics\',\'Business Studies\',\'Accounting\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(12, '12b', '\'Physics\',\'Geography\',\'Life Science\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(13, '12c', '\'Tourism\',\'Agriculture\',\'Consumer Studies\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics\''),
(14, '12d', '\'Tourism\',\'Agriculture\',\'CAT\',\'Life Orientation\',\'English\',\'Home Language\',\'Mathematics Literacy\'');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `mark_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `score` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`mark_id`, `exam_id`, `student_id`, `question`, `answer`, `score`, `date`) VALUES
(1, 27, 2, '1', 'true', 1, '2022-05-25 10:38:26'),
(3, 27, 2, '2', 'false', 1, '2022-05-25 11:13:19'),
(4, 27, 2, '3', 'Hi', 1, '2022-05-25 11:14:01'),
(5, 27, 2, '4', 'Pretoria', 1, '2022-05-25 11:15:43'),
(6, 27, 2, '5', 'true', 0, '2022-05-25 11:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
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
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `sender_type`, `user_id`, `user_type`, `message`, `date`, `seen`) VALUES
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
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `q_type` text DEFAULT NULL,
  `options` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `exam_id`, `question`, `q_type`, `options`, `answer`) VALUES
(1, 27, 'jg', 'tf', '[\"true\",\"false\"]', 'true'),
(2, 27, 'jg', 'tf', '[\"true\",\"false\"]', 'false'),
(3, 27, 'What is your name', 'tbox', '', 'Enter your own name'),
(4, 27, 'Which one is the capital city of Gauteng', 'options', '[\"Pretoria\",\"Hammanskarl\",\"Seshego\",\"Germiston\"]', 'Pretoria'),
(5, 27, 'Are you done writing exams', 'tf', '[\"true\",\"false\"]', 'false'),
(1, 30, 'Where can we find South Africa', 'options', '[\"Africa\",\"Asia\",\"America\",\"Europe\"]', 'Africa'),
(2, 30, 'ARe you done', 'tf', '[\"true\",\"false\"]', 'true'),
(3, 30, 'Find x\r\nx+3=5', 'tbox', '', 'Do your best'),
(1, 34, 'Are you okay', 'tf', '[\"true\",\"false\"]', 'true');

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
  `grade` text DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `surname`, `email`, `id_number`, `parent_id_number`, `mobile`, `address`, `password`, `grade`, `transport`, `approved_by`, `status`) VALUES
(1, 'test', '', 'james@gmail.com', '9002025583086', '8002025583086', '0610217411', '', '1234@Abc', NULL, NULL, NULL, 0),
(2, 'gg', 'ttttt', 'test1@gmail.com', '8102025583086', '8002025583086', '0610217499', '', '1234@Abc', '9', 2, NULL, 1),
(4, 'sub', 'subs', 'testing@gmail.com', '8802025583087', '4502025583089', '0610217499', '', '1234@Abc', NULL, NULL, NULL, 0),
(5, 'stest', 'test', 'tests@gmail.com', '9907136201082', '8702025578081', '0725597811', 'aubrey matlala street', '1234@Abc', NULL, NULL, NULL, 0),
(6, 'students', 'test', 'student@gmail.com', '0502025583084', '8802025583089', '0610210000', '477 Sisulu Street', '1234@Abc', '10a', NULL, NULL, 1);

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
  `grade_code` text DEFAULT NULL,
  `subjects` text DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `surname`, `email`, `id_number`, `mobile`, `address`, `password`, `grade_code`, `subjects`, `approved_by`, `status`) VALUES
(1, 'teacher', 'tewach', 'teacher@gmail.com', '9902025583081', '0610217499', '', '1234@Abc', '9', '[\"EMS\",\"Arts & Culture \",\"Natural Science\",\"Socila Science\",\"Technology\"]', NULL, 1),
(2, 'teacher1', 'tewach1', 'teacher1@gmail.com', '9902025583082', '0610217498', '', '1234@Abc', '9', '[\"EMS\",\"Arts & Culture \",\"Natural Science\",\"Socila Science\",\"Technology\"]', NULL, 1);

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
(2, 'test', 'test', '7702025502084', '0678541222', 'Old bus', '75820556f9d53f5a8697e088a33d46b6supply.png');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `upload_id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `description` text NOT NULL,
  `file_name` text NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`upload_id`, `user_id`, `description`, `file_name`, `date`) VALUES
(1, '8102025583086', 'Proof of payment', '17e4813d36d038291e4a8c510e85585fDetailed Speeding Detail.pdf', '2022-05-24 20:11:55'),
(2, '0502025583084', 'Registration proof of payment', '8fd52990c830f505a728a668f9222506Capture2.PNG', '2022-05-29 18:57:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

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
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
  MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
