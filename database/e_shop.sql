-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 04 jun 2020 kl 13:39
-- Serverversion: 8.0.18
-- PHP-version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `e_shop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(6) NOT NULL,
  `billing_full_name` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `billing_street` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `billing_postal_code` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `billing_city` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `billing_country` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `product_title` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(9) NOT NULL,
  `title` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `price` int(9) NOT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img_url`) VALUES
(1, 'Elephant', 'An elephant in 1:1 scale!', 250, '../admin/img/penguin.jpg'),
(2, 'Penguin', 'Penguin', 150, 'img/penguin.jpg'),
(3, 'Elephant', 'Mini Elephant', 100, 'img/elephant.jpg'),
(4, 'Dolphin', 'An intelligent fish.', 200, 'img/penguin.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(90) COLLATE utf8mb4_bin NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `register_date`) VALUES
(1, 'johnny', 'doe', 'johndoe@fakemail.notreal', '$2y$10$YI6c5i6LeNIXJn3vZGpx7OvPbS3A4H/uxZQABZaPbR9X9pr7fBJ5u', '123456789', 'notrealstreet 42', '12345', 'fakeville', 'madeupsia', '2020-05-22 09:57:31'),
(2, 'john', 'doe', 'johndoe@fakemail.notreal', 'badpassword', '123456789', 'notrealstreet 42', '12345', 'fakeville', 'madeupsia', '2020-05-22 10:58:57'),
(10, 'sbgfsgb', 'bsdbtd', 'bsfdntfb@vbdrfh.com', '$2y$10$siqhYfJnle4x2sqj53w..ePX7v7WTAM8ScsF8fusfALa/uhXuhARu', 'bfsbsgb', 'bsfnbf', 'b sfnfsbn', 'nbsfg n', 'gfxn fbn', '2020-05-27 12:37:14'),
(11, 'bvfdzzb', 'badz', 'bdzfbdz@rs.com', '$2y$10$ffHOMaqvOu5HedvQOt7mT.K43Gm8xuYsP7/ZM3Ew/SpaPnnl0rO7C', 'fzdb fdb dzf', 'zdfbz', 'bzgd ngfzn', 'ngznng', 'b zddgzngdnz', '2020-05-27 12:48:29');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
