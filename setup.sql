-- CREATE DATABASE web;

-- USE web;

-- CREATE USER 'admin'@'%' IDENTIFIED BY 'admin123';

-- GRANT ALL PRIVILEGES ON web.* TO 'admin'@'localhost';

USE web;

CREATE TABLE IF NOT EXISTS `products` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`name` varchar(250) NOT NULL,
`code` varchar(100) NOT NULL,
`price` double(9,2) NOT NULL,
`image` varchar(250) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`name`, `code`, `price`, `image`) VALUES
('Apple', '0', 1.50, 'images/Apple.png'),
('Banana', '1', 1.20, 'images/Banana.png'),
('Cherry', '2', 1.70, 'images/Cherry.png'),
('Strawberry', '3', 3.50, 'images/Strawberry.png'),
('Watermelon', '4', 2.50, 'images/Watermelon.png'),
('Grape', '5', 2.50, 'images/Grape.png'),
('Lemon', '6', 2.00, 'images/Lemon.png'),
('Peach', '7', 2.50, 'images/Peach.png');