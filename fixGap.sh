#!/bin/bash
export PATH=$PATH:./


j=$(php ./getInfo.php getGap)

#echo $j
#exit

if [[ ',' != $j ]]; then

min=${j%,*}
max=${j#*,}

#echo $min
#echo $max
#exit

for((i=$min; i<=$max; i++)); do

	echo $i
	JSON=$(php ./block2JSON.php $i)

done

fi
