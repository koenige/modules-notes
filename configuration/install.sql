/**
 * notes module
 * SQL for installation
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


-- notes --
CREATE TABLE `notes` (
  `note_id` int unsigned NOT NULL AUTO_INCREMENT,
  `topic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `author_contact_id` int unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `identifier` (`identifier`),
  KEY `author_contact_id` (`author_contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'contacts', 'contact_id', (SELECT DATABASE()), 'notes', 'note_id', 'author_contact_id', 'no-delete');


-- notes_access --
CREATE TABLE `notes_access` (
  `note_access_id` int unsigned NOT NULL AUTO_INCREMENT,
  `note_id` int unsigned NOT NULL,
  `usergroup_id` int unsigned NOT NULL,
  `access_category_id` int unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_access_id`),
  UNIQUE KEY `note_id` (`note_id`,`usergroup_id`),
  KEY `usergroup_id` (`usergroup_id`),
  KEY `access_category_id` (`access_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'notes', 'note_id', (SELECT DATABASE()), 'notes_access', 'note_access_id', 'note_id', 'delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'usergroups', 'usergroup_id', (SELECT DATABASE()), 'notes_access', 'note_access_id', 'usergroup_id', 'delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'categories', 'category_id', (SELECT DATABASE()), 'notes_access', 'note_access_id', 'access_category_id', 'no-delete');


-- notes_categories --
CREATE TABLE `notes_categories` (
  `note_category_id` int unsigned NOT NULL AUTO_INCREMENT,
  `note_id` int unsigned NOT NULL,
  `category_id` int unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_category_id`),
  UNIQUE KEY `category_id` (`category_id`),
  KEY `note_id` (`note_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'notes', 'note_id', (SELECT DATABASE()), 'notes_categories', 'note_category_id', 'note_id', 'delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'categories', 'category_id', (SELECT DATABASE()), 'notes_categories', 'note_category_id', 'category_id', 'no-delete');


-- notes_media --
CREATE TABLE `notes_media` (
  `note_medium_id` int unsigned NOT NULL AUTO_INCREMENT,
  `note_id` int unsigned NOT NULL,
  `medium_id` int unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_medium_id`),
  UNIQUE KEY `note_id` (`note_id`,`medium_id`),
  KEY `medium_id` (`medium_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'notes', 'note_id', (SELECT DATABASE()), 'notes_media', 'note_medium_id', 'note_id', 'delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'media', 'medium_id', (SELECT DATABASE()), 'notes_media', 'note_medium_id', 'medium_id', 'no-delete');


-- notes_notes --
CREATE TABLE `notes_notes` (
  `note_note_id` int unsigned NOT NULL AUTO_INCREMENT,
  `note_id` int unsigned NOT NULL,
  `main_note_id` int unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`note_note_id`),
  UNIQUE KEY `note_id` (`note_id`,`main_note_id`),
  KEY `main_note_id` (`main_note_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'notes', 'note_id', (SELECT DATABASE()), 'notes_notes', 'note_note_id', 'note_id', 'no-delete');
INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'notes', 'note_id', (SELECT DATABASE()), 'notes_notes', 'note_note_id', 'main_note_id', 'no-delete');
