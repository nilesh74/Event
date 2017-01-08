-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2017 at 11:01 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `wwc_admin`
--

CREATE TABLE `wwc_admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=>admin',
  `status` tinyint(1) NOT NULL COMMENT '0=>inactive, 1=>active, 2=>deleted',
  `inserted_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_admin`
--

INSERT INTO `wwc_admin` (`id`, `fname`, `mname`, `lname`, `username`, `password`, `email`, `contact`, `profile_pic`, `type`, `status`, `inserted_on`, `updated_on`, `deleted_on`) VALUES
(1, 'Nilesh', 'Shantaram', 'Aher', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'ahernilesh74@gmail.com', '9975514352', '', 1, 1, '2015-08-31 11:45:00', '2017-01-05 16:38:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wwc_contact_us`
--

CREATE TABLE `wwc_contact_us` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=inactive ,1=active,2=delete',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_contact_us`
--

INSERT INTO `wwc_contact_us` (`contact_id`, `first_name`, `last_name`, `email`, `phone`, `comment`, `status`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 'Nilesh', 'Aher', 'ahernilesh74@gmail.com', 0, 'hi this is main think hi this is main think hi this is main think', 2, '2017-01-08 09:49:49', '2017-01-08 11:00:09', '2017-01-08 11:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `wwc_manage_category`
--

CREATE TABLE `wwc_manage_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>inactive, 1=>active, 2=>deleted',
  `meta_keywords` text,
  `meta_description` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_manage_category`
--

INSERT INTO `wwc_manage_category` (`cat_id`, `cat_name`, `cat_url`, `status`, `meta_keywords`, `meta_description`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 'Marriage', NULL, 1, NULL, NULL, '2015-09-07 15:52:04', '2017-01-05 18:08:16', NULL),
(2, 'Gathring', NULL, 1, NULL, NULL, '2015-09-07 15:52:14', '2017-01-05 18:09:06', NULL),
(3, 'Engagement', NULL, 1, NULL, NULL, '2015-09-07 15:52:30', '2017-01-05 18:09:23', NULL),
(4, 'FFF', NULL, 1, NULL, NULL, '2017-01-07 20:31:27', '2017-01-07 20:31:32', NULL),
(5, 'EVVVV', NULL, 1, NULL, NULL, '2017-01-07 20:31:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wwc_manage_event`
--

CREATE TABLE `wwc_manage_event` (
  `id` int(11) NOT NULL,
  `event_title` varchar(30) NOT NULL,
  `event_location` text NOT NULL,
  `event_image_path` varchar(100) NOT NULL,
  `event_email` varchar(50) NOT NULL,
  `event_contact` varchar(12) NOT NULL,
  `event_cost` int(11) DEFAULT '0',
  `event_organizer` varchar(100) DEFAULT NULL,
  `event_seats` int(11) DEFAULT '0',
  `event_venue` text,
  `cat_id` int(11) NOT NULL,
  `event_description` text NOT NULL,
  `event_startdate` varchar(20) NOT NULL,
  `event_enddate` varchar(20) NOT NULL,
  `event_time` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>inactive, 1=>active',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_manage_event`
--

INSERT INTO `wwc_manage_event` (`id`, `event_title`, `event_location`, `event_image_path`, `event_email`, `event_contact`, `event_cost`, `event_organizer`, `event_seats`, `event_venue`, `cat_id`, `event_description`, `event_startdate`, `event_enddate`, `event_time`, `status`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 'Sula Fest', 'Nashik', '', 'ahernilesh@gmail.com', '9987545645', 0, NULL, 0, NULL, 1, '<p>sdsdsdsdsdadad</p>', '10-01-2017', '18-01-2017', '23:15', 2, '2017-01-05 18:27:46', '2017-01-05 19:10:10', '2017-01-05 19:10:19'),
(2, 'Sula Fest', 'Nashik', '', 'ahernilesh@gmail.com', '9987545645', 0, NULL, 0, NULL, 1, '<p>sdsdsdsdsdadad</p>', '10-01-2017', '18-01-2017', '23:15', 2, '2017-01-05 18:28:59', '0000-00-00 00:00:00', '2017-01-05 19:10:25'),
(3, 'Dadad', 'Adad', '', 'dadasda@gmil.gf', '9987545645', 100, 'Rakesh Aher', 10, NULL, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>', '09-01-2017', '24-01-2017', '22:15', 1, '2017-01-05 18:30:20', '2017-01-08 06:30:54', '0000-00-00 00:00:00'),
(4, 'Sula Fest old', 'Nashik', '', 'ahernilesh434343@gmail.com', '434343434343', 1000, 'Rakesh Aher', 10, NULL, 1, '<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>\n\n<p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>\n\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>\n\n<p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>\n\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>\n\n<p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', '03-01-2017', '18-01-2017', '05:00', 1, '2017-01-05 18:49:30', '2017-01-07 16:25:24', '0000-00-00 00:00:00'),
(5, 'Sula Fest New', 'Mumbai', '', 'ahernilesh74@gmail.com', '9987545645', 0, NULL, 0, NULL, 2, '<p>sdsdsdsdsdadadfdfs</p>', '11-01-2017', '19-01-2017', '22:30', 1, '2017-01-05 18:58:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Happy New Year', 'Nashik', '', 'ahernilesh@gmail.com', '9982251133', 0, NULL, 0, NULL, 1, '<p>dsds</p>', '12-01-2017', '19-01-2017', '21:30', 1, '2017-01-06 16:20:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Sasa', 'Sasa', 'Event_586fb7840af37.jpg', 'sasa@gmai.com', '434343434', 0, NULL, 0, NULL, 1, '<p>sasas</p>', '11-01-2017', '18-01-2017', '22:00', 1, '2017-01-06 16:28:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Birthday Event of my Brother', 'Gangapur Road , Near Tulja Bhavani lawns, \r\nNashik - 400021', 'Event_5870f51b0055e.jpg', 'ahernilesh@gmail.com', '99090909099', 2000, 'Rakesh Aher', 200, NULL, 3, '<p>Its pleasuer to invite alll of you of my brother birthday .</p>\r\n\r\n<p>for give you well wishesh to her&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '08-01-2017', '08-01-2017', '20:00', 1, '2017-01-07 15:03:06', '2017-01-07 15:04:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wwc_manage_gallery`
--

CREATE TABLE `wwc_manage_gallery` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>inactive, 1=>active, 2=>deleted',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_manage_gallery`
--

INSERT INTO `wwc_manage_gallery` (`id`, `event_id`, `file_name`, `status`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 2, 'gallery_586e825b45707.jpg', 1, '2017-01-05 18:28:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, 'gallery_586e82ac94b32.jpg', 1, '2017-01-05 18:30:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'gallery_586e82ad3c15f.jpg', 1, '2017-01-05 18:30:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 3, 'gallery_586e82adb629b.jpg', 1, '2017-01-05 18:30:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wwc_manage_seat`
--

CREATE TABLE `wwc_manage_seat` (
  `seat_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `seat_book_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_manage_seat`
--

INSERT INTO `wwc_manage_seat` (`seat_id`, `user_id`, `event_id`, `seat_book_date`) VALUES
(1, 1, 3, '08-01-2017');

-- --------------------------------------------------------

--
-- Table structure for table `wwc_manage_subcategory`
--

CREATE TABLE `wwc_manage_subcategory` (
  `subcat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_name` varchar(255) NOT NULL,
  `subcat_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>inactive, 1=>active, 2=>deleted',
  `meta_keywords` text,
  `meta_description` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `deleted_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_manage_subcategory`
--

INSERT INTO `wwc_manage_subcategory` (`subcat_id`, `cat_id`, `subcat_name`, `subcat_url`, `status`, `meta_keywords`, `meta_description`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 1, 'Lumia', NULL, 1, NULL, NULL, '2015-09-07 15:52:41', NULL, '2015-09-07 18:48:02'),
(2, 1, '6600', NULL, 1, NULL, NULL, '2015-09-07 15:52:52', NULL, '2015-09-07 18:48:02'),
(3, 1, '3315', NULL, 1, NULL, NULL, '2015-09-07 15:53:02', NULL, '2015-09-07 18:48:02'),
(4, 2, 'MOTO G', NULL, 1, NULL, NULL, '2015-09-07 15:53:11', NULL, '2015-09-07 18:48:02'),
(5, 2, 'MOTO E', NULL, 1, NULL, NULL, '2015-09-07 15:53:18', NULL, '2015-09-07 18:48:02'),
(6, 2, 'MOTO X', NULL, 1, NULL, NULL, '2015-09-07 15:53:26', NULL, '2015-09-07 18:48:02'),
(7, 3, 'STAR', NULL, 1, NULL, NULL, '2015-09-07 15:53:35', NULL, '2015-09-07 18:48:02'),
(8, 3, 'CHAMP', NULL, 1, NULL, NULL, '2015-09-07 15:53:43', NULL, '2015-09-07 18:48:02'),
(9, 3, 'GALAXY', NULL, 1, NULL, NULL, '2015-09-07 15:53:51', NULL, '2015-09-07 18:48:02'),
(10, 1, '1110', NULL, 1, NULL, NULL, '2015-09-07 18:25:36', NULL, '2015-09-07 18:48:02'),
(11, 2, 'Moto g 2nd generation', NULL, 1, NULL, NULL, '2015-09-07 18:25:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wwc_manage_typograpohy`
--

CREATE TABLE `wwc_manage_typograpohy` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `already_exist` varchar(10) NOT NULL,
  `only_dropdown` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `textarea` text NOT NULL,
  `datepicker` varchar(20) NOT NULL,
  `datepicker_start` varchar(20) NOT NULL,
  `datepicker_end` varchar(20) NOT NULL,
  `timepicker` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>inactive, 1=>active',
  `accept_term` tinyint(1) NOT NULL COMMENT '1=>accept all terms and condition',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wwc_user`
--

CREATE TABLE `wwc_user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=inactive ,1=active,2=delete',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwc_user`
--

INSERT INTO `wwc_user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `status`, `created_on`, `updated_on`, `deleted_on`) VALUES
(1, 'NIlesh', 'Aher', 'bmlsMTIz', 'ahernilesh74@gmail.com', 1, '2017-01-07 19:24:40', '2017-01-08 10:37:33', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wwc_admin`
--
ALTER TABLE `wwc_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wwc_contact_us`
--
ALTER TABLE `wwc_contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `wwc_manage_category`
--
ALTER TABLE `wwc_manage_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `wwc_manage_event`
--
ALTER TABLE `wwc_manage_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wwc_manage_gallery`
--
ALTER TABLE `wwc_manage_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wwc_manage_seat`
--
ALTER TABLE `wwc_manage_seat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `wwc_manage_subcategory`
--
ALTER TABLE `wwc_manage_subcategory`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `wwc_manage_typograpohy`
--
ALTER TABLE `wwc_manage_typograpohy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wwc_user`
--
ALTER TABLE `wwc_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wwc_admin`
--
ALTER TABLE `wwc_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wwc_contact_us`
--
ALTER TABLE `wwc_contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wwc_manage_category`
--
ALTER TABLE `wwc_manage_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `wwc_manage_event`
--
ALTER TABLE `wwc_manage_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wwc_manage_gallery`
--
ALTER TABLE `wwc_manage_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wwc_manage_seat`
--
ALTER TABLE `wwc_manage_seat`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wwc_manage_subcategory`
--
ALTER TABLE `wwc_manage_subcategory`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `wwc_manage_typograpohy`
--
ALTER TABLE `wwc_manage_typograpohy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wwc_user`
--
ALTER TABLE `wwc_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
