<?php
include('include.php');

//create table xpm.receipts ( block_id bigint unsigned, txid varchar(500), hex varchar(1000), address varchar(500), value float(20,10));
//alter table xpm.receipts add unique key( hex(200) );



//php ./insertTrans.php $1 $txid ${hexArray[$j]} ${addressesArray[$j]} ${valuesArray[$j]})
//$block_id = $argv[1];
//$txid = $argv[2];
//$hex = $argv[3];
//$address = $argv[4];
//$value = $argv[5];

$query = "replace into receipts ( block_id, txid, hex, address, value ) values ( ?, ?, ?, ?, ? )";

$array = array($block_id, $txid, $hex, $address, $value);

$sth = $pdo->prepare($query);

$sth->execute($array);

if( !$sth )
{
	file_put_contents( 'debug',  $pdo->errorInfo() . $query . "\n" . print_r($array, 1), FILE_APPEND );
}
	

//file_put_contents( 'debug', $query . print_r($array, 1), FILE_APPEND );

//replace into reciepts ( block_id, txid, hex, address, value ) values ( 2, 'd8cf743fbfeabd2c9a3927b879778a079b8e930596ae476a6fb5b1dbf2a9e2aa', '2102812a91a648c7d136c00c05331247f64f93cc75f6d60bc435e589921405b50e3cac', 'AaigSgLkYT638VT7DswGGzLszUXdDexo4b', '20.38' )
