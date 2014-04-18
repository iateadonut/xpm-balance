#!/bin/bash
export PATH=$PATH:./

#test to see if array of addresses and values always match up in vout in block

blockcount=$(primecoind getblockcount)

for((i=1; i<$blockcount; i++)); do
	#echo $i
	
	works=$(block2JSON.sh $i)
	

	if [[ $works == "NOT" ]]; then
	
		echo $i $works
		exit
	else
		echo $i $works
	fi
	#exit;
	
	
	#exit
done
