/**
 * notes module
 * SQL updates
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


/* 2025-12-09-1 */	ALTER TABLE `notes` CHANGE `title` `topic` varchar(50) COLLATE 'utf8mb4_unicode_ci' NOT NULL AFTER `note_id`;
/* 2025-12-09-2 */	ALTER TABLE `notes` CHANGE `created` `created` datetime NOT NULL AFTER `note`;
/* 2025-12-09-3 */	ALTER TABLE `notes` ADD `identifier` varchar(32) COLLATE 'latin1_general_ci' NOT NULL AFTER `topic`;
/* 2025-12-09-4 */	UPDATE `notes` SET `identifier` = `note_id` WHERE `identifier` = '';
/* 2025-12-09-5 */	ALTER TABLE `notes` ADD UNIQUE `identifier` (`identifier`), DROP INDEX `title_created`;
/* 2025-12-11-1 */	CREATE TABLE `notes_events` (`note_event_id` int unsigned NOT NULL AUTO_INCREMENT, `note_id` int unsigned NOT NULL, `event_id` int unsigned NOT NULL, `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`note_event_id`), UNIQUE KEY `note_id` (`note_id`,`event_id`), KEY `event_id` (`event_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/* 2025-12-11-2 */	INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'notes', 'note_id', (SELECT DATABASE()), 'notes_events', 'note_event_id', 'note_id', 'delete');
/* 2025-12-11-3 */	INSERT INTO _relations (`master_db`, `master_table`, `master_field`, `detail_db`, `detail_table`, `detail_id_field`, `detail_field`, `delete`) VALUES ((SELECT DATABASE()), 'events', 'event_id', (SELECT DATABASE()), 'notes_events', 'note_event_id', 'event_id', 'no-delete');
/* 2025-12-11-4 */	ALTER TABLE `notes_events` ADD `sequence` tinyint unsigned NOT NULL DEFAULT '1' AFTER `event_id`;
/* 2025-12-11-5 */	ALTER TABLE `notes_categories` ADD `sequence` tinyint unsigned NOT NULL DEFAULT '1' AFTER `category_id`;
/* 2025-12-11-6 */	ALTER TABLE `notes_access` ADD `sequence` tinyint unsigned NOT NULL DEFAULT '1' AFTER `access_category_id`;
/* 2025-12-11-7 */	ALTER TABLE `notes_media` ADD `sequence` tinyint unsigned NOT NULL DEFAULT '1' AFTER `medium_id`;
