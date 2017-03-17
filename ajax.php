<?php 
date_default_timezone_set('America/Edmonton');

spl_autoload_register( function ($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
});
 
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