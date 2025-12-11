<?php 

/**
 * notes module
 * Table for notes linked to media
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2009, 2011-2013, 2016, 2019-2020, 2023, 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Media for Notes';
$zz['table'] = '/*_PREFIX_*/notes_media';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'note_medium_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['title'] = 'Note';
$zz['fields'][2]['field_name'] = 'note_id';
$zz['fields'][2]['type'] = 'select';
$zz['fields'][2]['sql'] = 'SELECT note_id, topic, created
	FROM /*_PREFIX_*/notes 
	ORDER BY identifier, created';
$zz['fields'][2]['display_field'] = 'note_topic';
$zz['fields'][2]['search'] = '/*_PREFIX_*/notes.topic';

$zz['fields'][3]['title'] = 'Medium';
$zz['fields'][3]['field_name'] = 'medium_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT medium_id, title
	FROM /*_PREFIX_*/media
	LEFT JOIN /*_PREFIX_*/filetypes USING (filetype_id)
	WHERE mime_content_type = "image"
	ORDER BY title';
$zz['fields'][3]['display_field'] = 'medium_title';
$zz['fields'][3]['search'] = '/*_PREFIX_*/media.title';

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/notes_media.* 
	, /*_PREFIX_*/notes.topic AS note_topic
	, /*_PREFIX_*/media.title AS medium_title
	FROM /*_PREFIX_*/notes_media
	LEFT JOIN /*_PREFIX_*/notes USING (note_id)
	LEFT JOIN /*_PREFIX_*/media USING (medium_id)
';
$zz['sqlorder'] = ' ORDER BY /*_PREFIX_*/notes.identifier, /*_PREFIX_*/media.title';
