#!/bin/bash
PRIMEMINEREXISTS=$(ps -A|grep primecoind|wc -l)
#PRIMEMINEREXISTS=$(ps -A)
echo $PRIMEMINEREXISTS

if [ $PRIMEMINEREXISTS -eq 0 ]; then
	#echo "doesn't exist"
	primecoind &
fi

