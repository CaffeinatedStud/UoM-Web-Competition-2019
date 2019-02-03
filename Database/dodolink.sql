-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2019 at 09:28 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dodolink`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyname` varchar(100) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `establishmentdate` date NOT NULL,
  `websiteurl` varchar(70) NOT NULL,
  `location` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyname`, `sector`, `establishmentdate`, `websiteurl`, `location`, `email`) VALUES
('Accenture', 'Finance', '1995-01-31', 'wwww.accenture.com', 'Ebene', ''),
('alice', 'AI', '0000-00-00', 'alice.com', 'Ebene', 'alice@gmail.com'),
('ITSOLVZ', 'IT', '2000-01-11', 'wwww.itsolvz.com', 'Quatre Bornes', ''),
('OceanProtect', 'Oceanic stdudy', '2005-01-11', 'wwww.oceanprotect.com', 'Grand-Gaube', ''),
('PWC', 'Finance', '1996-01-31', 'wwww.pwc.com', 'Ebene', '');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `username` varchar(30) NOT NULL,
  `degreename` varchar(50) NOT NULL,
  `major` varchar(50) NOT NULL,
  `university` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`username`, `degreename`, `major`, `university`, `startdate`, `enddate`) VALUES
('humairaa', 'Oceangraphy', '', 'University of Mauritius', '2015-01-15', '2018-01-02'),
('kaneki', 'English Literature', 'English', 'UoM', '0000-00-00', '0000-00-00'),
('shahanah', 'Computer Science', '', 'University of Banglore', '2015-01-15', '2018-01-02'),
('wardah', 'Finance Minor Law', '', 'University of Cape Town', '2010-01-16', '2013-01-17'),
('yash', 'Computer Science', '', 'University of Technology', '2013-01-16', '2016-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accounttype` enum('admin','normal','company') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `accounttype`) VALUES
('accenture', 'accenture', 'company'),
('alice', 'alice', 'company'),
('humairaa', 'humairaa', 'normal'),
('itsolvz', 'itsolvz', 'company'),
('kaneki', 'kaneki', 'normal'),
('oceanprotect', 'oceanprotect', 'company'),
('pwc', 'pwc', 'company'),
('shahanah', 'shahanah', 'normal'),
('wardah', 'wardah', 'admin'),
('yash', 'yash', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `posttext` varchar(500) NOT NULL,
  `dateposted` date NOT NULL,
  `category` enum('IT','Finance','Accounts','Human Resource','Engineering','Oceanic Study') DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `reportcount` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `posttext`, `dateposted`, `category`, `username`, `reportcount`) VALUES
(1, 'Hello, i am currently looking for an internship in SQL...', '2019-01-08', 'IT', 'yash', 0),
(2, 'Hello, i would like to know the job opportunities a finance graduate has.', '2019-01-09', 'Finance', 'wardah', 0),
(3, 'Hello, any beaches to protest?', '2019-01-08', 'Oceanic Study', 'humairaa', 0),
(4, 'Hello, carry on with the website', '2019-01-15', 'IT', 'yash', 0),
(5, 'I would like to find finance related job opportunities.', '2019-01-30', 'Finance', 'shahanah', 0),
(6, 'Hello, can i get list of companies which are accounts relaed?', '2019-01-31', 'Accounts', 'humairaa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) CHARACTER SET utf32 NOT NULL,
  `othernames` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `interest` varchar(255) NOT NULL,
  `skill set` varchar(100) DEFAULT NULL,
  `report` smallint(6) DEFAULT NULL,
  `ban` tinyint(1) DEFAULT NULL,
  `sector` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `othernames`, `lastname`, `email`, `dob`, `interest`, `skill set`, `report`, `ban`, `sector`, `description`) VALUES
('humairaa', 'Humairaa', 'Joomun', 'humairaa@gmail.com', '1998-04-07', 'aquatic nature presevation', NULL, NULL, NULL, 'Oceanic Study', ''),
('kaneki', 'Kaneki', 'Ken', 'kaneki@gmail.com', '1997-04-26', 'Literature', NULL, NULL, NULL, '', ''),
('shahanah', 'Shahanah', 'Puttaroo', 'shahanah@gmail.com', '1998-04-23', 'scripting', NULL, NULL, NULL, 'IT', ''),
('wardah', 'Wardah', 'Ajubtally', 'wardah@gmail.com', '1998-10-21', 'debates', NULL, NULL, NULL, 'Finance', ''),
('yash', 'Yash', 'Persand', 'yash@gmail.com', '1998-02-13', 'coding', NULL, NULL, NULL, 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `vacancyid` int(11) NOT NULL,
  `vacancydescription` varchar(1000) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `targetqualification` varchar(100) NOT NULL,
  `companyname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`vacancyid`, `vacancydescription`, `sector`, `targetqualification`, `companyname`) VALUES
(1, 'Looking for a web developer.', 'IT', 'Computer Science', 'ITSOLVZ'),
(2, 'We are looking for certified accountants and junior accountants.', 'Accounts', 'Accounts', 'PWC'),
(3, 'We are offering placements for undergraduates.', 'Ocean', 'Oceangraphy', 'OceanProtect'),
(4, 'Financial officer needed urgently. contact us as soon as possible.', 'Fianance', 'Finance', 'Accenture'),
(6, 'Vancancy for clerks and IT project manager.', 'IT', 'Computer Science', 'Accenture');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyname`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`vacancyid`),
  ADD KEY `vacancies_ibfk_1` (`companyname`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD CONSTRAINT `vacancies_ibfk_1` FOREIGN KEY (`companyname`) REFERENCES `company` (`companyname`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
