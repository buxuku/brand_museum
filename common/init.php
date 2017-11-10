<?php
require("db_config.php");
define("IMG_PREFIX","//uploaded.gaiasys.cn/retail/images/");

$rootUrl="http://192.168.1.18:8080/data/";

$typeData=array(
	"goodsRankOrderByDt" =>"上货时间",
	"goodsRankOrderByPc" => "进货数量",
	"goodsRankOrderBySc" => "销售数量"
);

function getThumbImg($path,$size){
	$size=$size?$size:400;
	$imgInfo=pathinfo($path);
	$imgext=$imgInfo['extension'];
	$imgUrl=str_replace($imgext,$size.".".$imgext,$path);
	return $imgUrl;
}