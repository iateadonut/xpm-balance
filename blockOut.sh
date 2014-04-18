#!/bin/bash
#THIS FILE IS RUN WHEN A NEW BLOCK IS FOUND - THE BLOCK NUMBER SHOULD BE FED TO block2JSON.sh
#exit

cd /home/xpm/xpm-bal/
export PATH=$PATH:/home/xpm/xpm-bal/:./

blockNumber=$(primecoind getblockcount)
echo $blockNumber >> /home/xpm/xpm-bal/blockOut
$(php ./block2JSON.php $blockNumber)


