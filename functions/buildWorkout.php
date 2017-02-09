<?php 

namespace functions;

include_once('buildActivity.php');
include_once('generateId.php');

function buildWorkout($data) {
	$workout = [];
	$workout['activities'] = array_map('functions\buildActivity', $data['exercises']);
	$workout['startTime'] = $data['date'];
	$workout['endTime'] = $data['date'] + (60 * 60 * 1000);
	$workout['id'] = generateId();
	$workout['programId'] = 1;

	$key = [
		'B' => 0,
		'A' => 1
	];

	$workout['programDayIndex'] = $key[$data['program']];

	return $workout;
}
