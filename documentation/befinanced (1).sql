-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2020 at 06:38 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `befinanced`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_number` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_answer`
--

CREATE TABLE `credit_answer` (
  `id` int(11) NOT NULL,
  `credit_application_id` int(11) DEFAULT NULL,
  `financial_institution_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `credit_answer_informations_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_answer_informations`
--

CREATE TABLE `credit_answer_informations` (
  `id` int(11) NOT NULL,
  `amount_money_approved` int(11) DEFAULT NULL,
  `repayment_period_approved` int(11) DEFAULT NULL,
  `message` text,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_application`
--

CREATE TABLE `credit_application` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `credit_type_id` int(11) DEFAULT NULL,
  `credit_application_informations_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_application_financial_institution`
--

CREATE TABLE `credit_application_financial_institution` (
  `credit_application_id` int(11) NOT NULL,
  `financial_institution_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_application_informations`
--

CREATE TABLE `credit_application_informations` (
  `id` int(11) NOT NULL,
  `amount_money_requested` int(11) DEFAULT NULL,
  `repayment_period_requested` int(11) DEFAULT NULL,
  `message` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_documents`
--

CREATE TABLE `credit_documents` (
  `id` int(11) NOT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `path` varchar(155) DEFAULT NULL,
  `credit_application_id` int(11) DEFAULT NULL,
  `credit_answer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uploader_ip` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_type`
--

CREATE TABLE `credit_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_institution`
--

CREATE TABLE `financial_institution` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `financial_institution_legal_informations_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_institution_legal_informations`
--

CREATE TABLE `financial_institution_legal_informations` (
  `id` int(11) NOT NULL,
  `legal_entity_identifier` varchar(100) DEFAULT NULL,
  `chamber_commerce_registration_number` varchar(100) DEFAULT NULL,
  `iban` varchar(155) DEFAULT NULL,
  `entity_primary_bank_name` varchar(155) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_profile_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `financial_institution_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  `nin` varchar(45) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_answer`
--
ALTER TABLE `credit_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ANSWER_APPLICATION_idx` (`credit_application_id`),
  ADD KEY `FK_ANSWER_FINANCIAL_INST_idx` (`financial_institution_id`),
  ADD KEY `FK_ANSWER_INF_idx` (`credit_answer_informations_id`);

--
-- Indexes for table `credit_answer_informations`
--
ALTER TABLE `credit_answer_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_application`
--
ALTER TABLE `credit_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_APPLICATION_INFOS_idx` (`credit_application_informations_id`),
  ADD KEY `FK_APPLICATION_CREDITTYPE_idx` (`credit_type_id`),
  ADD KEY `FK_APPLICATION_CLIENT_idx` (`applicant_id`);

--
-- Indexes for table `credit_application_financial_institution`
--
ALTER TABLE `credit_application_financial_institution`
  ADD KEY `FK_PIVOT_CREDIT_APP_idx` (`credit_application_id`),
  ADD KEY `FK_PIVOT_FINANCIAL_INST_idx` (`financial_institution_id`);

--
-- Indexes for table `credit_application_informations`
--
ALTER TABLE `credit_application_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_documents`
--
ALTER TABLE `credit_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_DOC_CREDIT_APPLICATION_idx` (`credit_application_id`),
  ADD KEY `FK_DOC_CREDIT_ANSWER_idx` (`credit_answer_id`),
  ADD KEY `FK_DOC_USER_ID_idx` (`user_id`);

--
-- Indexes for table `credit_type`
--
ALTER TABLE `credit_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_institution`
--
ALTER TABLE `financial_institution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_INST_ADDRESS_idx` (`address_id`),
  ADD KEY `FK_INST_LEGAL_INF_idx` (`financial_institution_legal_informations_id`);

--
-- Indexes for table `financial_institution_legal_informations`
--
ALTER TABLE `financial_institution_legal_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_PROFILE_idx` (`user_profile_id`),
  ADD KEY `FK_USER_ROLE_idx` (`role_id`),
  ADD KEY `FK_FINANCIAL_INST_idx` (`financial_institution_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_PROFILE_ADDRESS_idx` (`address_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_answer`
--
ALTER TABLE `credit_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_answer_informations`
--
ALTER TABLE `credit_answer_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_application`
--
ALTER TABLE `credit_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_application_informations`
--
ALTER TABLE `credit_application_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_documents`
--
ALTER TABLE `credit_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_type`
--
ALTER TABLE `credit_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_institution`
--
ALTER TABLE `financial_institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_institution_legal_informations`
--
ALTER TABLE `financial_institution_legal_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credit_answer`
--
ALTER TABLE `credit_answer`
  ADD CONSTRAINT `FK_ANSWER_APPLICATION` FOREIGN KEY (`credit_application_id`) REFERENCES `credit_application` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ANSWER_FINANCIAL_INST` FOREIGN KEY (`financial_institution_id`) REFERENCES `financial_institution` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ANSWER_INF` FOREIGN KEY (`credit_answer_informations_id`) REFERENCES `credit_answer_informations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_application`
--
ALTER TABLE `credit_application`
  ADD CONSTRAINT `FK_APPLICATION_CLIENT` FOREIGN KEY (`applicant_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_APPLICATION_CREDITTYPE` FOREIGN KEY (`credit_type_id`) REFERENCES `credit_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_APPLICATION_INFOS` FOREIGN KEY (`credit_application_informations_id`) REFERENCES `credit_application_informations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_application_financial_institution`
--
ALTER TABLE `credit_application_financial_institution`
  ADD CONSTRAINT `FK_PIVOT_CREDIT_APP` FOREIGN KEY (`credit_application_id`) REFERENCES `credit_application` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_PIVOT_FINANCIAL_INST` FOREIGN KEY (`financial_institution_id`) REFERENCES `financial_institution` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit_documents`
--
ALTER TABLE `credit_documents`
  ADD CONSTRAINT `FK_DOC_CREDIT_ANSWER` FOREIGN KEY (`credit_answer_id`) REFERENCES `credit_answer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DOC_CREDIT_APPLICATION` FOREIGN KEY (`credit_application_id`) REFERENCES `credit_application` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DOC_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `financial_institution`
--
ALTER TABLE `financial_institution`
  ADD CONSTRAINT `FK_INST_ADDRESS` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_INST_LEGAL_INF` FOREIGN KEY (`financial_institution_legal_informations_id`) REFERENCES `financial_institution_legal_informations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_FINANCIAL_INST` FOREIGN KEY (`financial_institution_id`) REFERENCES `financial_institution` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_USER_PROFILE` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_USER_ROLE` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `FK_USER_PROFILE_ADDRESS` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
