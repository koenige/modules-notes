<?php 

/**
 * notes module
 * Table for notes linked to other notes
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2009, 2011-2013, 2016, 2019, 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Collections of Notes';
$zz['table'] = '/*_PREFIX_*/notes_notes';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'note_note_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['title'] = 'Note';
$zz['fields'][2]['field_name'] = 'note_id';
$zz['fields'][2]['type'] = 'select';
$zz['fields'][2]['sql'] = 'SELECT note_id, title, created
	FROM /*_PREFIX_*/notes 
	ORDER BY title, created';
$zz['fields'][2]['display_field'] = 'note_title';
$zz['fields'][2]['search'] = 'notes.title';

$zz['fields'][3]['title'] = 'Part of';
$zz['fields'][3]['field_name'] = 'main_note_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT note_id, title, created
	FROM /*_PREFIX_*/notes 
	ORDER BY title, created';
$zz['fields'][3]['display_field'] = 'main_note_title';
$zz['fields'][3]['search'] = 'main_notes.title';

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/notes_notes.* 
	, notes.title AS note_title
	, main_notes.title AS main_note_title
	FROM /*_PREFIX_*/notes_notes
	LEFT JOIN /*_PREFIX_*/notes notes
		ON /*_PREFIX_*/notes_notes.note_id = notes.note_id
	LEFT JOIN /*_PREFIX_*/notes main_notes
		ON /*_PREFIX_*/notes_notes.main_note_id = main_notes.note_id
';
$zz['sqlorder'] = ' ORDER BY notes.title, main_notes.title';
