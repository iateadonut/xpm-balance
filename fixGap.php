<?php

$infotype = 'getGap';

include('getInfo.php');

//echo $response;

$minMax = explode( ',', $response );

$min = $minMax[0];
$max = $minMax[1];
//echo $response . " " . $min . " " . $max;exit;

for( $block_id=$min; $block_id<=$max; $block_id++ )
{
	//echo $block_id."\n";
	include('block2JSON.php');
	
}
