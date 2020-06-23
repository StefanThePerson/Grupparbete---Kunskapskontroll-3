-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 23 jun 2020 kl 11:53
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
  `title` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(9) NOT NULL,
  `img_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img_url`) VALUES
(6, 'Crispy Bacon & Sourcream', 'Crispy potato chips that have been flavoured with seasoning of bacon and sourcream.', 29, 'img/crispybacon&sourcream.png'),
(7, 'Dill & Chives', 'These fluted potato chips have been seasoned with dill and chives to make that pleasant earth taste just that much more intense.', 29, 'img/dill&graslok.jpg'),
(8, 'Grill', 'Perfect for a BBQ, these potato chips just scream of the grilled meats and vegetables of summer.', 29, '../admin/img/grill.jpg'),
(9, 'Barbecue', 'I mean, c\'mon, it\'s potato chips that taste of BBQ.', 29, 'img/laysbbq.jpg'),
(10, 'Lentilchips Sourcream & Onion', 'These altenative chips are made of lentils and have been flavoured with sourcream & onion.', 29, 'img/linschips.jpg'),
(11, 'Popcorn', 'Roasted kernels of corn made into fluffy and crunchy snacks.', 29, 'img/popcorn.png'),
(12, 'Ranch', 'Fluted potato chips with an array of seasonings that have been voted for by the swedish people.', 29, 'img/ranch.jpg'),
(13, 'Sourcream & Onion', 'Slightly fluted potato chips with an intense flavour of sourcream and onion that just works.', 29, 'img/sourcream.jpg'),
(14, 'Kexchoklad', 'Stacked wafers with chocolate between each one and then covered with a layer of chocolate.', 14, 'img/kexchoklad.jpg'),
(15, 'Bubbly Milk Chocolate', 'A bar of milk chocolate with bubbles inside.', 14, 'img/marabou-bubblig-mj_lkchoklad-60g.jpg'),
(16, 'Apple', 'An apple a day keeps the doctor away.', 4, 'img/apple.png'),
(17, 'Banana', 'Perfect addition to an ice cream sundae.', 4, 'img/banana.jpg'),
(18, 'Orange', 'Nothing witty about these, they\'re just named after their colour. Or was it the other way around?', 4, 'img/orange.jpg'),
(20, 'Doritos Sourcream', 'Corn chips with sourcream flavouring', 29, 'img/doritos_sourcream_ny.jpg'),
(21, 'Doritos Nacho Cheese', 'Corn chips with nacho cheese flavouring.', 29, 'img/doritos-nacho-cheese-1.png'),
(22, 'Doritos Sweet Chili Pepper', 'Corn chips with sweet chili pepper flavouring.', 29, 'img/doritossweetchilipepper.png'),
(23, 'Doritos Thai Sweet Chili', 'Corn chips with sweet chili flavouring from thailand.', 29, '../admin/img/doritosthaisweetchili.jpg'),
(24, 'Kitkat', 'Wafers with chocolate.', 14, 'img/kitkat.jpg'),
(25, 'Marabou Milk Chocolate', 'Simple milk chocolate.', 14, 'img/maraboumjolkchoklad.jpg'),
(26, 'Marabou Dark Chocolate', 'Simple dark chocolate.', 14, 'img/marabou-morkchoklad.jpg'),
(27, 'Almonds', 'Nuts, get your nuts here!', 14, 'img/mandlar.png');

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
  `img_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `img_url`, `register_date`) VALUES
(14, 'Michael', 'doe', 'johndoe@fakemail.notreal', '$2y$10$HzALmg83KpA99n8.5sl7ruRILdlqGH6X3CtPWkNU5St/YVj9X2rEG', '123456789', 'Manganvägen 2', '18746', 'Täby', 'Sverige', NULL, '2020-06-23 10:12:11');

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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
