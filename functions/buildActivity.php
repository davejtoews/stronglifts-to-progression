<?php
namespace functions;

function buildActivity($exercise) {
	$key = [
		'Squat' => [
	        "id" => "150",
	        "name" => "Barbell Squat",
            "equipment" => 1,
	        "mainTargetMuscle" => 6,
	        "secondaryTargetMuscles" => [
				1,
				4
	        ]
		],
		'Overhead press' => [
	        "id" => "75",
	        "name" => "Barbell Shoulder Press",
	        "mainTargetMuscle" => 7,
	        "secondaryTargetMuscles" => [
				8
	        ]			
		],
		'Deadlift' => [
	        "id" => "129",
	        "name" => "Barbell Deadlift",
	        "mainTargetMuscle" => 2,
	        "secondaryTargetMuscles" => [
				6,
				3,
				1
	        ]
		],
		'Bench press' => [
	        "id" => "7",
	        "name" => "Barbell Bench Press",
	        "mainTargetMuscle" => 5,
	        "secondaryTargetMuscles" => [
				7,
				8
	        ]
		],
		'Barbell row' => [
	        "id" => "109",
	        "name" => "Bent-Over Barbell Row",
	        "mainTargetMuscle" => 2,
	        "secondaryTargetMuscles" => [
				3
	        ]
		]
	];

	$activity = $key[$exercise['name']];

	$activity['@type'] = "MuscleActivity";
	$activity['equipment'] = 1;

	$activity['performance']['completedSets'] = [];
	$activity['performanceTarget']['parameters'] = [];

	foreach ($exercise['sets'] as $i=>$set) {
		$completed = [];

		$completed['completedAt'] = $exercise['start'] + ($i + 1) * 60 * 1000 * 3;
		$completed['reps'] = intval($set);
		$completed['weight'] = floatval($exercise['weight']);
		array_push($activity['performance']['completedSets'], $completed);

		$parameter = [];
		$parameter['minReps'] = 5;
		$parameter['maxReps'] = 5;
		if($i) {
			$parameter['index'] = $i;
		}
		array_push($activity['performanceTarget']['parameters'], $parameter);
	}

	return $activity ;
}