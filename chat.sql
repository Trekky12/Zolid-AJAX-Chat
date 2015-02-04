CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `by` char(30) NOT NULL,
  `message` text NOT NULL,
  `room` char(30) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `chat_users` (
  `userID` INT(25) NOT NULL AUTO_INCREMENT,   
  `username` VARCHAR(65) NOT NULL ,   
  `salt` VARCHAR( 10 ) NOT NULL,
  `password` VARCHAR(75) NOT NULL , 
  `last_active` int(10) unsigned NULL,  
 PRIMARY KEY  (`userID`),
 UNIQUE(`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;