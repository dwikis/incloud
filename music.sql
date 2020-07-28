-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 08:51 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_song` int(11) NOT NULL,
  `view` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `id_user`, `id_song`, `view`) VALUES
(4, 8, 1, 2),
(5, 8, 8, 1),
(6, 8, 5, 1),
(7, 9, 7, 1),
(8, 9, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `warna` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `nama`, `warna`) VALUES
(1, 'metal', '#150733'),
(2, 'pop', '#06471c'),
(3, 'rock', '#472d06'),
(4, 'dangdut', '#21a398'),
(5, 'jazz', '#9aa112'),
(6, 'hiphop', '#4f11a6'),
(7, 'EDM', '#e012a6'),
(8, 'clasic', '#8f0a69'),
(9, 'kpop', '#6593a8'),
(10, 'jpop', '#733a31');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `artist` varchar(250) NOT NULL,
  `song_name` varchar(250) NOT NULL,
  `genre` varchar(250) NOT NULL,
  `warna` varchar(250) NOT NULL,
  `song_address` varchar(250) NOT NULL,
  `song_image` varchar(250) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `id_user`, `artist`, `song_name`, `genre`, `warna`, `song_address`, `song_image`, `view`, `created_at`) VALUES
(1, 8, 'megadeth', 'symphony of destruction', 'metal', '#150733', 'Assets/webPlayerAssets/songs/Megadeth - Symphony of Destruction.mp3', 'Assets/landingAssets/aaaaa.png', 4, '2020-07-25 13:23:00'),
(3, 8, 'megadeth', 'holy wars', 'metal', '#150733', 'Assets/webPlayerAssets/songs/Megadeth - Holy Wars!! The Punishment Due.mp3', 'Assets/landingAssets/aaaaa.png', 1, '2020-07-25 13:44:58'),
(4, 8, 'megadeth', 'Tornado of Soul', 'metal', '#150733', 'Assets/webPlayerAssets/songs/Megadeth - Tornado of Souls.mp3', 'Assets/landingAssets/aaaaa.png', 1, '2020-07-25 13:49:23'),
(5, 8, 'red hot chilli papper', 'snow', 'rock', '#472d06', 'Assets/webPlayerAssets/songs/Red Hot Chili Peppers - Snow.mp3', 'Assets/landingAssets/89bc3c14aa2b4f250033ffcf5f322b2a553d9331.jpg', 7, '2020-07-25 13:57:39'),
(6, 8, 'red hot chilli papper', 'californication', 'rock', '#472d06', 'Assets/webPlayerAssets/songs/Red Hot Chilli Peppers - Californication.mp3', 'Assets/landingAssets/89bc3c14aa2b4f250033ffcf5f322b2a553d9331.jpg', 3, '2020-07-25 14:06:43'),
(7, 8, 'Metallica', 'master of puppets', 'metal', '#150733', 'Assets/webPlayerAssets/songs/Metallica - Master Of Puppets.mp3', 'Assets/landingAssets/mofp.jpg', 3, '2020-07-25 14:14:20'),
(8, 8, 'Lisa', 'Adamas', 'jpop', '#733a31', 'Assets/webPlayerAssets/songs/LiSA - Adamas.mp3', 'Assets/landingAssets/1358267567-lisagirlsd-o.png', 1, '2020-07-25 15:59:40'),
(9, 8, 'Lisa', 'gurenge', 'jpop', '#733a31', 'Assets/webPlayerAssets/songs/LiSA - Gurenge.mp3', 'Assets/landingAssets/1358267567-lisagirlsd-o.png', 0, '2020-07-25 16:00:20'),
(10, 8, 'Lisa', 'Nameless Story', 'jpop', '#733a31', 'Assets/webPlayerAssets/songs/Nameless Story.mp3', 'Assets/landingAssets/1358267567-lisagirlsd-o.png', 0, '2020-07-25 16:57:43'),
(11, 9, 'eminem', 'Mocking Bird', 'hiphop', '#4f11a6', 'Assets/webPlayerAssets/songs/Eminem - Mockingbird.mp3', 'Assets/landingAssets/eminem.jpg', 0, '2020-07-25 17:01:27'),
(12, 9, 'eminem', 'Rap God', 'hiphop', '#4f11a6', 'Assets/webPlayerAssets/songs/Eminem - Rap God.mp3', 'Assets/landingAssets/eminem.jpg', 0, '2020-07-25 17:01:54'),
(13, 9, 'eminem', 'venom', 'hiphop', '#4f11a6', 'Assets/webPlayerAssets/songs/Eminem - Venom.mp3', 'Assets/landingAssets/eminem.jpg', 0, '2020-07-25 17:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `phone` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'Akang', 'akang@gmail.com', 'akang', 2147483647),
(3, 'ucup', 'ucup@yahoo.com', 'ucup', 2147483647),
(5, 'firman', 'firman@gmail.com', '12345', 1234567890),
(6, 'dwiki', 'dwiki@gmail.com', 'admin', 987654321),
(7, 'coba12345', 'qweerv@gmail.com', '123456', 123345),
(8, 'ucup', 'andrenuryana@gmail.com', 'naruto654321', 2147483647),
(9, 'TEST', 'test@gmail.com', 'test123', 341413431),
(11, 'dwiki', 'bmokerz@gmail.com', '123', 224141);

-- --------------------------------------------------------

--
-- Table structure for table `user_playlist`
--

CREATE TABLE `user_playlist` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`email`,`phone`);

--
-- Indexes for table `user_playlist`
--
ALTER TABLE `user_playlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_playlist`
--
ALTER TABLE `user_playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
