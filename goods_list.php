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

function getStoreDivided($price,$settlement,$ratio){
	$storeDivided=0;
	switch ($settlement) {
		case 1:
			$storeDivided=$price*($ratio*0.01-0.025);
			break;
		
		default:
			$storeDivided=$ratio*(1-0.05);
			break;
	}
	return $storeDivided;
}

$sql="SELECT c.id, c.`name`, c.price, c.tag_price, c.ratio, c.settlement, pic.goods_pics, b.show_name FROM commodity AS c LEFT JOIN ( SELECT GROUP_CONCAT(p.path) AS goods_pics, p.commodity_id AS goods_id FROM goods_pictures AS p WHERE p.type = 'goods' GROUP BY p.commodity_id ) AS pic ON pic.goods_id = c.id LEFT JOIN brand AS b ON c.brand_id = b.id WHERE c.id IN (".$brandList[$brand_id].")";
$result = mysql_query($sql,$conn);
$goodsList=array();
while($row = mysql_fetch_array($result)){
	$goodsList[]=array(
		"id"=>$row['id'],
		"name"=>$row['name'],
		"price"=>$row['price'],
		"tag_price"=>$row['tag_price'],
		"goods_pics"=>explode(",", $row['goods_pics']),
		"StoreDivided"=>getStoreDivided($row['price'],$row['settlement'],$row['ratio']),
		"brand_name"=>$row['show_name']
	);
}
if(count($goodsList)==0){
	die("暂无数据！");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $brand_name ?></title>
		<link rel="icon" type="image/ico" href="img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/common.css"/>
		<link rel="stylesheet" type="text/css" href="css/brandDetail.css"/>
	</head>
	<body>
		<header id="header" class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left
				gaia-action-back"></a>
			<h1 class="mui-title"><?php echo $brand_name ?></h1>
		</header>
		<div class="mui-content gaia-brandDetail-content">
			<?php foreach($goodsList as $value){
			?>
				<div class="mui-card">
					<a href="#">
						<div class="mui-card-content">
							<?php foreach($value['goods_pics'] as $key=>$img){
								if($key==3){
									break;
								}
							?>
							<img src="<?php echo IMG_PREFIX.$img; ?>"/>
							<?php } ?>
						</div>
						<div class="mui-card-footer">
							<p class="gaia-footer-title">
								<span class="mui-badge gaia-footer-badge"><?php echo $value['brand_name'] ?></span>
								<?php echo $value['name'] ?></p>
							<div class="mui-row gaia-footer-prices">
								<div class="mui-col-xs-4 price1">直营价:￥<?php echo round($value['price'],2) ?></div>
								<div class="mui-col-xs-4 price2">利润:￥<?php echo round($value['StoreDivided'],2) ?></div>
								<div class="mui-col-xs-4 price3">吊牌价:￥<?php echo round($value['tag_price'],2) ?></div>
							</div>
						</div>
					</a>
				</div>
			<?php
				}
			?>
		</div>
		<script src="js/mui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/brandDetail.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>