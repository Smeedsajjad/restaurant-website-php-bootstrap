-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 08:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT './uploads/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `token`, `login_time`, `image`) VALUES
(1, 'admin', '$2y$10$gdlh4MEiwNQt4RTk5mSFDeZY2g.WChLAFIqpmRoyFVpkI90lMaqe2', NULL, NULL, './uploads/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `billingdetails`
--

CREATE TABLE `billingdetails` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `county` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billingdetails`
--

INSERT INTO `billingdetails` (`id`, `firstName`, `lastName`, `country`, `county`, `address`, `address2`, `city`, `postcode`, `phone`, `email`, `notes`, `created_at`) VALUES
(3, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', 'Please! knock at the door.', '2024-11-21 17:27:33'),
(4, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-11-21 18:44:15'),
(5, 'Ahad', 'Shaka', 'pakistan', '', 'Defense , St-9', '', 'Jaranwala ', '37250', '12345678912', 'ahad@gmail.com', 'Kia hal hy bhai ?', '2024-11-21 18:52:08'),
(6, 'Ahad', 'Shaka', 'pakistan', '', 'Defense , St-9', '', 'Jaranwala', '37250', '12345678912', 'ahad@gmail.com', '', '2024-11-21 18:58:14'),
(7, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:07:01'),
(8, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:07:01'),
(9, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:09:02'),
(10, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:09:02'),
(11, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:13:29'),
(12, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:13:29'),
(13, 'Ahad', 'Shaka', 'pakistan', '', 'Defense , St-9', '', 'Jaranwala', '37250', '12345678912', 'ahad@gmail.com', '', '2024-12-10 17:14:54'),
(14, 'Ahad', 'Shaka', 'pakistan', '', 'Defense , St-9', '', 'Jaranwala', '37250', '12345678912', 'ahad@gmail.com', '', '2024-12-10 17:14:55'),
(15, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:15:37'),
(16, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:15:37'),
(17, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:17:04'),
(18, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:17:04'),
(19, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:18:07'),
(20, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:18:07'),
(21, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:20:00'),
(22, 'Sameed', 'Sajjad', 'pakistan', '', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:20:00'),
(23, 'Sameed', 'Sajjad', 'pakistan', 'Pakistan ', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:24:06'),
(24, 'Sameed', 'Sajjad', 'pakistan', 'Pakistan ', 'Municipal Colony', 'P-32', 'Jaranwala', '37250', '03278545411', 'sameedsajjad@gmail.com', '', '2024-12-10 17:24:06'),
(25, 'Ahad', 'Shaka', 'pakistan', '', 'Defense , St-9', '', 'Jaranwala', '37250', '12345678912', 'ahad@gmail.com', '', '2024-12-10 17:28:39'),
(26, 'Ahad', 'Shaka', 'pakistan', '', 'Defense , St-9', '', 'Jaranwala', '37250', '12345678912', 'ahad@gmail.com', '', '2024-12-10 17:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `user_id`) VALUES
(29, 3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `cat_name`, `cat_img`, `created_at`) VALUES
(1, 'Pizza', './uploads/categories/category-3.png', '2024-10-27 17:12:57'),
(2, 'Burger', './uploads/categories/category5.png', '2024-10-28 16:31:51'),
(3, 'Drinks', './uploads/categories/category-9.png', '2024-11-10 17:01:08'),
(6, 'Pasta', './uploads/categories/pasta.webp', '2024-11-11 20:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `billing_id`, `payment_method`, `order_status`, `total_amount`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 'on', 'pending', 22.62, '2024-11-21 17:27:33', '2024-11-22 21:52:13'),
(4, 2, 4, 'on', 'cancelled', 12.18, '2024-11-21 18:44:15', '2024-11-24 23:32:40'),
(5, 4, 5, 'on', 'completed', 12.18, '2024-11-21 18:52:08', '2024-11-24 23:32:34'),
(6, 4, 6, 'on', 'completed', 11.20, '2024-11-21 18:58:14', '2024-12-10 23:38:39'),
(9, 2, 9, 'bank-transfer', 'pending', 12.18, '2024-12-10 17:09:02', '2024-12-10 22:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 3, 10, 1, 11.20),
(2, 3, 8, 1, 11.42),
(3, 4, 2, 1, 12.18),
(4, 5, 2, 1, 12.18),
(5, 6, 10, 1, 11.20),
(6, 9, 2, 1, 12.18);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `desc` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `tagline`, `desc`, `category_id`, `ingredients`, `images`, `price`, `is_available`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Apricot Chicken', 'Crispy bacon, tasty ham, pineapple, onion and stretchy mozzarella, finished with a BBQ swirl.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 1, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/671fbd6503d1a_Apricot_Chicken.png', 22.30, 1, NULL, '2024-10-28 12:35:49', '2024-11-12 00:11:36'),
(2, 'Trio Cafe', 'Trio Cafe is Family owned establishment located in Boston Waterfront next to World Trade Center.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 3, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/6730e7d324df4_50-1.png', 12.18, 1, NULL, '2024-11-10 13:05:23', '2024-11-10 22:27:29'),
(3, 'Bacon Burger', 'A mighty meaty double helping of all the reasons you love our burger.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 2, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/6732641b7749b_Bacon.png', 10.95, 1, NULL, '2024-11-11 16:07:55', '2024-11-11 21:07:55'),
(4, 'Chicken Burger', 'A mighty meaty double helping of all the reasons you love our burger.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 2, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/6732660298231_Chicken.png', 16.75, 1, NULL, '2024-11-11 16:16:02', '2024-11-11 21:16:02'),
(5, 'BBQ chicken breast', 'A mighty meaty double helping of all the reasons you love our burger.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 6, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/6732665715c82_BBQ.png', 8.00, 1, NULL, '2024-11-11 16:17:27', '2024-11-11 21:17:27'),
(6, 'Tagliatelle Molto', 'A mighty meaty double helping of all the reasons you love our burger.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 6, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/673266aae7190_TagliatelleMolto.png', 15.16, 1, NULL, '2024-11-11 16:18:50', '2024-11-11 21:18:50'),
(7, 'Chicken Hawaii', 'Extra-virgin olive oil, mozzarella cheese, thinly-sliced steak meat, garlic, green peppers, mushrooms and tomatoes', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 1, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/67326739e321d_Haxaii.png', 14.49, 1, NULL, '2024-11-11 16:21:13', '2024-11-11 21:21:13'),
(8, 'Grand Italiano', 'Quisque pretium turpis non tempus cursus. Nulla consequat, mi nec pellentesque imperdiet, mi quam congue magna, tristique commodo.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 1, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/67326882c623c_grans.png', 11.42, 1, NULL, '2024-11-11 16:26:42', '2024-11-11 21:26:42'),
(9, 'Hawaii Vegetarian Pizza', 'Mouth watering pepperoni, cabanossi, mushroom, capsicum, black olives and stretchy mozzarella, seasoned with garlic and oregano.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 1, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/673268daa7bc3_veg.png', 18.00, 1, NULL, '2024-11-11 16:28:10', '2024-11-11 21:28:10'),
(10, 'Country Burger', 'A mighty meaty double helping of all the reasons you love our burger.', 'Although the legendary Double Burger really needs no introduction, please allow us… Tucked in between three soft buns are two all-beef patties, cheddar cheese, ketchup, onion, pickles and iceberg lettuce. Hesburger’s own paprika and cucumber mayonnaise add the crowning touch. Oh baby!', 2, 'Dr.Praeger’sBlackBeanBurger,Focacciabun,BalsamicVinaigrette,Pesto,Tomato,SwissCheese', 'uploads/products/6732695061068_country.png', 11.20, 1, NULL, '2024-11-11 16:30:08', '2024-11-11 21:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `name`, `email`, `rating`, `review`, `created_at`) VALUES
(2, 6, 'Sameed', 'sameedsajjad@gmail.com', 2, 'Testing', '2024-12-08 15:52:53'),
(3, 6, 'ahad', 'ahad@gmail.com', 3, 'test 2', '2024-12-08 15:53:47'),
(4, 6, 'chalo', 'test@email.com', 3, 'test 3', '2024-12-08 15:57:12'),
(5, 6, 'example', 'jhon@example.com', 3, 'test', '2024-12-08 16:34:43'),
(6, 6, 'jdngfjksgn', 'nfj@kdnfksd', 3, 'fnjsk', '2024-12-08 16:34:57'),
(7, 6, 'htthjrf', 'hrth@fhb', 1, 'fsgfhrgr rthrt', '2024-12-08 16:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Rehman', '$2y$10$N1g8LHsR8NWXP80F17wnmO8H8N4/SFNQCOA5Al/KL9ftcLndTuE3S', 'example@gmail.com', 'Rehman Anjum', '78945612312', '2024-11-12 19:47:16', '2024-11-12 19:47:16'),
(2, 'Sameed', '$2y$10$57m/LfSHfyci7Vw2BE2Esu6APTAyxeljH1JXTc5xgsUQ/hk1fUunO', 'sameedsajjad@gmail.com', 'Sameed Sajjad', '03278545411', '2024-11-12 19:47:50', '2024-11-12 19:47:50'),
(3, 'nuzba@gmail.com', '$2y$10$fyCCfRft1i1E6i3X/PQZkev4WnmOGBeuGVjCQuGwCO/QgrSjQtjsO', 'nuzba@gmail.com', 'Nuzba Sajjad', '12345678912', '2024-11-12 19:48:06', '2024-11-12 19:48:06'),
(4, 'Ahad', '$2y$10$S7d2RoQ.VHQ7g2USy9NgYe/m3IOaatk9aujXCzAylKYwDBqf6FMLe', 'ahad@gmail.com', 'Ahad', '12345678912', '2024-11-12 20:17:50', '2024-11-12 20:17:50'),
(5, 'Bilal', '$2y$10$AsA/GDMLvwwkUrkSFC1SiOwc1CO43bSMnp/dlHb/kmvICZ1xvN10G', 'bilal@gmail.com', 'Bilal Khalid', '12345678912', '2024-11-12 20:24:05', '2024-11-12 20:24:05'),
(6, 'example', '$2y$10$Obsu1BJtW8FnoDRJQPB6necYidSEvIE2YL7KUitspeziuQIBfY92.', 'example2@gmail.com', 'example', '12345678912', '2024-11-12 20:38:29', '2024-11-12 20:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billingdetails`
--
ALTER TABLE `billingdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_id` (`billing_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billingdetails`
--
ALTER TABLE `billingdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`billing_id`) REFERENCES `billingdetails` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
