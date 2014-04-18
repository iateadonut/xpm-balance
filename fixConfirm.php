<?php

#THIS SCRIPT SHOULD FIND THE MIN AND MAX ID OF BLOCKS THAT ARE OLDER THAN 3 MINUTES AND HAVE BEEN CONFIRMED LESS THAN 20 TIMES

$infotype = 'notConfirmed';

include('getInfo.php');

//$response IS MIN/MAX
echo $response; exit;

$arr = explode(',', $response);

$min = $arr[0];
$max = $arr[1];

for( $block_id=$min; $block_id<=$max; $block_id++ )
{
	echo $block_id."\n";
	include('block2JSON.php');
	
}

