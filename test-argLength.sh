#!/bin/bash
#{
export PATH=$PATH:./:/usr/bin

#1) primecoind getblockhash
blockhash=$(primecoind getblockhash $1)

: || {
grep -B1 rgu debug2
138241
./block2JSON.sh: line 37: /usr/bin/primecoind: Argument list too long
--
160236
./block2JSON.sh: line 37: /usr/bin/primecoind: Argument list too long
--
160559
./block2JSON.sh: line 37: /usr/bin/primecoind: Argument list too long
}

#2) primecoind getblock
#testing - a transaction that i know about
#blockhash="abae9a5b0bc6ee0a1aa1461778631f9f1fa83f426a6bd2613b1ec193b5560b17"
block=$(primecoind getblock $blockhash)
trans=$(echo $block | jq '.tx')

confirmations=$(echo $block | jq '.confirmations')
time=$(echo $block | jq '.time')
prev=$(echo $block | jq '.previousblockhash')
next=$(echo $block | jq '.nextblockhash')

#echo $1 $blockhash $confirmations $time $prev $next
#exit
php ./insertBlock.php $1 $blockhash $confirmations $time $prev $next


transArray=( $( echo $trans | jq -r '.[]' ) )

#echo ${transArray[@]} > /var/www/html/xpm-bal/debug

for i in ${transArray[@]}; do
	#echo $i

	#3) primecoind getrawtransaction	
	raw=$(primecoind getrawtransaction "$i")
	#echo $raw
	
	#4) primecoind decoderawtransaction
	echo $i
	#echo ${#raw}
	
	#exit
	singleTrans=$(primecoind decoderawtransaction "$raw")
	
	echo $i
	#exit
	
	#echo primecoind decoderawtransaction $raw
	
	#echo $singleTrans  >> /var/www/html/xpm-bal/debug
	
	#top level transaction id
	txid=$( echo $singleTrans | jq -r '.txid' )
	
	addressesArray=( $( echo $singleTrans | jq -r '.vout[] .scriptPubKey .addresses[]'  ) )
	valuesArray=( $( echo $singleTrans | jq -r '.vout[] .value'  ) )
	hexArray=( $( echo $singleTrans | jq -r '.vout[] .scriptPubKey .hex'  ) )
	#echo $singleTrans
	
	if [ ${#addressesArray[@]} == ${#valuesArray[@]} ] &&  [ ${#addressesArray[@]} == ${#hexArray[@]} ] && [ ${#valuesArray[@]} == ${#hexArray[@]} ]
	then
		k='feeling fine!'
		#echo $k
		#exit
	else
		echo "NOT"
		exit
	fi
	
	for ((j=0; j<${#addressesArray[@]}; j++)); do
	
		#block_id, tx_id, hex, value, address
		php ./insertTrans.php $1 $txid ${hexArray[$j]} ${addressesArray[$j]} ${valuesArray[$j]}
		#echo

	done

	
	#echo $txid $value $address >> /var/www/html/xpm-bal/debug
	
	#exit
	
done
#} >> debug2


