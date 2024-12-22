-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 08:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meditrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `accident_report_db`
--

CREATE TABLE `accident_report_db` (
  `accident_report_id` int(100) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `date_created` varchar(250) NOT NULL,
  `time_created` varchar(250) NOT NULL,
  `chief_complaint` varchar(250) NOT NULL,
  `treatment_intervention` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accident_report_db`
--

INSERT INTO `accident_report_db` (`accident_report_id`, `nurse_id`, `student_id`, `date_created`, `time_created`, `chief_complaint`, `treatment_intervention`) VALUES
(1, 1, '2021170596', 'June 8, 2024', '5:56pm', 'try', 'try'),
(2, 1, '2021170596', 'June 8, 2024', '6:07pm', 'sakit tuhod', 'hinilot'),
(3, 1, '2021170596', 'June 9, 2024', '6:15pm', 'sakt ulo', 'sakit talaga'),
(4, 1, '2021170596', 'June 9, 2024', '6:15pm', 'sakit', 'sakitttttttttttttttttttttttt');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_db`
--

CREATE TABLE `appointment_db` (
  `appointment_id` int(11) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `appointment_date` varchar(250) NOT NULL,
  `appoinment_time` varchar(250) NOT NULL,
  `health_concern` varchar(250) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `appointment_status` varchar(250) NOT NULL DEFAULT 'Pending',
  `reject_reason` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_db`
--

INSERT INTO `appointment_db` (`appointment_id`, `nurse_id`, `student_id`, `appointment_date`, `appoinment_time`, `health_concern`, `reason`, `appointment_status`, `reject_reason`) VALUES
(4, 1, '21321', 'June 7, 2024', '10:25pm', 'follow-up', 'test', 'Approve', ''),
(5, 1, '21321', 'June 7, 2024', '10:25pm', 'bp-monetory', 'test 2', 'Rejected', 'test'),
(7, 1, '21321', 'June 9, 2024', '12:50pm', 'consultation', 'test test test', 'Rejected', 'bobo talaga si toni eh'),
(8, 1, '21321', 'June 9, 2024', '12:52pm', 'consultation', 'test bobo si toni at vega', 'Approve', ''),
(9, 7, '21321', 'June 9, 2024', '1:08pm', 'consultation', '123', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_records_db`
--

CREATE TABLE `consultation_records_db` (
  `consult_record_id` int(100) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `date_submited` varchar(250) NOT NULL,
  `illness` varchar(250) NOT NULL,
  `injury` varchar(250) NOT NULL,
  `chief_complaint` varchar(250) NOT NULL,
  `treatment_intervention` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation_records_db`
--

INSERT INTO `consultation_records_db` (`consult_record_id`, `nurse_id`, `student_id`, `date_submited`, `illness`, `injury`, `chief_complaint`, `treatment_intervention`) VALUES
(1, 1, '2021170596', 'June 1, 2024', '1', '1', '1', '1'),
(2, 1, '2021170596', 'June 1, 2024', 'try', 'try', 'try', 'try'),
(3, 1, '2021170596', 'June 1, 2024', 'try', 'None', 'try', 'try'),
(4, 1, '2021170596', 'June 1, 2024', 'None', 'merererererererererere', 'mererererererererereremererererererererereremerererererererererere', 'mererererererererereremerererererererererere'),
(5, 1, '2021170596', 'June 1, 2024', '321', '321', '321', '321'),
(7, 1, '2021170596', 'June 1, 2024', 'natemannnnnnnnnnnnnnnnnnnnn', 'None', '1', '1'),
(8, 1, '2021170596', 'June 1, 2024', 'None', 'None', '1', '1'),
(10, 1, '2021170596', 'June 7, 2024', '1', 'None', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `dental_records_db`
--

CREATE TABLE `dental_records_db` (
  `dental_record_id` int(100) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `date_submited` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dental_records_db`
--

INSERT INTO `dental_records_db` (`dental_record_id`, `nurse_id`, `student_id`, `date_submited`) VALUES
(1, 1, '2021170596', '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_db`
--

CREATE TABLE `inventory_db` (
  `product_id` int(100) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `medicine_name` varchar(250) NOT NULL,
  `dosage` varchar(250) NOT NULL,
  `stock_in` varchar(250) NOT NULL,
  `medicine_img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_db`
--

INSERT INTO `inventory_db` (`product_id`, `nurse_id`, `medicine_name`, `dosage`, `stock_in`, `medicine_img`) VALUES
(1, 1, 'nate_overdose', '12', '11', 'medicine_img/666186bfc738e-396848899_1410298216537403_1688326965993114666_n.png'),
(2, 1, 'toni_stroke', '50', '10', 'medicine_img/6661b1d35f38c-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg'),
(3, 1, 'gamot para sa mga baliw', '500', '10', 'medicine_img/66656fefeeef0-MIAH-removebg-preview.png'),
(4, 7, 'baliw', '600', '10', 'medicine_img/6665711ccf660-439549942_352751991135890_1567216092011051690_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `medcert_db`
--

CREATE TABLE `medcert_db` (
  `medical_cert_id` int(100) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `current_date` varchar(250) NOT NULL,
  `current_time` varchar(250) NOT NULL,
  `reason_1` varchar(250) NOT NULL,
  `reason_2` varchar(250) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `lab_result_img` varchar(250) NOT NULL,
  `medcert_status` varchar(250) NOT NULL DEFAULT 'Pending',
  `reject_reason` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medcert_db`
--

INSERT INTO `medcert_db` (`medical_cert_id`, `nurse_id`, `student_id`, `current_date`, `current_time`, `reason_1`, `reason_2`, `purpose`, `lab_result_img`, `medcert_status`, `reject_reason`) VALUES
(1, 1, '21321', '2024-06-05', '03:33:55 pm', '', '', 'OJT', 'medcert_img/66606943beaec-437763067_779420714161724_1428912286637114098_n.png', 'Approve', ''),
(2, 1, '21321', 'June 5, 2024', '9:40pm', '', '', 'School Enrollment', 'medcert_img/66606ad4b0c09-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Approve', ''),
(3, 1, '21321', 'June 5, 2024', '9:45pm', '', '', 'Other', 'medcert_img/66606c06b9b0b-slicer_447465.png', 'Rejected', 'test'),
(4, 1, '21321', 'June 5, 2024', '9:48pm', '', '', 'bobo', 'medcert_img/66606ca559d7a-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Approve', ''),
(5, 8, '21321', 'June 5, 2024', '9:49pm', '', '', 'bobo', 'medcert_img/66606ce145e53-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Approve', ''),
(6, 0, '21321', 'June 5, 2024', '9:50pm', '', '', 'test ', 'medcert_img/66606d3c70118-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Pending', ''),
(7, 0, '21321', 'June 5, 2024', '9:51pm', '', '', 'OJT', 'medcert_img/66606d4a18ee0-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Pending', ''),
(8, 0, '21321', 'June 6, 2024', '8:57pm', '', '', 'School Enrollment', 'medcert_img/6661b2477a8e0-vega.jpg', 'Pending', ''),
(9, 0, '21321', 'June 6, 2024', '8:58pm', '', '', 'bobo si toni', 'medcert_img/6661b25ede610-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Pending', ''),
(10, 0, '21321', 'June 7, 2024', '7:42pm', '', '', 'Helth Purpose', 'medcert_img/6662f209855d2-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Pending', ''),
(11, 0, '21321', 'June 9, 2024', '5:12pm', '', '', 'insurance', 'medcert_img/666571e4872d7-441473800_1617746752134067_6045741539421255944_n.jpg', 'Pending', ''),
(12, 0, '21321', 'June 9, 2024', '5:14pm', '', '', 'OJT', 'medcert_img/66657280d5b91-0b706ac2-e52e-451b-bd0d-cfc1745c6345.jpg', 'Pending', ''),
(13, 0, '21321', 'June 9, 2024', '8:13pm', '', '', 'School Enrollment', 'medcert_img/66659c63d658e-aefb1d8b-226c-4b4d-8e08-dc20c946811b.jpg', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `medical_records_db`
--

CREATE TABLE `medical_records_db` (
  `medical_record_id` int(11) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `date_submited` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records_db`
--

INSERT INTO `medical_records_db` (`medical_record_id`, `nurse_id`, `student_id`, `date_submited`) VALUES
(1, 1, '2021170596', 'June 1, 2024');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_request_db`
--

CREATE TABLE `medicine_request_db` (
  `medicine_request_id` int(100) NOT NULL,
  `nurse_id` int(100) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `product_id` int(100) NOT NULL,
  `date_requested` varchar(250) NOT NULL,
  `time_requested` varchar(250) NOT NULL,
  `quantity` int(100) NOT NULL,
  `health_concern` varchar(250) NOT NULL,
  `med_status` varchar(250) NOT NULL DEFAULT 'Pending',
  `reject_reason` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_request_db`
--

INSERT INTO `medicine_request_db` (`medicine_request_id`, `nurse_id`, `student_id`, `product_id`, `date_requested`, `time_requested`, `quantity`, `health_concern`, `med_status`, `reject_reason`) VALUES
(1, 1, '21321', 2, 'June 7, 2024', 'June 7, 2024', 2, 'may ubo', 'Pending', ''),
(2, 1, '21321', 2, 'June 7, 2024', '8:57pm', 2, 'Masakit po paa ko', 'Approved', ''),
(3, 1, '21321', 1, 'June 7, 2024', '10:27pm', 2, 'test', 'Rejected', 'test'),
(4, 8, '21321', 1, 'June 7, 2024', '10:27pm', 1, 'test 2', 'Approved', ''),
(5, 1, '21321', 3, 'June 9, 2024', '5:13pm', 2, 'masakit', 'Rejected', 'lah baliw\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `nurse_db`
--

CREATE TABLE `nurse_db` (
  `nurse_id` int(100) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nurse_f_name` varchar(250) NOT NULL,
  `nurse_m_name` varchar(250) NOT NULL,
  `nurse_l_name` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `license_number` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse_db`
--

INSERT INTO `nurse_db` (`nurse_id`, `username`, `password`, `nurse_f_name`, `nurse_m_name`, `nurse_l_name`, `contact`, `license_number`) VALUES
(1, 'nate', '1', 'nate', 'man', 'overdrive', '', '000-111-222-33'),
(7, 'toni', 'vern', 'toni', 'verny', 'vern', '09487349848', '69696969'),
(8, 'baliw', 'katoni', 'toni', 'bali', ' siraulo', '09696969699', '69696969');

-- --------------------------------------------------------

--
-- Table structure for table `student_db`
--

CREATE TABLE `student_db` (
  `student_id` varchar(250) NOT NULL,
  `f_name` varchar(250) NOT NULL,
  `m_name` varchar(250) NOT NULL,
  `l_name` varchar(250) NOT NULL,
  `course` varchar(250) NOT NULL,
  `section` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `nationality` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_db`
--

INSERT INTO `student_db` (`student_id`, `f_name`, `m_name`, `l_name`, `course`, `section`, `address`, `bday`, `gender`, `status`, `nationality`, `contact_number`, `contact_person`, `username`, `password`) VALUES
('123456', 'Alli', 'E,', 'yutuc', 'BSIT MWA', 'INF211', 'blk 80 ot 21 metro', '2013-02-07', 'female', 'Single', 'sad', '09202110058', 'dsa', 'alli', 'dsa'),
('202112345', 'Nathaniel', 'E.', 'Victor', 'BSIT MWA', 'INF211', 'blk 80 lot 21 metro', '2001-05-22', 'male', 'Single', 'Filipino', '09123456789', 'arcega', '202112345', '12345'),
('21321', 'Nathaniel', 'Cuilao', 'Arcega', '321', 'das', '', '2024-06-05', 'dasd', 'dsa', 'sad', '321', 'dsa', 'dsa', 'dsa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accident_report_db`
--
ALTER TABLE `accident_report_db`
  ADD PRIMARY KEY (`accident_report_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `accident_report_db_ibfk_1` (`nurse_id`);

--
-- Indexes for table `appointment_db`
--
ALTER TABLE `appointment_db`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `appointment_db_ibfk_1` (`nurse_id`);

--
-- Indexes for table `consultation_records_db`
--
ALTER TABLE `consultation_records_db`
  ADD PRIMARY KEY (`consult_record_id`),
  ADD KEY `nurse_id` (`nurse_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `dental_records_db`
--
ALTER TABLE `dental_records_db`
  ADD PRIMARY KEY (`dental_record_id`),
  ADD KEY `nurse_id` (`nurse_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `inventory_db`
--
ALTER TABLE `inventory_db`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `inventory_db_ibfk_1` (`nurse_id`);

--
-- Indexes for table `medcert_db`
--
ALTER TABLE `medcert_db`
  ADD PRIMARY KEY (`medical_cert_id`),
  ADD KEY `medcert_db_ibfk_1` (`student_id`);

--
-- Indexes for table `medical_records_db`
--
ALTER TABLE `medical_records_db`
  ADD PRIMARY KEY (`medical_record_id`),
  ADD KEY `nurse_id` (`nurse_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `medicine_request_db`
--
ALTER TABLE `medicine_request_db`
  ADD PRIMARY KEY (`medicine_request_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `medicine_request_db_ibfk_1` (`product_id`);

--
-- Indexes for table `nurse_db`
--
ALTER TABLE `nurse_db`
  ADD PRIMARY KEY (`nurse_id`);

--
-- Indexes for table `student_db`
--
ALTER TABLE `student_db`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accident_report_db`
--
ALTER TABLE `accident_report_db`
  MODIFY `accident_report_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_db`
--
ALTER TABLE `appointment_db`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `consultation_records_db`
--
ALTER TABLE `consultation_records_db`
  MODIFY `consult_record_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dental_records_db`
--
ALTER TABLE `dental_records_db`
  MODIFY `dental_record_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_db`
--
ALTER TABLE `inventory_db`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medcert_db`
--
ALTER TABLE `medcert_db`
  MODIFY `medical_cert_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `medical_records_db`
--
ALTER TABLE `medical_records_db`
  MODIFY `medical_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine_request_db`
--
ALTER TABLE `medicine_request_db`
  MODIFY `medicine_request_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nurse_db`
--
ALTER TABLE `nurse_db`
  MODIFY `nurse_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accident_report_db`
--
ALTER TABLE `accident_report_db`
  ADD CONSTRAINT `accident_report_db_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_db` (`nurse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accident_report_db_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultation_records_db`
--
ALTER TABLE `consultation_records_db`
  ADD CONSTRAINT `consultation_records_db_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_db` (`nurse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultation_records_db_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dental_records_db`
--
ALTER TABLE `dental_records_db`
  ADD CONSTRAINT `dental_records_db_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_db` (`nurse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dental_records_db_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_db`
--
ALTER TABLE `inventory_db`
  ADD CONSTRAINT `inventory_db_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_db` (`nurse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medcert_db`
--
ALTER TABLE `medcert_db`
  ADD CONSTRAINT `medcert_db_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_records_db`
--
ALTER TABLE `medical_records_db`
  ADD CONSTRAINT `medical_records_db_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurse_db` (`nurse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_records_db_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine_request_db`
--
ALTER TABLE `medicine_request_db`
  ADD CONSTRAINT `medicine_request_db_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `inventory_db` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_request_db_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_db` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
