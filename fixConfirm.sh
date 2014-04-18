#!/bin/bash
cd /home/dan/xpm-bal/
export PATH=$PATH:./

#THIS SCRIPT SHOULD FIND THE MIN AND MAX ID OF BLOCKS THAT ARE OLDER THAN 3 MINUTES AND HAVE BEEN CONFIRMED LESS THAN 20 TIMES

j=$(php ./getInfo.php notConfirmed)

#echo $j
#exit

if [[ ',' != $j ]]; then

min=${j%,*}
max=${j#*,}

#echo $min
#echo $max
#exit

for((i=$min; i<=$max; i++)); do

	JSON=$(block2JSON.sh $i)

done

fi
