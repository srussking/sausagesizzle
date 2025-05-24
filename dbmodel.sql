
-- ------
-- BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
-- SausageSizzle implementation : © Russ King srussking@gmail.com
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Example 1: create a standard "card" table to be used with the "Deck" tools (see example game "hearts"):

-- CREATE TABLE IF NOT EXISTS `card` (
--   `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `card_type` varchar(16) NOT NULL,
--   `card_type_arg` int(11) NOT NULL,
--   `card_location` varchar(16) NOT NULL,
--   `card_location_arg` int(11) NOT NULL,
--   PRIMARY KEY (`card_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Example 2: add a custom field to the standard "player" table
-- ALTER TABLE `player` ADD `player_my_custom_field` INT UNSIGNED NOT NULL DEFAULT '0';

-- dice_value : 
  -- critter : 0 crocodile, 1 echidna, 2 kangaroo, 3 platypus, 4 quikka, 5 tiger snake
  -- food: 0 sausage, 1 2, 2 3, 4 5, 5 sausage
-- type : 0 critter, 1 food
CREATE TABLE IF NOT EXISTS `dice` (
  `dice_id` TINYINT unsigned NOT NULL AUTO_INCREMENT,
  `dice_value` TINYINT unsigned NOT NULL DEFAULT 0,
  `locked` TINYINT unsigned NOT NULL DEFAULT false,
  `rolled` TINYINT unsigned NOT NULL DEFAULT true,
  `type` TINYINT unsigned NOT NULL DEFAULT 0,
  `discarded` TINYINT unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`dice_id`)
) ENGINE=InnoDB;

-- critter same as above
-- sausge 0 false, 1 true
CREATE TABLE IF NOT EXISTS `score` (
  `score_id` TINYINT unsigned NOT NULL AUTO_INCREMENT,
  `critter` TINYINT unsigned NOT NULL DEFAULT 0,
  `sausage` TINYINT unsigned NOT NULL DEFAULT 0,
  `player_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB;
