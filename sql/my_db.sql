DROP DATABASE IF EXISTS my_db;

CREATE DATABASE my_db;

use my_db;

CREATE TABLE `products` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `name` varchar(100) NOT NULL, 
  `description` varchar(250) NOT NULL, 
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`) 
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ; 
  
INSERT INTO `products` (`id`, `name`, `description`, `price`) VALUES
(1, 'Produkt 1', 'En kort beskrivning', '15.00'), 
(2, 'Produkt 2', 'En kort beskrivning', '20.00'), 
(3, 'Produkt 3', 'En kort beskrivning', '50.00'), 
(4, 'Produkt 4', 'En kort beskrivning', '55.00');


CREATE TABLE `images` (
`img_id` INT NOT NULL AUTO_INCREMENT,
`img_name` VARCHAR(30) NOT NULL,
`type` VARCHAR(30) NOT NULL,
`size` INT NOT NULL,
`content` MEDIUMBLOB NOT NULL,
PRIMARY KEY(`img_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `images` (`img_id`, `content`) VALUES
(1,  LOAD_FILE('C:/wamp/www/webbshop/img/img-icon.jpg')), 
(2,  LOAD_FILE('C:/wamp/www/webbshop/img/img-icon.jpg')), 
(3,  LOAD_FILE('C:/wamp/www/webbshop/img/img-icon.jpg')), 
(4,  LOAD_FILE('C:/wamp/www/webbshop/img/img-icon.jpg'));