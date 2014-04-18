#!/bin/bash
cd /home/dan/xpm-bal/
export PATH=$PATH:./

j=$(php ./getInfo.php getOneBroken)
#echo $j

if [[ 0 != $j ]]; then
	#echo $j
	$(block2JSON.sh $j)
fi

