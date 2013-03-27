<?php
if(strpos($_SERVER['REQUEST_URI'],'?ffilter=')>0){
$path = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,-52);
}else{
$path = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,-43);
}
$root = str_replace('\\', '/',substr(__FILE__,0,-39));

$bReturnAbsolute=false;

$sBaseVirtual0="static/uploads/editor";  //Assuming that the path is http://yourserver/Editor/assets/ ("Relative to Root" Path is required)
$sBase0= $root."static/uploads/editor"; //The real path

$sName0="Gallery";

$sBaseVirtual1="";
$sBase1="";
$sName1="";

$sBaseVirtual2="";
$sBase2="";
$sName2="";

$sBaseVirtual3="";
$sBase3="";
$sName3="";
?>