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

