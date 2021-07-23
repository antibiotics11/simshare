CREATE DATABASE `simshare`;
USE `simshare`;
DROP TABLE IF EXISTS `clientfiles`;

CREATE TABLE `clientfiles` (
	`code` char(100) NOT NULL,
	`filename` char(255) NOT NULL,
	`expdate` date NOT NULL,
	`passwd` char(255) NULL,
	`renew` int(1) NOT NULL,
	`zip` int(1) NOT NULL,
	PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
