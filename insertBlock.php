<?php


//echo __FILE__ . ":" . __LINE__ . "\n";
include_once('include.php');
//echo __FILE__ . ":" . __LINE__ . "\n";

//create table xpm.blocks (id bigint unsigned, hash varchar(500), confirm int unsigned, time bigint unsigned, prev varchar(500), next varchar(500) );
//alter table xpm.blocks add unique key (hash);


/*
$block_id = $argv[1];
$blockhash = $argv[2];
$confirmations = $argv[3];
$time = $argv[4];
$prev = trim( $argv[5], '"');
$next = trim( $argv[6], '"');
*/

$query = "replace into blocks (id, hash, confirm, time, prev, next) values ( ?, ?, ?, ?, ?, ? )";

$array = array($block_id, $blockhash, $confirmations, $time, $prev, $next);

//print_r($pdo);

$sth = $pdo->prepare($query);

$sth->execute($array);

if( !$sth )
{
	file_put_contents( 'debug',  $pdo->errorInfo() . $query . "\n" . print_r($array, 1), FILE_APPEND );
}
	

//file_put_contents( 'debug', $query . print_r($array, 1), FILE_APPEND );

//replace into table xpm.blocks (id, hash, confirm, time, prev, next) values ( 4, '641fb76cf41ec51e2ad04674a70087c7daab8a5d2f82e2a77e95124a50174f32', 385643, 1373221936, 'b22946daedabb93d4e9e28945278fd3d9f7ec601ce4aba1a25e6e203cf6fa41f', '3793bffaa72a8e2c19cdef357c3020f51f1af957ffb5e080d95f82265e372dc0' )


