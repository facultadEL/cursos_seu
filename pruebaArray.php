<?php

$arrayV[0] = "19-07-2015";
$arrayV[1] = "20-07-2015";
$arrayV[2] = "21-07-2015";

if(array_search('18-07-2015',$arrayV)!=false)
{
	echo 'hola';
}
else
{
	echo 'nohola';
}

?>