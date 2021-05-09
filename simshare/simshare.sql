/* simshare SQL 파일 */
/* mysql 5.7 에서 작성되었습니다. */

CREATE DATABASE `simshare`;
USE `simshare`;
DROP TABLE IF EXISTS `clientfiles`;

CREATE TABLE `clientfiles` (
	`code` char(100) NOT NULL,
	`filename` char(100) NOT NULL,
	`expdate` date NOT NULL,
	`passwd` char(100) NULL,
	`zip` int(1) NOT NULL,
	PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
