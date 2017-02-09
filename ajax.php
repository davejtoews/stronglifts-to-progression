<?php 
date_default_timezone_set('America/Edmonton');

spl_autoload_register();
 
use helpers\Fn;

$array = Fn::getArrayFromCsv($_FILES['slCsv']['tmp_name']);
$data = Fn::getRelevantDataFromArray($array);
$workouts = array_map(array('helpers\Fn', 'buildWorkout'), $data);

$lastWorkout = end($workouts);
$program = Fn::buildProgram($lastWorkout['programDayIndex']);

header('Content-Type: application/json');
echo json_encode(array(
	'workouts' => $workouts,
	'program' => $program
));