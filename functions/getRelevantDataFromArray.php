<?php
namespace functions;
use \DateTime;

function getRelevantDataFromArray($array) {

	$data = [];
	foreach($array as $workout) {
		$workoutData = [];
		$dateString = (isset($workout['Date'])) ? $workout['Date'] : '01/01/01';
		$date = DateTime::createFromFormat('d/m/y', $dateString);
		$workoutData['date'] = $date->getTimestamp() * 1000;
		$workoutData['program'] = $workout['Workout'];
		$workoutData['exercises'] = [];

		for ($i=1; $i<=3; $i++) {
			$exercise = [];
			$exercise['name'] = $workout['Exercise ' . $i];
			$exercise['sets'] = [];
			for ($j=1; $j<=5; $j++) {
				if (strlen($workout[$exercise['name'] . " Set " . $j])) {

					array_push($exercise['sets'], $workout[$exercise['name'] . " Set " . $j]);
				}
			}
			$exercise['weight'] = $workout[$exercise['name'] . " Weight (LB)"] * 0.45359237;
			$exercise['start'] = $workoutData['date'] + 20 * 60 * 1000 * ($i - 1);
			array_push($workoutData['exercises'], $exercise);
		}
		array_push($data, $workoutData);
	}

	return $data;
}