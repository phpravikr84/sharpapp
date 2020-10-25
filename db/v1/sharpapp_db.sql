-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 03:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharpapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_booking_form`
--

CREATE TABLE `appointment_booking_form` (
  `booking_form_id` int(10) NOT NULL,
  `referral_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `funding_id` int(10) NOT NULL,
  `service_request_id` int(10) NOT NULL,
  `ref_doctor_id` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brief_clinical_dtls`
--

CREATE TABLE `brief_clinical_dtls` (
  `id` int(10) NOT NULL,
  `procedure_id` int(10) NOT NULL,
  `brief_clinical_dtls` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `funding`
--

CREATE TABLE `funding` (
  `funding_id` int(10) NOT NULL,
  `option_dtls` longtext NOT NULL,
  `funding_option_id` int(10) NOT NULL,
  `funding_type` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `pid` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `preffered_name` varchar(100) NOT NULL,
  `dob` datetime NOT NULL,
  `address` text NOT NULL,
  `postcode` varchar(100) NOT NULL,
  `mobile_phone` varchar(100) NOT NULL,
  `home_phone` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `work_phone` varchar(100) NOT NULL,
  `csc_card` varchar(100) NOT NULL,
  `huhc_card` varchar(100) NOT NULL,
  `q4` varchar(100) NOT NULL,
  `q5` varchar(100) NOT NULL,
  `patient_dtls` longtext NOT NULL,
  `address_dtls` longtext NOT NULL,
  `address_postcode` longtext NOT NULL,
  `adress_dtls2` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `procedure_tbl`
--

CREATE TABLE `procedure_tbl` (
  `procedure_id` int(10) NOT NULL,
  `procedure_name` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `referral_to_details`
--

CREATE TABLE `referral_to_details` (
  `ref_id` int(10) NOT NULL,
  `ref_name` varchar(100) NOT NULL,
  `speciality` varchar(100) NOT NULL,
  `urgency` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `referrral_id` int(10) NOT NULL,
  `referral_sent` datetime NOT NULL,
  `referral_dtls` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ref_doctor_details`
--

CREATE TABLE `ref_doctor_details` (
  `ref_doctor_id` int(10) NOT NULL,
  `ref_doctor_name` varchar(100) NOT NULL,
  `nzmc` text NOT NULL,
  `position` text NOT NULL,
  `ref_doctor_dtls` longtext NOT NULL,
  `ref_doctor_address_dtls` longtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_request_dtls`
--

CREATE TABLE `service_request_dtls` (
  `service_requested_id` int(10) NOT NULL,
  `pregnancy_status` text NOT NULL,
  `speciality` text NOT NULL,
  `procedure_id` int(10) NOT NULL,
  `procedure_name` varchar(100) NOT NULL,
  `urgency` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinytext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `username`, `password`, `user_type`, `status`) VALUES
(1, 'Andray', 'andrayo@catchakiwi.co.nz', 'admin', 'andray', 'admin', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_booking_form`
--
ALTER TABLE `appointment_booking_form`
  ADD PRIMARY KEY (`booking_form_id`);

--
-- Indexes for table `brief_clinical_dtls`
--
ALTER TABLE `brief_clinical_dtls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funding`
--
ALTER TABLE `funding`
  ADD PRIMARY KEY (`funding_id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `procedure_tbl`
--
ALTER TABLE `procedure_tbl`
  ADD PRIMARY KEY (`procedure_id`);

--
-- Indexes for table `referral_to_details`
--
ALTER TABLE `referral_to_details`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `ref_doctor_details`
--
ALTER TABLE `ref_doctor_details`
  ADD PRIMARY KEY (`ref_doctor_id`);

--
-- Indexes for table `service_request_dtls`
--
ALTER TABLE `service_request_dtls`
  ADD PRIMARY KEY (`service_requested_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brief_clinical_dtls`
--
ALTER TABLE `brief_clinical_dtls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funding`
--
ALTER TABLE `funding`
  MODIFY `funding_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procedure_tbl`
--
ALTER TABLE `procedure_tbl`
  MODIFY `procedure_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_doctor_details`
--
ALTER TABLE `ref_doctor_details`
  MODIFY `ref_doctor_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
