# create database

DROP DATABASE IF EXISTS `avoice`;

CREATE DATABASE `avoice`;

USE `avoice`;

# create tables

CREATE TABLE `users` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`username` CHAR(255),
	`password` CHAR(255),
	`email` CHAR(255),
	`view` CHAR(255),
	`created` DATETIME NULL,
	`group_id` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `groups` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`group` CHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `topics` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`title` CHAR(255),
	`description` TEXT,
	`user_id` INT,
	`created` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `posts` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`title` CHAR(255),
	`post` TEXT,
	`topic_id` INT,
	`user_id` INT,
	`created` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comments` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`comment` CHAR(255),
	`post_id` INT,
	`user_id` INT,
	`created` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `votes` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`parent_id` INT,
	`model` CHAR(255),
	`vote` TINYINT(1),
	`user_id` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE acos (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INTEGER(10) DEFAULT NULL,
  `model` VARCHAR(255) DEFAULT '',
  `foreign_key` INTEGER(10) UNSIGNED DEFAULT NULL,
  `alias` VARCHAR(255) DEFAULT '',
  `lft` INTEGER(10) DEFAULT NULL,
  `rght` INTEGER(10) DEFAULT NULL,
  PRIMARY KEY  (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE aros_acos (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aro_id` INTEGER(10) UNSIGNED NOT NULL,
  `aco_id` INTEGER(10) UNSIGNED NOT NULL,
  `_create` CHAR(2) NOT NULL DEFAULT 0,
  `_read` CHAR(2) NOT NULL DEFAULT 0,
  `_update` CHAR(2) NOT NULL DEFAULT 0,
  `_delete` CHAR(2) NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE aros (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INTEGER(10) DEFAULT NULL,
  `model` VARCHAR(255) DEFAULT '',
  `foreign_key` INTEGER(10) UNSIGNED DEFAULT NULL,
  `alias` VARCHAR(255) DEFAULT '',
  `lft` INTEGER(10) DEFAULT NULL,
  `rght` INTEGER(10) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# insert some data

# users 

INSERT INTO users (`id`, `username`, `password`, `email`, `view`, `group_id`) 
VALUES
	 (NULL, 'admin', '34a6df8abc03aedba1f03f67e22cd1e36ca96308', 'pur3forlyphe@gmail.com', 'this is my view', 1);
	 
# topics

INSERT INTO `topics` (`id`, `title`, `description`, `user_id`, `created`)
VALUES
	(1,'This is a test title 1','this is where the description would go, this would be limited on the home page somewhat so that this message would be cut off unless you went and entered the title yourself, possibly thinking about limiting to 10000 characters?',1,NULL);
	
# user groups

INSERT INTO `groups` (`id`, `group`)
VALUES
	(1, 'superadmin'),
	(2, 'admin'),
	(3, 'user'),
	(4, 'anonymous');
	

# acl - controls user permissions to see web pages

# aros = users groups

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`)
VALUES
	(1, NULL, 'Group', 1, NULL, 1, 4),
	(2, 1, 'User', 1, 'superuser', 2, 3);
	
# acos = page models

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`)
VALUES
	(1, NULL, NULL, 'controllers', NULL, 1, 2);
	
INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`)
VALUES
	(1, 1, 1, 1, 1, 1, 1); 
	