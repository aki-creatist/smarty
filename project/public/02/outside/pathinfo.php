<?php
$pathname = pathinfo(__FILE__);
echo $pathname['dirname']    . "\n";
echo $pathname['basename']   . "\n";
echo $pathname['extension']  . "\n";
