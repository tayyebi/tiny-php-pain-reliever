-- database name :test

-- table: todo
CREATE TABLE `todo` ( `Id` INT NOT NULL AUTO_INCREMENT , `Value` VARCHAR(4000) NOT NULL , `Submit` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `Username` VARCHAR(300) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;

-- table: mysql_general_log
CREATE TABLE `mysql_general_log` (
 `event_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
 `user_host` mediumtext NOT NULL,
 `thread_id` bigint(21) unsigned NOT NULL,
 `server_id` int(10) unsigned NOT NULL,
 `command_type` varchar(64) NOT NULL,
 `argument` mediumblob NOT NULL,
 KEY `event_time` (`event_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='General log'