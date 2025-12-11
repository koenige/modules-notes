<?php 

/**
 * notes module
 * Table for notes linked to categories
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2009, 2011-2013, 2016, 2019-2020, 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Categories for Notes';
$zz['table'] = '/*_PREFIX_*/notes_categories';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'note_category_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['title'] = 'Note';
$zz['fields'][2]['field_name'] = 'note_id';
$zz['fields'][2]['type'] = 'select';
$zz['fields'][2]['sql'] = 'SELECT note_id, topic, created
	FROM /*_PREFIX_*/notes 
	ORDER BY identifier, created';
$zz['fields'][2]['display_field'] = 'topic';

$zz['fields'][3]['title'] = 'Category';
$zz['fields'][3]['field_name'] = 'category_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT category_id, category, path
	FROM /*_PREFIX_*/categories 
	ORDER BY category';
$zz['fields'][3]['display_field'] = 'category';
$zz['fields'][3]['unique_ignore'] = ['path'];

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/notes_categories.* 
	, /*_PREFIX_*/notes.topic
	, /*_PREFIX_*/categories.category
	FROM /*_PREFIX_*/notes_categories
	LEFT JOIN /*_PREFIX_*/notes
		ON /*_PREFIX_*/notes_categories.note_id = /*_PREFIX_*/notes.note_id
	LEFT JOIN /*_PREFIX_*/categories USING (category_id)
';
$zz['sqlorder'] = ' ORDER BY /*_PREFIX_*/notes.identifier, category';
