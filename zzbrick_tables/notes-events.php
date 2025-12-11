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

$zz['fields'][3]['title'] = 'Event';
$zz['fields'][3]['field_name'] = 'event_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = sprintf('SELECT event_id
		, CONCAT(/*_PREFIX_*/events.event, " (", DATE_FORMAT(/*_PREFIX_*/events.date_begin, "%s"), ")") AS event
	FROM /*_PREFIX_*/events
	ORDER BY date_begin DESC', wrap_placeholder('mysql_date_format'));
$zz['fields'][3]['display_field'] = 'event';
$zz['fields'][3]['character_set'] = 'utf8';

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = sprintf('SELECT /*_PREFIX_*/notes_events.* 
	, /*_PREFIX_*/notes.topic
	, CONCAT(/*_PREFIX_*/events.event, " (", DATE_FORMAT(/*_PREFIX_*/events.date_begin, "%s"), ")") AS event
	FROM /*_PREFIX_*/notes_events
	LEFT JOIN /*_PREFIX_*/notes USING (note_id)
	LEFT JOIN /*_PREFIX_*/events USING (event_id)
', wrap_placeholder('mysql_date_format'));
$zz['sqlorder'] = ' ORDER BY /*_PREFIX_*/notes.identifier, /*_PREFIX_*/events.date_begin DESC';

