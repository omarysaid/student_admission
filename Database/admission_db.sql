-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 03:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admission_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students_info`
--

CREATE TABLE `students_info` (
  `info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `ss_name` varchar(255) NOT NULL,
  `ss_start_date` varchar(10) NOT NULL,
  `ss_end_date` varchar(10) NOT NULL,
  `csee_document` varchar(255) NOT NULL,
  `as_name` varchar(255) NOT NULL,
  `as_start_date` varchar(10) NOT NULL,
  `as_end_date` varchar(10) NOT NULL,
  `acsee_document` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `status_1` tinyint(1) NOT NULL,
  `status_2` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_info`
--

INSERT INTO `students_info` (`info_id`, `user_id`, `school`, `department`, `course`, `ss_name`, `ss_start_date`, `ss_end_date`, `csee_document`, `as_name`, `as_start_date`, `as_end_date`, `acsee_document`, `birth_certificate`, `status_1`, `status_2`) VALUES
(73, 62, 'The School of Earth Sciences, Real Estates, Business and Informatics (SERBI)', 'Computer Systems and Mathematics', 'Bachelor of Science in Information Systems Management', 'KIbaha sec school', '2023-08-02', '2024-06-30', 'FINAL YEAR DISSERTATION PROJECT CONCEPT NOTE - CSM.pdf', 'Kibaha high school', '2024-05-31', '2024-06-23', 'CamScanner 11-28-2023 10.26.pdf', 'CSM_ResearchThemes_112023.pdf', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `gender`, `country`, `region`, `district`, `phone`, `email`, `department`, `password`, `usertype`) VALUES
(32, 'omollo givenality omollo', 'DUP', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0675676543', 'omollogivenality@gmail.com', 'Director Of UnderGraduates', 'e10adc3949ba59abbe56e057f20f883e', 'DUP'),
(45, 'Helman Othman Helman', 'helman', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0674654543', 'helman@gmail.com', 'Computer Systems and Mathematics', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(46, 'Edson Helman Edson', 'edson', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0898787654', 'edson@gmail.com', 'Building Economics', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(47, 'Halima  Othman', 'halima', 'Female', 'Tanzania', 'Pwani', 'Rufiji', '0898787654', 'halima@gmail.com', 'Interior Design', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(48, 'Bernard Omollo', 'bernard', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0987876543', 'bernard@gmail.com', 'Architecture', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(49, 'Charles Omollo', 'charles', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0989876765', 'charles@gmail.com', 'Geospatial Sciences and Technology', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(50, 'Yusuph Othman', 'yusuph', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0678987654', 'yusuph@gmail.com', 'Business Studies', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(51, 'Zulfa Edson', 'zulfa', 'Female', 'Tanzania', 'pwani', 'kibaha', '0989878765', 'zulfa@gmail.com', 'Land Management and Valuation', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(52, 'Dickson Helman Dickson', 'dickson', 'Male', 'Tanzania', 'Pwani', 'kibaha', '0676565432', 'dickson@gmail.com', 'Civil and Environmental Engineering', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(53, 'Odema helson Odema', 'odema', 'Female', 'Tanzania', 'pwani', 'kibaha', '0787676543', 'odema@gmail.com', 'Environmental Science and Management', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(54, 'Godfather omollo', 'godfather', 'Male', 'Tanzania', 'Pwani', 'kibaha', '0898787654', 'godfather@gmail.com', 'Urban and Regional Planning', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(55, 'willson omollo willson', 'willson', 'Male', 'Tanzania', 'Pwani', 'kibaha', '0678767654', 'willson@gmail.com', 'Economics and Social Studies', 'fcea920f7412b5da7be0cf42b8c93759', 'HOD'),
(56, 'omary said omary', '26996/t.2021', 'Male', 'Tanzania', 'Pwani', 'Kibaha', '0678767654', NULL, NULL, 'fcea920f7412b5da7be0cf42b8c93759', 'STUDENT'),
(62, 'Edward Given', '26994/T.2023', 'Male', 'TAnzania', 'Pwani', 'Kibaha', '0678767654', NULL, NULL, 'fcea920f7412b5da7be0cf42b8c93759', 'STUDENT'),
(63, 'mama', '5665', 'Female', 'nnnf', 'gmg', 'ututut', '0989876765', NULL, NULL, 'fcea920f7412b5da7be0cf42b8c93759', 'STUDENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students_info`
--
ALTER TABLE `students_info`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `users` ADD FULLTEXT KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students_info`
--
ALTER TABLE `students_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students_info`
--
ALTER TABLE `students_info`
  ADD CONSTRAINT `students_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
