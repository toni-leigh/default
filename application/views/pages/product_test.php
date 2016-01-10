<style>
	.filters_left { width:180px; float:left; }
	.filters_left h2 { width:100%; float:left; border-bottom:1px solid #888; margin:8px 0px; padding-bottom:5px; font-weight:bold; }
	.filter { width:100%; float:left; padding-bottom:5px; }
	.filtered_by { color:#0088cc; font-weight:bold; }
	.products_right { width:720px; float:right; }
	.product { 
		width:72px; height:72px; float:left; 
		opacity:0.8; cursor:pointer; 
		padding:9px; 
		box-shadow:inset 0 0 10px 0 #222; }
	.product:hover { opacity:1; }
</style>

<div class='filters_left'>
	<?php
	$old_vtype='';
	foreach ($variations as $key=>$var)
	{
		$vtype=$var['details']['var_type'];

		if ($vtype!=$old_vtype)
		{
			echo "<h2>".$vtype."</h2>";
		}

		$selected=(in_array($key,$filters)) ? "filtered_by" : "";

		echo "<span class='filter ".$selected."'>".$var['details']['var_value']." [".$var['count']."]</span>";

		$old_vtype=$vtype;
	}
	?>
</div>
<div class='products_right'>
<?php
	echo "products: ".$pcount."</br>";
	echo "products filtered: ".$pcount_restrict."</br>";
	echo "full filter count: ".$prestrict."</br>";
	echo "variations: ".$vcount."</br>";
	$c=1;
	foreach ($product_list as $pl)
	{
        echo "<div title='".$pl['nvar_keys']."' class='product' style='background-color:rgb(".((($c%3)*50)+50).",".((($c%23)*7)+20).",".((($c%85)*2)+100).");'>";
		echo $pl['name'];
        echo "</div>";
        $c++;
	}
?>
</div>