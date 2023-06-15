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
('Apple', '0', 1.50, '/images/apple.png'),
('Banana', '1', 1.20, '/images/banana.png'),
('Cherry', '2', 1.70, '/images/cherry.png'),
('Strawberry', '3', 3.50, '/images/strawberry.png'),
('Watermelon', '4', 2.50, '/images/watermelon.png'),
('Grape', '5', 2.50, '/images/grape.png'),
('Lemon', '6', 2.00, '/images/lemon.png'),
('Peach', '7', 2.50, '/images/peach.png');