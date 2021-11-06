-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 04:02 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `street_address` varchar(50) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `street_address`, `postal_code`, `city`) VALUES
(1111, 'UNZA', 10101, 'Lusaka');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` varchar(50) NOT NULL,
  `dept_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
('HMR', 'Human Resource');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `home_address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT 'password',
  `join_date` date DEFAULT current_timestamp(),
  `gender` enum('M','F','O') DEFAULT NULL,
  `job_id` varchar(50) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `dept_id` varchar(50) DEFAULT NULL,
  `project_no` int(11) DEFAULT NULL,
  `bonus` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `first_name`, `last_name`, `date_of_birth`, `phone`, `home_address`, `email`, `password`, `join_date`, `gender`, `job_id`, `branch_id`, `dept_id`, `project_no`, `bonus`) VALUES
(2000, 'Thotholani', 'Tembo', '2021-11-01', '0976350781', 'Home', 'thotholani.tembo@cs.unza.zm', 'password', '2021-11-06', 'M', 'ADMIN', 1111, 'HMR', 101202100, '0.00'),
(2001, 'Kalinda', 'Siaminwe', '2021-11-01', '0977777797', 'Lusaka', 'kalinda.siaminwe@cs.unza.zm', 'password', '2021-11-13', 'F', 'ADMIN', 1111, 'HMR', 101202100, '0.00'),
(2004, 'Shamapumbu', 'Muzandu', '2021-11-06', '0977777777', 'Home', 'sham.mus@cs.unza.zm', 'password', '2021-11-06', 'M', 'PROGM', 1111, 'HMR', 101202100, '0.00'),
(2005, 'Abigail', 'Mwape', '2021-11-07', '0977777777', 'Lusaka', 'abi.mwape@cs.unza.zm', 'password', '2021-11-06', 'F', 'PROGM', 1111, 'HMR', 101202100, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` varchar(50) NOT NULL,
  `job_description` varchar(50) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `job_description`, `salary`) VALUES
('ADMIN', 'Administrator', '10000.00'),
('PROGM', 'Programmer', '15000.00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_tb`
--

CREATE TABLE `leave_tb` (
  `leave_id` int(11) NOT NULL,
  `leave_description` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Denied') DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_tb`
--

INSERT INTO `leave_tb` (`leave_id`, `leave_description`, `start_date`, `end_date`, `status`, `emp_id`) VALUES
(6001, 'Test', '2021-11-06', '2021-11-30', 'Pending', 2004);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_no` int(11) NOT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `project_budget` decimal(10,2) DEFAULT NULL,
  `date_comissioned` date DEFAULT current_timestamp(),
  `expected_completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_no`, `project_name`, `project_budget`, `date_comissioned`, `expected_completion_date`) VALUES
(101202100, 'Databases Group Project', '1000.00', '2021-11-06', '2021-11-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `project_no` (`project_no`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `leave_tb`
--
ALTER TABLE `leave_tb`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2006;

--
-- AUTO_INCREMENT for table `leave_tb`
--
ALTER TABLE `leave_tb`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6002;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101202101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`project_no`) REFERENCES `project` (`project_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_tb`
--
ALTER TABLE `leave_tb`
  ADD CONSTRAINT `leave_tb_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
