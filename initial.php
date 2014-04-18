<?php
//THIS SCRIPT GOES THROUGH EVERY BLOCK ANALYZES THEM AND PUTS THEM IN THE DATABASE
include('include.php');

$blockcount = exec('primecoind getblockcount');

echo $blockcount;

for( $block_id=1; $block_id<=$block_count; $block_id++ )
{
	echo $block_id."\n";
	include('block2JSON.php');
	
}
