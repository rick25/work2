CREATE DATABASE `work21`;

USE `work21`;

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_isbn` int(11) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY(`book_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE `categories` (
	`category_id` int(11) NOT NULL AUTO_INCREMENT,
	`name_category` varchar(100) NOT NULL,
	PRIMARY KEY(`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1;

ALTER TABLE `books`
	ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY(`category_id`) REFERENCES `categories` (`category_id`);


INSERT INTO `categories` (`category_id`,`name_category`) VALUES
(1, 'Programacion'),
(2, 'Psicologia'),
(3, 'Literatura'),
(4, 'Matematicas'),
(5, 'Ciencias Comunicacion');

INSERT INTO `books` (`book_id`, `book_isbn`, `book_title`, `book_author`, `category_id`) VALUES
(2, 7893, 'Laravel Tiger', 'Mutafaf', 1),
(3, 8934, 'Android Programming', 'Farrukh', 1),
(6, 8902, 'Intro to Psychology', 'Ayesha', 2),
(7, 2345, 'Calculus-1', 'John doe', 4),
(8, 8927, 'Chemistry Part-1', 'Aliza Mam', 3),
(9, 6723, 'Math Part-1', 'Sir Sohail Amanat', 4),
(10, 7896, 'Javascript for begginners', 'Shami ', 1),
(11, 8978, 'iOS App ', 'Ehtesham Mehmood', 5),
(12, 8987, 'Physics', 'Sir Waqas', 2),
(13, 7890, 'HTML for dummies', 'Ehtesham Shami', 1),
(14, 1234, 'CodeIgniter Framework Introduction', 'Mutafaf', 1);
