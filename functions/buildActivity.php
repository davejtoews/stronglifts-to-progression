<?php
namespace functions;

function buildActivity($exercise) {
	$key = [
		'Squat' => [
			"@type" => "MuscleActivity",
			"custom" => false,
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
			"@type" => "MuscleActivity",
			"custom" => false,
	        "id" => "75",
	        "name" => "Barbell Shoulder Press",
	        "mainTargetMuscle" => 7,
	        "secondaryTargetMuscles" => [
				8
	        ]			
		],
		'Deadlift' => [
			"@type" => "MuscleActivity",
			"custom" => false,
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
			"@type" => "MuscleActivity",
			"custom" => false,
	        "id" => "7",
	        "name" => "Barbell Bench Press",
	        "mainTargetMuscle" => 5,
	        "secondaryTargetMuscles" => [
				7,
				8
	        ]
		],
		'Barbell row' => [
			"@type" => "MuscleActivity",
			"custom" => false,
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
	$activity['performanceTarget']['groupIndex'] = -1;
	$activity['performanceTarget']['restPerSet'] = 0;

	foreach ($exercise['sets'] as $i=>$set) {
		$completed = [];

		$completed['completedAt'] = $exercise['start'] + ($i + 1) * 60 * 1000 * 3;
		$completed['reps'] = intval($set);
		$completed['weight'] = floatval($exercise['weight']);
		$completed['duration'] = 0;
		$completed['mark'] = 0;
		array_push($activity['performance']['completedSets'], $completed);

		$parameter = [];
		$parameter['minReps'] = 5;
		$parameter['maxReps'] = 5;
		$parameter['allOut'] = false;
		$parameter['mark'] = 0;
		if($i) {
			$parameter['index'] = $i;
		}
		array_push($activity['performanceTarget']['parameters'], $parameter);
	}

	return $activity ;
}