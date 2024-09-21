-- Create the database
CREATE DATABASE restaurant_db;
USE restaurant_db;

-- Create the users table
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `role` ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the categories table
CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the menu_items table
CREATE TABLE `menu_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10, 2) NOT NULL,
    `image` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
);

-- Create the orders table
CREATE TABLE `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('pending', 'completed', 'canceled') NOT NULL DEFAULT 'pending',
    `total_amount` DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Create the order_items table
CREATE TABLE `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT,
    `menu_item_id` INT,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items`(`id`) ON DELETE CASCADE
);

-- Create the reservations table
CREATE TABLE `reservations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `reservation_date` DATE NOT NULL,
    `reservation_time` TIME NOT NULL,
    `number_of_guests` INT NOT NULL,
    `status` ENUM('pending', 'confirmed', 'canceled') NOT NULL DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Create the reviews table
CREATE TABLE `reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `menu_item_id` INT,
    `rating` INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    `comment` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items`(`id`) ON DELETE CASCADE
);

-- Create the payments table
CREATE TABLE `payments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT,
    `payment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `amount` DECIMAL(10, 2) NOT NULL,
    `payment_method` ENUM('credit_card', 'paypal', 'cash') NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
);
