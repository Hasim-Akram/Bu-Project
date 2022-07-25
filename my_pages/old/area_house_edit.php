<?php

if($odr->IsDataEdit() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');

	if(isset($_GET['edit_id'])){
		$id = $_GET['edit_id'];
		$sql_view_data = mysql_query("SELECT *
		
		FROM tbl_house_info_details AS A 
		INNER JOIN tbl_house_info_region AS B ON A.region_id = B.id 
		INNER JOIN tbl_house_info_area AS C ON A.area_id = C.id
		INNER JOIN tbl_house_info_territory AS D ON A.territory_id = D.id
		INNER JOIN tbl_house_info_house AS E ON A.house_id = E.id 
		WHERE A.id = '$id' ");

		$data = mysql_fetch_object($sql_view_data);
	}

	?>
	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> New House </li>
	         </ol>
	         <h3 class="page-header">New hosue<small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		<?php $odr->HouseAreaUpdate(); ?>
		<!--
		<select>
			<option>-p-</option>
			<?php $odr->HouseListView('territory'); ?>

		</select>
		-->
		
		<div class="form-group">
			<label for="exampleInputEmail1">Region</label>
		    <input list="region" name="region" type="text" class="form-control" value="<?php echo $data->region_name; ?>" required>
			<datalist id="region">
				<?php $odr->HouseListView('region'); ?>
			</datalist>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Area</label>
		    <input list="area" name="area" type="text" class="form-control" value="<?php echo $data->area_name; ?>" required>
			<datalist id="area">
				<?php $odr->HouseListView('area'); ?>
			</datalist>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Territory</label>
		    <input list="territory" name="territory" type="text" class="form-control" value="<?php echo $data->territory_name; ?>" required>
			<datalist id="territory">
				<?php $odr->HouseListView('territory'); ?>
			</datalist>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">House</label>
		    <input list="house" name="house" type="text" class="form-control" value="<?php echo $data->house_name; ?>" required>
		</div>

		<div class="form-group">
		    <input type="hidden" class="btn btn-primary" name="id" value="<?php echo $data->id; ?>">
		    <input type="submit" class="btn btn-primary" name="update_house" Value="Update">
		</div>
	
		
	</div>
</form>

<?php

}

?>


