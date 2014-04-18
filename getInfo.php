<?php
//echo __LINE__ . "\n";
include('include.php');
//echo __LINE__ . "\n";
//$infotype = $argv[1];

$infotypeArray = array(
'largestblock'=>'largestblock',
'getOneBroken'=>'getOneBroken',
'getGap'=>'getGap',
'notConfirmed'=>'notConfirmed'
);


$infotype = $infotypeArray[$infotype];

//$response =  $infotype;

if ( 'largestblock' == $infotype )
{
	
	$query = "select max(id) as id from blocks";
	$sth = $pdo->prepare($query);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
	$response = ($result[0]);
	
}

if ( 'getOneBroken' == $infotype )
{

	$query = "select id from blocks left outer join receipts on ( blocks.id = receipts.block_id ) where receipts.block_id is null limit 1";
	echo $query;
	$sth = $pdo->prepare($query);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
	$response = ($result[0]);
	
}

if ( 'getGap' == $infotype )
{

	$query = "SELECT (t1.id + 1) as gap_starts_at, 
       (SELECT MIN(t3.id) -1 FROM blocks t3 WHERE t3.id > t1.id) as gap_ends_at
FROM blocks t1
WHERE NOT EXISTS (SELECT t2.id FROM blocks t2 WHERE t2.id = t1.id + 1)
HAVING gap_ends_at IS NOT NULL limit 1";
	$sth = $pdo->prepare($query);
	$sth->execute();
	$result = $sth->fetchAll();
	//$response = (print_r($result,1));
	$response = ($result[0][0].",".$result[0][1]);
	
}


if ( 'notConfirmed' == $infotype )
{

	$query = "select min(id) as min, max(id) as max from blocks where ts < date_sub(now(), interval 3 minute) and confirm < 20;";
	$sth = $pdo->prepare($query);
	$sth->execute();
	$result = $sth->fetchAll();
	$response = ($result[0][0].",".$result[0][1]);
	
}
