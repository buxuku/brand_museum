<?php
require("db_config.php");
define("IMG_PREFIX","//uploaded.gaiasys.cn/retail/images/");

$url ="http://brand.com/data.json";
$contents = file_get_contents($url);
echo $contents;

$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database,$mysql_port) or die("error connecting");
mysqli_query($conn,'set names utf8');

$sql ="select * from activity_description where activity_id=14";

$result = mysqli_query($conn,$sql);
if($result){
	$array=array();
	while($row = mysqli_fetch_array($result)){
		if($row['name'] && $row['content']){
			$array[]=$row['name'].",".$row['content'].",".$row['note'];
		}
	}
}else{
	die("没有查询到活动数据");
}
$brand = array();
$brandList=array();
for($i=0; $i<count($array); $i++)
{ 
	$row=$array[$i];
	$brand_name=explode(',', $row);
	$brandIdList=explode(',', $row,3);
	if(count($brandIdList)<2){
		continue;
	}
	$brandList[intval($brand_name[1])]=count($brandIdList)>2?$brandIdList[2]:"";
	if(isset($brand[$brand_name[0]])){
		Array_push($brand[$brand_name[0]],$brand_name[1]);
	}else{
		$brand[$brand_name[0]]=array($brand_name[1]);
	}
}
function getThumbImg($path,$size){
	$size=$size?$size:400;
	$imgInfo=pathinfo($path);
	$imgext=$imgInfo['extension'];
	$imgUrl=str_replace($imgext,$size.".".$imgext,$path);
	return $imgUrl;
}