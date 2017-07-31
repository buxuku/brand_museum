<?php
require("common/init.php");
$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database,$mysql_port) or die("error connecting");
mysqli_query($conn,'set names utf8');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>品牌馆</title>
		<link rel="icon" type="image/ico" href="img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/mui.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/mui.indexedlist.css"/>
		<link rel="stylesheet" type="text/css" href="css/brandList.css"/>
	</head>
	<body>
		<div class="mui-content">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left 
				gaia-action-back"></a>
			<div id='list' class="mui-indexed-list">
				<div class="mui-indexed-list-search mui-input-row mui-search gaia-indexed-list-search">
					<input type="search" class="mui-input-clear mui-indexed-list-search-input" 
						placeholder="品牌馆">
				</div>
				<div class="mui-indexed-list-bar gaia-indexed-list-bar">
					<?php
                        foreach($brand as $key=>$value){
                    ?>
                        <a><?php echo $key ?>
                    <?php } ?>
				</div>
				<div class="mui-indexed-list-alert"></div>
				<div class="mui-indexed-list-inner">
					<div class="mui-indexed-list-empty-alert">没有数据</div>
					<ul class="mui-table-view gaia-table-view">
                        <?php
                            foreach($brand as $key=>$value){
                        ?>
                            <li data-group="<?php echo $key ?>" class="mui-table-view-divider mui-indexed-list-group"><?php echo $key ?></li>
                            <?php
                                $brandGruop = implode(",", $value);
								if(!$brandGruop){
									die("该品牌下暂无商品！");
								}
                                $sql ="select id,logo_path,show_name from brand where 1 and id IN (".$brandGruop.")";
                                $result = mysqli_query($conn,$sql);
								if($result){
									while($row = mysqli_fetch_array($result)){
									?>
										<li class="mui-table-view-cell mui-indexed-list-item">
												<div class="mui-card">
													<a href="goods_list.php?brand_id=<?php echo $row['id'] ?>&brand_name=<?php echo $row['show_name'] ?>">
														<div class="mui-card-content">
															<img src="<?php echo IMG_PREFIX.$row['logo_path'] ?>"/>
														</div>
														<div class="gaia-card-footer"><?php echo $row['show_name'] ?></div>
													</a>
												</div>
										</li>
									<?php }
								} else {
									echo "该品牌暂无商品";
								}
                            ?>
                        <?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<script src="js/mui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/mui.indexedlist.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/brandList.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
