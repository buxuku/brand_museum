<?php
require("db_config.php");
define("IMG_PREFIX","//uploaded.gaiasys.cn/retail/images/");

$url ="http://brand.com/data.json";
$contents = file_get_contents($url);
$contents=json_decode($contents,true);

$brand = array();
$brandList=array();

for($i=0;$i<count($contents);$i++){
	$brand_name=$contents[$i]['brandLetter'];
	$brandList[$contents[$i]['brandId']]=$contents[$i]['goods'];
	if(isset($brand[$brand_name])){
		Array_push($brand[$brand_name],$contents[$i]['brandId']);
	}else{
		$brand[$brand_name]=array($contents[$i]['brandId']);
	}
}

function getThumbImg($path,$size){
	$size=$size?$size:400;
	$imgInfo=pathinfo($path);
	$imgext=$imgInfo['extension'];
	$imgUrl=str_replace($imgext,$size.".".$imgext,$path);
	return $imgUrl;
}