<?php
require("common/init.php");
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);
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
					<a>A</a>
					<a>B</a>
					<a>C</a>
					<a>D</a>
					<a>E</a>
					<a>F</a>
					<a>G</a>
					<a>H</a>
					<a>I</a>
					<a>J</a>
					<a>K</a>
					<a>L</a>
					<a>M</a>
					<a>N</a>
					<a>O</a>
					<a>P</a>
					<a>Q</a>
					<a>R</a>
					<a>S</a>
					<a>T</a>
					<a>U</a>
					<a>V</a>
					<a>W</a>
					<a>X</a>
					<a>Y</a>
					<a>Z</a>
				</div>
				<div class="mui-indexed-list-alert"></div>
				<div class="mui-indexed-list-inner">
					<div class="mui-indexed-list-empty-alert">没有数据</div>
					<ul class="mui-table-view gaia-table-view">
                        <?php
                            foreach($brand as $key=>$value){
                        ?>
                            <li data-group="<?php echo $key?>" class="mui-table-view-divider mui-indexed-list-group"><?php echo $key?></li>
                            <?php
                                $brandGruop = implode(",", $value);
                                $sql ="select id,logo_path,show_name from brand where 1 and id IN (".$brandGruop.")";
                                $result = mysql_query($sql,$conn); 
                                while($row = mysql_fetch_array($result)){
                                ?>
                                    <li class="mui-table-view-cell mui-indexed-list-item">
                                            <div class="mui-card">
                                                <a href="goods_list.php?brand_id=<?php echo $row['id'] ?>&brand_name=<?php echo $row['show_name'] ?>">
                                                    <div class="mui-card-content">
                                                        <img src="<?php echo $row['logo_path'] ?>"/>
                                                    </div>
                                                    <div class="gaia-card-footer"><?php echo $row['show_name'] ?></div>
                                                </a>
                                            </div>
                                    </li>
                                <?php }
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
