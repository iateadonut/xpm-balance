<?php

#THIS SCRIPT SHOULD FIND THE MIN AND MAX ID OF BLOCKS THAT ARE OLDER THAN 3 MINUTES AND HAVE BEEN CONFIRMED LESS THAN 20 TIMES

$infotype = 'getOneBroken';
echo __LINE__ . "\n";
include('getInfo.php');
echo __LINE__ . "\n";
$block_id = $response;

echo $block_id."\n";exit;
include('block2JSON.php');
	


