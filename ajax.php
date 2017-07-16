<?php 
date_default_timezone_set('America/Edmonton');

ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");
ini_set('auto_detect_line_endings', TRUE);

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

$file = $_FILES['slCsv']['tmp_name'];

//Strip newlines within notes
$contents = file_get_contents($file);
file_put_contents($file, preg_replace("/(?<!,)[\n\r]/", "", $contents));

$array = Fn::getArrayFromCsv($file);
$data = Fn::getRelevantDataFromArray($array);
$workouts = array_map(array('helpers\Fn', 'buildWorkout'), $data);

$lastWorkout = end($workouts);
$program = Fn::buildProgram($lastWorkout['programDayIndex']);

header('Content-Type: application/json');
echo json_encode(array(
	'workouts' => $workouts,
	'program' => $program
));