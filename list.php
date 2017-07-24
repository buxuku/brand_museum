<?php
$file = 'brand.txt'; 
$content = file_get_contents($file); 

$array = explode("\r\n", $content); 
$brand = array();
$brandList=array();
for($i=0; $i<count($array); $i++) 
{ 
	$row=$array[$i];
	$brand_name=explode(',', $row);
	$brandIdList=explode(',', $row,3);
	$brandList[$brand_name[1]]=$brandIdList[2];
	if(isset($brand[$brand_name[0]])){
		Array_push($brand[$brand_name[0]],$brand_name[1]);
	}else{
		$brand[$brand_name[0]]=array($brand_name[1]);
	}
}
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
     		<?php	for($j=0;$j<count($value);$j++){
     	?>
         	<span><?php echo $value[$j] ?></span>
        <?php 
        		}
        	} 
        ?>
     </body>
</html>