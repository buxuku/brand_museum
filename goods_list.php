<?php
require("common/init.php");
$brand_id = intval($_GET['brand_id']);
$brand_name = $_GET['brand_name'];
if(!$brand_id){
	die("brand_id非法");
}
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);

$sql="SELECT c.id, c.`name`, c.price, c.tag_price, c.ratio, c.settlement, pic.goods_pics, b.show_name FROM commodity AS c LEFT JOIN ( SELECT GROUP_CONCAT(p.path) AS goods_pics, p.commodity_id AS goods_id FROM goods_pictures AS p WHERE p.type = 'goods' GROUP BY p.commodity_id ) AS pic ON pic.goods_id = c.id LEFT JOIN brand AS b ON c.brand_id = b.id WHERE c.id IN (".$brandList[$brand_id].")";
$result = mysql_query($sql,$conn); 
while($row = mysql_fetch_array($result)){
	echo $row['name'];
}
?>
<!DOCTYPE html>
<html>
     <head>
         <title><?php echo $brand_name ?></title>
     </head>
     <body>
     </body>
</html>