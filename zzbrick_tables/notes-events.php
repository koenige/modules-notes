<?php 

/**
 * notes module
 * Table for notes linked to events
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Notes per Event';
$zz['table'] = '/*_PREFIX_*/notes_events';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'note_event_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][2]['title'] = 'Note';
$zz['fields'][2]['field_name'] = 'note_id';
$zz['fields'][2]['type'] = 'select';
$zz['fields'][2]['sql'] = 'SELECT note_id, topic, created
	FROM /*_PREFIX_*/notes 
	ORDER BY identifier, created';
$zz['fields'][2]['display_field'] = 'topic';

$zz['fields'][4]['title'] = 'No.';
$zz['fields'][4]['field_name'] = 'sequence';
$zz['fields'][4]['type'] = 'number';
$zz['fields'][4]['auto_value'] = 'increment';
$zz['fields'][4]['def_val_ignore'] = true;
$zz['fields'][4]['exclude_from_search'] = true;

$zz['fields'][3]['title'] = 'Event';
$zz['fields'][3]['field_name'] = 'event_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT event_id, event, date_begin
	FROM /*_PREFIX_*/events
	ORDER BY date_begin DESC';
$zz['fields'][3]['sql_format'][2] = 'wrap_date_plain';
$zz['fields'][3]['display_field'] = 'event';

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/notes_events.* 
	, /*_PREFIX_*/notes.topic
	, /*_PREFIX_*/events.event, /*_PREFIX_*/events.date_begin
	FROM /*_PREFIX_*/notes_events
	LEFT JOIN /*_PREFIX_*/notes USING (note_id)
	LEFT JOIN /*_PREFIX_*/events USING (event_id)
';
$zz['sqlorder'] = ' ORDER BY /*_PREFIX_*/notes.identifier, /*_PREFIX_*/events.date_begin DESC';

$zz['subselect']['sql'] = 'SELECT note_id, event, /*_PREFIX_*/events.identifier
	FROM /*_PREFIX_*/notes_events
	LEFT JOIN /*_PREFIX_*/events USING (event_id)';
$zz['subselect']['sql_ignore'] = ['identifier'];
$zz['subselect']['prefix'] = '<p>';
$zz['subselect']['suffix'] = '</p>';
$zz['subselect']['link'] = [
	'area' => $values['type'] ? sprintf('events_%s', $values['type']) : 'events_event',
	'fields' => ['identifier']
];

if (!empty($values['type'])) {
	$zz['fields'][3]['sql'] = wrap_edit_sql($zz['fields'][3]['sql'], 'WHERE',
		sprintf('event_category_id = /*_ID categories event/%s _*/', $values['type'])
	);
	$zz['sql'] = wrap_edit_sql($zz['sql'], 'WHERE',
		sprintf('event_category_id = /*_ID categories event/%s _*/', $values['type'])
	);
	$zz['subselect']['sql'] = wrap_edit_sql($zz['subselect']['sql'], 'WHERE',
		sprintf('event_category_id = /*_ID categories event/%s _*/', $values['type'])
	);
}

