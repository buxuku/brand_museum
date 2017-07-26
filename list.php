<?php
require("common/init.php");
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);
?>
<!DOCTYPE html>
<html>
     <head>
         <title><?php echo "222" ?></title>
     </head>
     <body>
     	<?php
     		foreach($brand as $key=>$value){
     	?>
     		<p><?php echo $key?></p>
            <?php
                $brandGruop = implode(",", $value);
                $sql ="select id,logo_path,show_name from brand where 1 and id IN (".$brandGruop.")";
                $result = mysql_query($sql,$conn); 
                while($row = mysql_fetch_array($result)){
                ?>
                    <a href="goods_list.php?brand_id=<?php echo $row['id'] ?>&brand_name=<?php echo $row['show_name'] ?>"><?php echo $row['show_name'] ?></a>
                <?php }
            ?>
     	<?php } ?>
     </body>
</html>