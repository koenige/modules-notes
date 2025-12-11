<?php 

/**
 * notes module
 * Table for notes linked to usergroups for access rights
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2009, 2011-2013, 2016, 2019-2020, 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Access to Notes';
$zz['table'] = '/*_PREFIX_*/notes_access';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'note_access_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['title'] = 'Note';
$zz['fields'][2]['field_name'] = 'note_id';
$zz['fields'][2]['type'] = 'select';
$zz['fields'][2]['sql'] = 'SELECT note_id, topic, created
	FROM /*_PREFIX_*/notes 
	ORDER BY identifier, created';
$zz['fields'][2]['display_field'] = 'topic';

$zz['fields'][3]['title'] = 'Usergroup';
$zz['fields'][3]['field_name'] = 'usergroup_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT usergroup_id, usergroup
	FROM /*_PREFIX_*/usergroups 
	ORDER BY usergroup';
$zz['fields'][3]['display_field'] = 'usergroup';

$zz['fields'][4]['title'] = 'Access';
$zz['fields'][4]['field_name'] = 'access_category_id';
$zz['fields'][4]['type'] = 'select';
$zz['fields'][4]['sql'] = 'SELECT categories.category_id
		, categories.category, main_category_id
	FROM categories
	ORDER BY category';
$zz['fields'][4]['display_field'] = 'category';
$zz['fields'][4]['search'] = '/*_PREFIX_*/categories.category';
$zz['fields'][4]['show_hierarchy'] = 'main_category_id';
$zz['fields'][4]['show_hierarchy_subtree'] = wrap_category_id('access');

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/notes_access.* 
		, /*_PREFIX_*/notes.topic
		, /*_PREFIX_*/usergroups.usergroup
		, /*_PREFIX_*/categories.category
	FROM /*_PREFIX_*/notes_access
	LEFT JOIN /*_PREFIX_*/notes USING (note_id)
	LEFT JOIN /*_PREFIX_*/usergroups USING (usergroup_id)
	LEFT JOIN /*_PREFIX_*/categories
		ON /*_PREFIX_*/notes_access.access_category_id = /*_PREFIX_*/categories.category_id
';
$zz['sqlorder'] = ' ORDER BY /*_PREFIX_*/notes.identifier, usergroup';
