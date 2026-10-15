<?php

declare(strict_types=1);

require_once __DIR__ . "/../src/wings/WingGeometry.php";

use Wings\WingGeometry;

$points = WingGeometry::points();
if(count($points) !== 69){
	throw new RuntimeException("Expected 69 distinct points in the wing outline");
}

$lookup = [];
foreach($points as $point){
	if(!is_finite($point["height"]) || !is_finite($point["lateral"]) || abs($point["height"]) > 1.4 || abs($point["lateral"]) > 1.2){
		throw new RuntimeException("Wing geometry contains an invalid or out-of-bounds point");
	}
	$lookup[sprintf("%.1f:%.1f", $point["height"], $point["lateral"])] = true;
}

foreach($points as $point){
	$mirror = sprintf("%.1f:%.1f", $point["height"], -$point["lateral"]);
	if(!isset($lookup[$mirror])){
		throw new RuntimeException("Wing geometry is not symmetric around the player's back");
	}
}

echo "Passed 69 symmetric wing particle geometry points\n";
