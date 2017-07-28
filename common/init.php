<?php
require("db_config.php");
define("IMG_PREFIX","//uploaded.gaiasys.cn/retail/images/");
$file = 'brand.txt'; 
$content = file_get_contents($file); 

$array = explode("\n", $content); 
$brand = array();
$brandList=array();
for($i=0; $i<count($array); $i++) 
{ 
	$row=$array[$i];
	$brand_name=explode(',', $row);
	$brandIdList=explode(',', $row,3);
	$brandList[$brand_name[1]]=$brandIdList[2];
	if(isset($brand[$brand_name[0]])){
		Array_push($brand[$brand_name[0]],$brand_name[1]);
	}else{
		$brand[$brand_name[0]]=array($brand_name[1]);
	}
}