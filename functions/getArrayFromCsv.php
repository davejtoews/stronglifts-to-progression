<?php 

namespace functions;

function getArrayFromCsv($file) {

	$array = $fields = array(); //$i = 0;
	$handle = @fopen($file, "r");
	if ($handle) {
	    while (($row = fgetcsv($handle, 4096)) !== false) {
	    //for ($i = 0; $i < 30; $i++) {
	    	//$row = fgetcsv($handle, 4096);
	        if (empty($fields)) {
	            $fields = $row;
	            continue;
	        }
	  		$prefix = "";
	        foreach ($row as $k=>$value) {
	        	$next_prefix = "";
	        	if (strncmp( $fields[$k], "Exercise", 8 ) === 0 || $fields[$k] === "Arm work") {
	        		$next_prefix = $value. " ";
	        		$prefix = "";
	        	}
	            $array[$i][$prefix . $fields[$k]] = $value;
	            if ($next_prefix) {
	            	$prefix = $next_prefix;
	            }
	        }
	        $i++;
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	    
	}

	return array_unique($array, SORT_REGULAR);	
}