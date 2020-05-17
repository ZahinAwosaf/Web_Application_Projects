-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 02:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aiub_gaggle`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(7) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `name`) VALUES
(101, 'CSE'),
(102, 'BBA'),
(104, 'EEE'),
(105, 'SE');

-- --------------------------------------------------------

--
-- Table structure for table `expertise`
--

CREATE TABLE `expertise` (
  `exp_id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL,
  `sub_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `faq_que_id` int(11) NOT NULL,
  `question_text` varchar(300) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `int_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_id` int(40) NOT NULL,
  `user_id` int(30) NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `que_ans_id` int(11) NOT NULL,
  `que_answer` text NOT NULL,
  `faq_que_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `research_domains`
--

CREATE TABLE `research_domains` (
  `domain_id` int(11) NOT NULL,
  `domain_name` varchar(90) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `research_domains`
--

INSERT INTO `research_domains` (`domain_id`, `domain_name`, `dept_id`) VALUES
(22, 'Computer Vision', 101),
(23, 'Data Science', 101),
(25, 'Cyber Security', 101),
(26, 'Software Engineering', 105),
(27, 'Programming Languages', 105),
(28, 'Software Development Model', 105),
(29, 'Marketing', 102),
(30, 'Accounting', 102),
(31, 'Business Study', 102),
(32, 'Device', 104),
(33, 'Electronic Device', 104),
(34, 'Electric Device', 104),
(35, 'Microprocessor', 104),
(36, 'Micro-Controller', 104);

-- --------------------------------------------------------

--
-- Table structure for table `research_info`
--

CREATE TABLE `research_info` (
  `research_id` int(11) NOT NULL,
  `pub_year` date NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `name`, `dept_id`) VALUES
(60, 'Math 1', 101),
(61, 'Physics', 101),
(62, 'Electronic Device', 104),
(63, 'Alternating Current', 104),
(64, 'Economics', 102),
(65, 'B. Com', 102),
(66, 'Accounting', 102),
(67, 'Principle Accounting', 102),
(68, 'Microprocessor', 104),
(69, 'Digital Logic Design', 104),
(70, 'Machine', 104),
(71, 'DC', 104),
(72, 'c++', 105),
(73, 'c#', 105),
(74, 'OOAD', 105),
(75, 'JAVA', 105),
(76, 'Python', 105),
(77, 'software engineering', 101),
(78, 'Computer Fundamental', 101),
(79, 'Image Processing', 101);

-- --------------------------------------------------------

--
-- Table structure for table `users_status`
--

CREATE TABLE `users_status` (
  `status_id` int(11) NOT NULL,
  `start_timestamp` datetime NOT NULL,
  `end_timestamp` datetime NOT NULL,
  `place` varchar(100) NOT NULL,
  `status_timestamp` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `dept_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `aiub_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_status_subjects`
--

CREATE TABLE `user_status_subjects` (
  `user_s_sub_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `con18` (`from_user_id`),
  ADD KEY `con19` (`to_user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `expertise`
--
ALTER TABLE `expertise`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`faq_que_id`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`following_id`),
  ADD KEY `con5` (`follower_id`),
  ADD KEY `con6` (`followed_id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`int_id`),
  ADD KEY `con12` (`user_id`),
  ADD KEY `con14` (`domain_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`que_ans_id`),
  ADD KEY `con26` (`faq_que_id`);

--
-- Indexes for table `research_domains`
--
ALTER TABLE `research_domains`
  ADD PRIMARY KEY (`domain_id`);

--
-- Indexes for table `research_info`
--
ALTER TABLE `research_info`
  ADD PRIMARY KEY (`research_id`),
  ADD KEY `con22` (`user_id`),
  ADD KEY `con23` (`domain_id`),
  ADD KEY `con24` (`dept_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `subjects` (`dept_id`);

--
-- Indexes for table `users_status`
--
ALTER TABLE `users_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `con9` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `em` (`email`),
  ADD UNIQUE KEY `aiub_id` (`aiub_id`),
  ADD KEY `dept_id` (`dept_id`) USING BTREE;

--
-- Indexes for table `user_status_subjects`
--
ALTER TABLE `user_status_subjects`
  ADD PRIMARY KEY (`user_s_sub_id`),
  ADD KEY `con10` (`status_id`),
  ADD KEY `con11` (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `expertise`
--
ALTER TABLE `expertise`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `faq_que_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
  MODIFY `following_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `int_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `que_ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `research_domains`
--
ALTER TABLE `research_domains`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `research_info`
--
ALTER TABLE `research_info`
  MODIFY `research_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users_status`
--
ALTER TABLE `users_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `user_status_subjects`
--
ALTER TABLE `user_status_subjects`
  MODIFY `user_s_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `con18` FOREIGN KEY (`from_user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `con19` FOREIGN KEY (`to_user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `expertise`
--
ALTER TABLE `expertise`
  ADD CONSTRAINT `expertise_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `expertise_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`);

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `con5` FOREIGN KEY (`follower_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `con6` FOREIGN KEY (`followed_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `interest`
--
ALTER TABLE `interest`
  ADD CONSTRAINT `con12` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `con14` FOREIGN KEY (`domain_id`) REFERENCES `research_domains` (`domain_id`);

--
-- Constraints for table `login_details`
--
ALTER TABLE `login_details`
  ADD CONSTRAINT `login_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD CONSTRAINT `con26` FOREIGN KEY (`faq_que_id`) REFERENCES `faq_questions` (`faq_que_id`);

--
-- Constraints for table `research_info`
--
ALTER TABLE `research_info`
  ADD CONSTRAINT `con22` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `con23` FOREIGN KEY (`domain_id`) REFERENCES `research_domains` (`domain_id`),
  ADD CONSTRAINT `con24` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `users_status`
--
ALTER TABLE `users_status`
  ADD CONSTRAINT `con9` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `user_status_subjects`
--
ALTER TABLE `user_status_subjects`
  ADD CONSTRAINT `con10` FOREIGN KEY (`status_id`) REFERENCES `users_status` (`status_id`),
  ADD CONSTRAINT `con11` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
