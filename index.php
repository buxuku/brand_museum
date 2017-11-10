<?php
require("common/config.php");
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
$type = $_GET['type'];
if( empty($type) || !isset($typeData[$type])){
	die("统计类型错误");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $typeData[$type] ?></title>
		<link rel="icon" type="image/ico" href="img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/mui.indexedlist.css"/>
		<link rel="stylesheet" type="text/css" href="css/common.css"/>
		<link rel="stylesheet" type="text/css" href="css/brandDetail.css"/>
	</head>
	<body>
		<header id="header" class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-left-nav mui-pull-left
				gaia-action-back" href="javascript:history.back(-1)">&nbsp;返回</a>
		</header>
<?php

$url = DATA_ROOT.$type;
$contents = file_get_contents($url);
$contents=json_decode($contents,true);

$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database,$mysql_port) or die("error connecting");
mysqli_query($conn,'set names utf8');

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
$ext_where="c.id IN (".implode(',',$contents).") ORDER BY locate(c.id,'".implode(',',$contents)."')";
$sql="SELECT c.id,c.article_number, c.`name`, c.price,c.ratio, c.settlement, pic.goods_pics, b.show_name FROM commodity AS c LEFT JOIN ( SELECT GROUP_CONCAT(p.path) AS goods_pics, p.commodity_id AS goods_id FROM goods_pictures AS p WHERE p.type = 'goods' GROUP BY p.commodity_id ) AS pic ON pic.goods_id = c.id LEFT JOIN brand AS b ON c.brand_id = b.id WHERE ".$ext_where;

$result = mysqli_query($conn,$sql);
if(!$result){
	die("该统计下暂无商品!");
}
$goodsList=array();
while($row = mysqli_fetch_array($result)){
	$goodsList[]=array(
		"id"=>$row['id'],
		"name"=>$row['name'],
		"price"=>$row['price'],
		"article_number"=>$row['article_number'],
		"goods_pics"=>explode(",", $row['goods_pics']),
		"StoreDivided"=>getStoreDivided($row['price'],$row['settlement'],$row['ratio']),
		"brand_name"=>$row['show_name']
	);
}
if(count($goodsList)==0){
	die("该统计下暂无商品");
}
?>
		<div id='detailList' class="mui-indexed-list">
		<div class="mui-indexed-list-search mui-input-row mui-search gaia-indexed-list-search">
				<input type="search" class="mui-input-clear mui-indexed-list-search-input" 
					placeholder="请通过货号选择商品下单进货！">
		</div>
		<div class="mui-indexed-list-bar gaia-indexed-detail-bar"></div>
		<div class="mui-indexed-list-alert"></div>
		<div class="mui-content gaia-brandDetail-content mui-indexed-list-inner">
			<div class="mui-indexed-list-empty-alert">没有数据</div>
			<ul class="mui-table-view">
			<?php foreach($goodsList as $value){
			?>
			<li class="mui-table-view-cell mui-indexed-list-item gaia-indexed-detail-item">
				<div class="mui-card">
					<a href="gaiastore://goods?id=<?php echo $value['id'] ?>">
						<div class="mui-card-content">
							<?php foreach($value['goods_pics'] as $key=>$img){
								if($key==3){
									break;
								}
							?>
							<div class="gaia-card-img-box">
								<span class="vertical"></span>
								<img src="<?php echo $img?IMG_PREFIX.getThumbImg($img,400):'img/default_img.jpg'; ?>"
									onerror="onerror=null;src='img/default_img_2.jpg'"/>
							</div>
							<?php } ?>
						</div>
						<div class="mui-card-footer">
							<p class="gaia-footer-title">
								[货号：<?php echo $value['article_number'] ?>]<?php echo $value['name'] ?></p>
						</div>
					</a>
				</div>
			<?php
				}
			?>
			</ul>	
			</div>
		</div>
		<div class="ad mui-row">
			<div class="mui-col-xs-1 gaia-ad-close-box">
				<span class="mui-icon mui-icon-closeempty gaia-ad-close"></span>
			</div>
			<div class="mui-col-xs-2 gaia-ad-logo-box">
					<img src="img/logo.png"/>
			</div>
			<ul class="gaia-ad-text mui-col-xs-6">
				<li class="gaia-ad-text-title">GAIA店铺端</li>
				<li class="gaia-ad-text-p">帮门店拿到最适销的货！</li>
			</ul>
			<div class="mui-col-xs-3 gaia-ad-download-box">
				<span class="gaia-ad-download">
					<a href="https://store.gaiasys.cn/api/v1/h5/scanDownload">下载</a>
				</span>
			</div>
		</div>
		<script src="js/mui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/mui.indexedlist.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/brandDetail.js" type="text/javascript" charset="utf-8"></script>
		<script src="//s13.cnzz.com/z_stat.php?id=1262566772&web_id=1262566772" language="JavaScript"></script>
	</body>
</html>