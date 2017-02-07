CREATE TABLE `cf_company` (
 `id` int(32) NOT NULL auto_increment,
 `name` text NOT NULL,
 `type` varchar(255) NOT NULL,
 `description` longtext NOT NULL,
 `date` varchar(255) NOT NULL,
 `time` varchar(255) NOT NULL,
 `sponsor` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE `cf_interview` (
 `id` int(32) NOT NULL auto_increment,
 `name` varchar(255) NOT NULL,
 `ic` varchar(255) NOT NULL,
 `matrix` varchar(255) NOT NULL,
 `year` varchar(255) NOT NULL,
 `course` text NOT NULL,
 `address` text NOT NULL,
 `email` varchar(255) NOT NULL,
 `phone` varchar(255) NOT NULL,
 `company` text NOT NULL,
 `register` varchar(255) NOT NULL,
 `date` varchar(255) NOT NULL,
 `time` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE `cf_careertalk` (
 `id` int(32) NOT NULL auto_increment,
 `name` varchar(255) NOT NULL,
 `ic` varchar(255) NOT NULL,
 `matrix` varchar(255) NOT NULL,
 `year` varchar(255) NOT NULL,
 `course` text NOT NULL,
 `address` text NOT NULL,
 `email` varchar(255) NOT NULL,
 `phone` varchar(255) NOT NULL,
 `company` text NOT NULL,
 `register` varchar(255) NOT NULL,
 `date` varchar(255) NOT NULL,
 `time` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;