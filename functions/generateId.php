<?php

namespace functions;

function generateId() {
	$id = [];
	array_push($id, sprintf('%06x', mt_rand(0, 4294967295)));
	array_push($id, sprintf('%06x', mt_rand(0, 65535)));
	array_push($id, sprintf('%06x', mt_rand(0, 65535)));
	array_push($id, sprintf('%06x', mt_rand(0, 65535)));
	array_push($id, sprintf('%06x', mt_rand(0, 281474976710655)));

	return implode("-", $id);

}