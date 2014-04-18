#!/bin/bash
export PATH=$PATH:./

#test to see if array of addresses and values always match up in vout in block

blockcount=$(primecoind getblockcount)

#echo $blockcount
#exit

for((i=1; i<$blockcount; i++)); do
	#echo $i
	
	JSON=$(block2JSON.sh $i)
	
	#echo $JSON
	echo $i of $blockcount
	
	#if [ $i == 2 ]; then
	#	exit
	#fi

done
