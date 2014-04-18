<?php

//https://en.bitcoin.it/wiki/API_reference_(JSON-RPC)

//https://github.com/aceat64/EasyBitcoin-PHP

require_once('easybitcoin.php');

$primecoin = new Bitcoin('primecoinrpc','3G2RcmdEjD7uG5Gum6Hx5R9vdb152tWLlkj7890h', '127.0.0.1', '8500' );
//primecoinrpc
//3G2RcmdEjD7uG5Gum6Hx5R9vdb152tWL6xnbz94LCwBP

//print_r( $primecoin->getinfo() );

//print_r( $primecoin->

//$block_id = 222798;
//FOR CALLING FROM blockout.sh
if( !isset($block_id) )
{
	$block_id = $argv[1];
	//echo $block_id;
}
file_put_contents( 'log',  "$block_id\n", FILE_APPEND );
//echo $block_id."\n";

//$blockhash = $primecoin->getblockhash($block_id);
$blockhash = exec('primecoind getblockhash ' . $block_id);
//$blockhash = $primecoin->

//echo $blockhash ."\n";

//echo $blockhash; exit;

$block = $primecoin->getblock($blockhash);

//print_r($block); exit;

$transArray = $block['tx'];

$confirmations	= $block['confirmations'];
$time			= $block['time'];
$prev			= $block['previousblockhash'];

isset($block['nextblockhash']) ? $next = $block['nextblockhash'] : $next = '';

include('insertBlock.php');
file_put_contents( 'log',  "done inserting block $block_id\n", FILE_APPEND );

foreach($transArray as $trans)
{
	
	$raw = $primecoin->getrawtransaction($trans);
	
	//print_r($raw);
	
	$singleTrans = $primecoin->decoderawtransaction($raw);
	
	//print_r($singleTrans);
	
	$txid = $singleTrans['txid'];
	
	//echo $txid."\n";

	$receiptsArray = $singleTrans['vout'];
	
	foreach($receiptsArray as $key=>$array1)
	{
		
		if ( count($array1['scriptPubKey']['addresses']) > 1 )
		{
			echo "ERROR: more than 1 address in block number $blocknumber";
		}
		
		//print_r($array1);
		
		$value	= $array1['value'];
		$hex	= $array1['scriptPubKey']['hex'];
		$address	= $array1['scriptPubKey']['addresses'][0];
		
		include('insertTrans.php');
		//$blocknumber $txid $hex $address $value;
		
	}
	
	//addressesArray=( $( echo $singleTrans | jq -r '.vout[] .scriptPubKey .addresses[]'  ) )
	//valuesArray=( $( echo $singleTrans | jq -r '.vout[] .value'  ) )
	//hexArray=( $( echo $singleTrans | jq -r '.vout[] .scriptPubKey .hex'  ) )
	
}

file_put_contents( 'log',  "inserted all transactions for $block_id \n", FILE_APPEND );

