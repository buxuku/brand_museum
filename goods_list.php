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

$sql="SELECT * FROM commodity WHERE 1 AND id IN (".$brandList[$brand_id].")";
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