<?php
require("common/init.php");
$brand_id = intval($_GET['brand_id']);
if(!$brand_id){
	die("brand_id非法");
}
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

$sql="SELECT c.id, c.`name`, c.price,c.ratio, c.settlement, pic.goods_pics, b.show_name FROM commodity AS c LEFT JOIN ( SELECT GROUP_CONCAT(p.path) AS goods_pics, p.commodity_id AS goods_id FROM goods_pictures AS p WHERE p.type = 'goods' GROUP BY p.commodity_id ) AS pic ON pic.goods_id = c.id LEFT JOIN brand AS b ON c.brand_id = b.id WHERE c.id IN (".$brandList[$brand_id].")";
$result = mysqli_query($conn,$sql);
if(!$result){
	die("该品牌下暂无商品!");
}
$goodsList=array();
while($row = mysqli_fetch_array($result)){
	$goodsList[]=array(
		"id"=>$row['id'],
		"name"=>$row['name'],
		"price"=>$row['price'],
		"goods_pics"=>explode(",", $row['goods_pics']),
		"StoreDivided"=>getStoreDivided($row['price'],$row['settlement'],$row['ratio']),
		"brand_name"=>$row['show_name']
	);
}
if(count($goodsList)==0){
	die("该品牌下暂无商品！");
}
$sql="SELECT show_name from brand WHERE id=".$brand_id;
$result = mysqli_query($conn,$sql);
if($result){
	$row=mysqli_fetch_assoc($result);
}else{
	$row['show_name']="";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $row['show_name'] ?></title>
		<link rel="icon" type="image/ico" href="img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/common.css"/>
		<link rel="stylesheet" type="text/css" href="css/brandDetail.css"/>
	</head>
	<body>
		<header id="header" class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-left-nav mui-pull-left
				gaia-action-back" href="list.php"></a>
			<h1 class="mui-title"><?php echo $row['show_name'] ?></h1>
		</header>
		<div class="mui-content gaia-brandDetail-content">
			<?php foreach($goodsList as $value){
			?>
				<div class="mui-card">
					<a href="gaiastore://goods?id=<?php echo $value['id'] ?>">
						<div class="mui-card-content">
							<?php foreach($value['goods_pics'] as $key=>$img){
								if($key==3){
									break;
								}
							?>
							<div class="gaia-card-img-box">
								<img src="<?php echo $img?IMG_PREFIX.getThumbImg($img,400):'img/default_img.jpg'; ?>" onerror="onerror=null;src='img/default_img.jpg'"/>
							</div>
							<?php } ?>
						</div>
						<div class="mui-card-footer">
							<p class="gaia-footer-title">
								<span class="mui-badge gaia-footer-badge"><?php echo $value['brand_name'] ?></span>
								<?php echo $value['name'] ?></p>
						</div>
					</a>
				</div>
			<?php
				}
			?>
		</div>
		<div class="ad mui-row">
			<div class="mui-col-xs-1 gaia-ad-close-box">
				<span class="mui-icon mui-icon-closeempty gaia-ad-close"></span>
			</div>
			<div class="mui-col-xs-2 gaia-ad-logo-box">
					<img src="img/ad-logo.png"/>
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
		<script src="js/brandDetail.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		    var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
		    document.write(unescape("%3Cspan style='display:none;' id='cnzz_stat_icon_1262566772'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol
		            + "s13.cnzz.com/z_stat.php%3Fid%3D1262566772' type='text/javascript'%3E%3C/script%3E"));
		</script>
	</body>
</html>