-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2022 at 05:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fun_olympics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_gallery`
--

CREATE TABLE `admin_gallery` (
  `imgId` int(11) NOT NULL,
  `img_Title` varchar(255) NOT NULL,
  `img_Path` varchar(255) NOT NULL,
  `upload_Date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_gallery`
--

INSERT INTO `admin_gallery` (`imgId`, `img_Title`, `img_Path`, `upload_Date`) VALUES
(27, 'Olympic Flag', '1666228772download.jpg', '2022-10-20'),
(28, 'Olympic Flag', '1666229852download.png', '2022-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`) VALUES
(17, 'Olympics'),
(18, 'Cricket'),
(21, 'Tennis'),
(22, 'Football');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `video_id`, `comment`, `date`, `time`) VALUES
(22, 19, 2, 'cool live', '2022-10-18', '01:13:20pm'),
(23, 18, 2, 'hi from admin', '2022-10-18', '01:14:13pm'),
(25, 26, 35, 'Nice video...', '2022-10-20', '05:39:50am'),
(26, 27, 35, 'Nice Video...', '2022-10-20', '06:58:25am'),
(27, 27, 4, 'Nice live Video', '2022-10-20', '06:58:55am'),
(28, 28, 35, 'Commented', '2022-10-20', '07:17:02am'),
(29, 28, 4, 'Live commented', '2022-10-20', '07:17:22am'),
(30, 24, 8, 'comment', '2022-10-20', '07:21:52am');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `fixId` int(11) NOT NULL,
  `fixtures` varchar(255) NOT NULL,
  `fixture_date` varchar(255) NOT NULL,
  `fixture_time` varchar(255) NOT NULL,
  `fixture_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`fixId`, `fixtures`, `fixture_date`, `fixture_time`, `fixture_category`) VALUES
(13, 'Nepal Vs India', '2022-10-27', '13:00', 'Swimming'),
(14, 'Tenish All Nation', '2022-10-31', '16:00', 'Tennis'),
(15, 'Final Match of Football', '2022-10-25', '16:05', 'Football');

-- --------------------------------------------------------

--
-- Table structure for table `livevideo`
--

CREATE TABLE `livevideo` (
  `liveVideoId` int(11) NOT NULL,
  `vTitle` varchar(255) NOT NULL,
  `vDescription` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `vCategory` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `livevideo`
--

INSERT INTO `livevideo` (`liveVideoId`, `vTitle`, `vDescription`, `url`, `date`, `vCategory`) VALUES
(4, 'BAN VS SA', ' Bangladesh vs South Africa 2022 Live \r\n\r\nIntresting Match...', 'https://www.youtube.com/embed/U8iakTICTYE?autoplay=1&mute=1', '2022-10-19', 'Cricket'),
(8, 'Live Sports', 'This is live...', 'https://www.youtube.com/embed/zOz_nrkIgos\" title=\"YouTube video player\" frameborder=\"0?autoplay=1&mute=1', '2022-10-20', 'Olympics');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `nDescription` varchar(255) NOT NULL,
  `nTitle` varchar(255) NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `new_thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `date`, `nDescription`, `nTitle`, `category_title`, `new_thumbnail`) VALUES
(16, '2022-10-04', 'In a semi final match nepal was able to defeat india by 3 goals.', 'Nepal Defeated India', 'Football', '1666167596mqdefault.jpg'),
(17, '2022-10-18', 'The Korean official revealed that the KSOC was looking at either Seoul or Busan as its preferred host city candidate, while Seoul Mayor Oh Se-hoo is reportedly set to meet with International Olympic Committee (IOC).', 'Exclusive: South Korea ponders 2036 Olympics bid.', 'Olympics', '1666168094Seoul+Olympic+Stadium+credit+ITG.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_request`
--

CREATE TABLE `password_reset_request` (
  `prrid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `requested_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `rfid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`rfid`, `uid`, `vid`) VALUES
(4, 18, 2),
(5, 22, 2),
(6, 23, 2),
(7, 23, 4),
(8, 26, 2),
(9, 27, 4),
(10, 24, 7),
(11, 28, 4),
(12, 24, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(256) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `profile_image`, `country`, `password`, `status`, `role`, `date`) VALUES
(24, 'Anil Thapa', 'thapaanil04@gmail.com', '1666174336pp.jpg', 'Nepal', '$2y$12$1uTwjPP52MQqG3T2WimEUOXfCz/t3ppuuQykIRjWNaMbMeyMaY5P2', 'unblocked', 'admin', '19-10-2022'),
(25, 'Parbat Banjara', 'banzaraparbat@gmail.com', '16661748351946429.png', 'Sweden', '$2y$12$JSg87nJvLJ8bFmjBH43Lhehch6EgsnN5QYD2nNVYHlH8n8eBWBFdS', 'unblocked', 'user', '19-10-2022'),
(28, 'Tulasi Prasad Thapa', 'tulasiprasadthapa@gmail.com', '16662295531946429.png', 'Nepal', '$2y$12$Wp7uG0Y//WglM4nTxF1qOuM1D7cTHly8LP4VJnwx48Zu0IfKzROi2', 'unblocked', 'user', '20-10-2022');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `vTitle` varchar(255) NOT NULL,
  `vDescription` varchar(2000) NOT NULL,
  `vPath` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `vCategory` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `vTitle`, `vDescription`, `vPath`, `date`, `vCategory`) VALUES
(35, 'James Bond and The Queen London 2012 Performance', ' Daniel Craig reprises his role as British secret agent James Bond as he accompanies Her Majesty The Queen to the opening ceremony of the London 2012 Olympic Games.', '1666176778James Bond and The Queen London 2012 Performance.mp4', '2022-10-19', 'Olympics'),
(37, 'Mr. Bean Live Performance ', 'Edit ', '1666229761Mr. Bean.mp4', '2022-10-20', 'Olympics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_gallery`
--
ALTER TABLE `admin_gallery`
  ADD PRIMARY KEY (`imgId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`fixId`);

--
-- Indexes for table `livevideo`
--
ALTER TABLE `livevideo`
  ADD PRIMARY KEY (`liveVideoId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `password_reset_request`
--
ALTER TABLE `password_reset_request`
  ADD PRIMARY KEY (`prrid`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`rfid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_gallery`
--
ALTER TABLE `admin_gallery`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `fixId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `livevideo`
--
ALTER TABLE `livevideo`
  MODIFY `liveVideoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `password_reset_request`
--
ALTER TABLE `password_reset_request`
  MODIFY `prrid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rating_info`
--
ALTER TABLE `rating_info`
  MODIFY `rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
