<?php 

/**
 * notes module
 * Table for notes
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2009, 2011-2013, 2016, 2019-2020, 2023, 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Notes';
$zz['table'] = '/*_PREFIX_*/notes';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'note_id';
$zz['fields'][1]['type'] = 'id';
$zz['fields'][1]['show_id'] = true;

$zz['fields'][2]['field_name'] = 'topic';
$zz['fields'][2]['list_append_next'] = true;
$zz['fields'][2]['list_prefix'] = '<p><strong>';
$zz['fields'][2]['list_suffix'] = '</strong><br>';

$zz['fields'][3]['field_name'] = 'note';
$zz['fields'][3]['type'] = 'memo';
$zz['fields'][3]['format'] = 'markdown';
$zz['fields'][3]['list_format'] = 'markdown';
$zz['fields'][3]['list_append_next'] = true;

/*
$zz['fields'][10] = zzform_include('notes-notes');
$zz['fields'][10]['title'] = 'Part of';
$zz['fields'][10]['type'] = 'subtable';
$zz['fields'][10]['table_name'] = 'collection_notes';
$zz['fields'][10]['sqlorder'] = '';
$zz['fields'][10]['max_records'] = 10;
$zz['fields'][10]['min_records'] = 1;
$zz['fields'][10]['hide_in_list'] = true;
$zz['fields'][10]['fields'][2]['type'] = 'foreign_key';
$zz['fields'][10]['fields'][3]['show_title'] = false;
*/
// $zz['fields'][10]['sql'] = 'SELECT /*_PREFIX_*/notes_notes.* 
//
//	, child_notes.topic AS note_topic
//	, /*_PREFIX_*/notes.topic AS main_topic
//	FROM /*_PREFIX_*/notes_notes
//	LEFT JOIN /*_PREFIX_*/notes child_notes
//		ON /*_PREFIX_*/notes_notes.note_id = child_notes.note_id
//	LEFT JOIN /*_PREFIX_*/notes
//		ON /*_PREFIX_*/notes_notes.main_note_id = /*_PREFIX_*/notes.note_id
//';

//$zz['fields'][11] = zzform_include('notes-notes');
//$zz['fields'][11]['title'] = 'Items';
//$zz['fields'][11]['title_button'] = 'Item';
//$zz['fields'][11]['type'] = 'subtable';
//$zz['fields'][11]['table_name'] = 'item_notes';
//$zz['fields'][11]['sqlorder'] = '';
//$zz['fields'][11]['max_records'] = 10;
//$zz['fields'][11]['min_records'] = 1;
//$zz['fields'][11]['hide_in_list'] = true;
//$zz['fields'][11]['fields'][3]['type'] = 'foreign_key';
//$zz['fields'][11]['fields'][2]['show_title'] = false;
//$zz['fields'][11]['sql'] = 'SELECT /*_PREFIX_*/notes_notes.* 
//	, /*_PREFIX_*/notes.topic AS note_topic
//	, main_notes.topic AS main_topic
//	FROM /*_PREFIX_*/notes_notes
//	LEFT JOIN /*_PREFIX_*/notes
//		ON notes_notes.note_id = /*_PREFIX_*/notes.note_id
//	LEFT JOIN /*_PREFIX_*/notes main_notes
//		ON /*_PREFIX_*/notes_notes.main_note_id = main_notes.note_id
//';

$zz['fields'][4]['field_name'] = 'created';
$zz['fields'][4]['type'] = 'datetime';
$zz['fields'][4]['default'] = date('d.m.Y H:i:s');
$zz['fields'][4]['list_append_next'] = true;

if (wrap_package('contacts')) {
	$zz['fields'][5]['title'] = 'Author';
	$zz['fields'][5]['field_name'] = 'author_contact_id';
	$zz['fields'][5]['type'] = 'select';
	$zz['fields'][5]['sql'] = 'SELECT contact_id, contact, identifier
		FROM /*_PREFIX_*/contacts
		ORDER BY identifier';
	$zz['fields'][5]['sql_character_set'][1] = 'utf8';
	$zz['fields'][5]['display_field'] = 'contact';
	$zz['fields'][5]['link'] = [
		'function' => 'mf_contacts_profile_path',
		'fields' => ['contact_identifier', 'contact_parameters']
	];
	$zz['fields'][5]['default'] = $_SESSION['user_id'];
	$zz['fields'][5]['list_prefix'] = ' <em>(';
	$zz['fields'][5]['list_suffix'] = ')</em></p>';
}

if (wrap_package('default')) {
	$zz['fields'][12] = zzform_include('notes-categories');
	$zz['fields'][12]['title'] = 'Categories';
	$zz['fields'][12]['type'] = 'subtable';
	$zz['fields'][12]['sqlorder'] = '';
	$zz['fields'][12]['max_records'] = 10;
	$zz['fields'][12]['min_records'] = 1;
	$zz['fields'][12]['hide_in_list'] = true;
	$zz['fields'][12]['form_display'] = 'lines';
	$zz['fields'][12]['fields'][2]['type'] = 'foreign_key';
	$zz['fields'][12]['fields'][3]['show_title'] = false;
}

if (wrap_package('activities')) {
	$zz['fields'][13] = zzform_include('notes-access');
	$zz['fields'][13]['title'] = 'Access';
	$zz['fields'][13]['type'] = 'subtable';
	$zz['fields'][13]['sqlorder'] = '';
	$zz['fields'][13]['max_records'] = 10;
	$zz['fields'][13]['min_records'] = 1;
	$zz['fields'][13]['hide_in_list'] = true;
	$zz['fields'][13]['form_display'] = 'lines';
	$zz['fields'][13]['fields'][2]['type'] = 'foreign_key';
	$zz['fields'][13]['fields'][3]['show_title'] = false;
	$zz['fields'][13]['fields'][3]['append_next'] = true;
}

if (wrap_package('media')) {
	$zz['fields'][14] = zzform_include('notes-media');
	$zz['fields'][14]['title'] = 'Media';
	$zz['fields'][14]['type'] = 'subtable';
	$zz['fields'][14]['sqlorder'] = '';
	$zz['fields'][14]['max_records'] = 10;
	$zz['fields'][14]['min_records'] = 1;
	$zz['fields'][14]['hide_in_list'] = true;
	$zz['fields'][14]['form_display'] = 'lines';
	$zz['fields'][14]['fields'][2]['type'] = 'foreign_key';
	$zz['fields'][14]['fields'][3]['show_title'] = false;
	$zz['fields'][14]['fields'][3]['append_next'] = true;
}

$zz['fields'][7]['field_name'] = 'identifier';
$zz['fields'][7]['type'] = 'identifier';
$zz['fields'][7]['fields'] = ['topic'];
$zz['fields'][7]['hide_in_list'] = true;

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/notes.* 
		, /*_PREFIX_*/contacts.identifier AS contact_identifier, contact
		, /*_PREFIX_*/categories.parameters AS contact_parameters
	FROM /*_PREFIX_*/notes
	LEFT JOIN /*_PREFIX_*/contacts 
		ON /*_PREFIX_*/notes.author_contact_id = /*_PREFIX_*/contacts.contact_id
	LEFT JOIN /*_PREFIX_*/categories
		ON /*_PREFIX_*/contacts.contact_category_id = /*_PREFIX_*/categories.category_id
';
$zz['sqlorder'] = ' ORDER BY created, topic';
