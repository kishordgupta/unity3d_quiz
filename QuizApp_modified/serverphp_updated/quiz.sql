/* Dumping structure for table trivia.admin */
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `fname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2;

/*Dumping data for table trivia.admin: 1 rows*/
INSERT INTO `admin` (`id`, `roleid`, `username`, `password`, `fname`, `lname`, `email`, `status`) VALUES
	(1, 1, 'admin', 'c11de32955a4286a0957da89f8196416888ea441', 'quiz', 'cms', 'quiz@techintegrity.in', '1');

/*Dumping structure for table trivia.answer*/
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(256) NOT NULL,
  `true_ans` int(11) NOT NULL,
  `dateupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `datecreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping structure for table trivia.appsetting
CREATE TABLE IF NOT EXISTS `appsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` int(1) NOT NULL,
  `correct_message` varchar(500) NOT NULL,
  `wrong_message` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping structure for table trivia.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `correct_ans_score` varchar(50) NOT NULL,
  `wrong_ans_score` varchar(50) NOT NULL,
  `time` varchar(256) NOT NULL,
  `limits` varchar(256) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


-- Dumping structure for table trivia.question
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `url` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


-- Dumping structure for table trivia.user_category_score
CREATE TABLE IF NOT EXISTS `user_category_score` (
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB;


-- Dumping structure for table trivia.user_info
CREATE TABLE `user_info` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(100) NULL DEFAULT NULL,
	`email` VARCHAR(100) NULL DEFAULT NULL,
	`facebook_id` VARCHAR(255) NULL DEFAULT NULL,
	`password` VARCHAR(100) NULL DEFAULT NULL,
	`datecreated` DATETIME NULL DEFAULT NULL,
	`dateupdated` DATETIME NULL DEFAULT NULL,
	`random_number` VARCHAR(20) NULL DEFAULT NULL,
	`status` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;
