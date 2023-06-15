USE web;

CREATE TABLE IF NOT EXISTS `products` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`name` varchar(250) NOT NULL,
`code` varchar(100) NOT NULL,
`price` double(9,2) NOT NULL,
`image` varchar(250) NOT NULL,
`description` varchar(255) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`name`, `code`, `price`, `image`, `description`) VALUES
('Apple', '0', 1.50, '/images/apple.png', 'Apples are delicious, crunchy fruits with a high fiber content. They come in a variety of colors including red, green, and yellow.'),
('Banana', '1', 1.20, '/images/banana.png', 'Bananas are tropical, elongated fruits with a sweet and creamy flesh. They are excellent for snacking or adding to desserts.'),
('Cherry', '2', 1.70, '/images/cherry.png', 'Cherries are small, round fruits that come in sweet and tart varieties. They are known for their deep, bright red color.'),
('Strawberry', '3', 3.50, '/images/strawberry.png', 'Strawberries are sweet, juicy fruits known for their bright red color and the tiny seeds covering their surface. They are a staple of summer.'),
('Watermelon', '4', 2.50, '/images/watermelon.png', 'Watermelons are large fruits with a high water content. They have a sweet, refreshing flesh inside a hard, green rind.'),
('Grape', '5', 2.50, '/images/grape.png', 'Grapes are small, round fruits that grow in clusters. They come in several colors, including purple, green, and red, and can be used to make wine.'),
('Lemon', '6', 2.00, '/images/lemon.png', 'Lemons are citrus fruits with a strong, tart flavor. They are usually yellow and can be used in a variety of sweet and savory dishes.'),
('Peach', '7', 2.50, '/images/peach.png', 'Peaches are sweet, juicy fruits known for their velvety skin. They can be eaten fresh or used in desserts like pies and cobblers.');

CREATE TABLE IF NOT EXISTS `cart` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(32) NOT NULL,
    `product_code` varchar(100) NOT NULL,
    `quantity` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;