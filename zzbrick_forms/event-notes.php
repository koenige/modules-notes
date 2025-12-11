<?php

/**
 * notes module
 * form: notes
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/notes
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


if (empty($brick['data']['event_id'])) wrap_quit(404);

$zz = zzform_include('notes');
$zz['where']['notes_events.event_id'] = $brick['data']['event_id'];

if (!empty($zz['fields'][8])) $zz['fields'][8]['list_append_next'] = false;
$zz['fields'][9]['hide_in_list'] = true;

$zz['sql'] = wrap_edit_sql($zz['sql'], 'JOIN',
	'LEFT JOIN notes_events USING (note_id)'
);

// subtitle for project filter
$zz['subtitle']['event_id']['sql'] = 'SELECT event_id, event, identifier
	FROM events
	LEFT JOIN notes_events USING (event_id)
	ORDER BY identifier';
$zz['subtitle']['event_id']['var'] = ['event'];
