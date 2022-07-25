<?php

if($odr->IsDataAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');
	if(isset($_GET['edit_id'])){
		$id = $_GET['edit_id'];
		$sql_view_data = mysql_query("SELECT * From tbl_territory_officers_info WHERE id='$id' ");
		$data = mysql_fetch_object($sql_view_data);
	}
	?>
	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> Update Territory Officre </li>
	         </ol>
	         <h3 class="page-header">Update Territory officer <small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		
		<?php $odr->UpdateTerritoryOfficer(); ?>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
		    <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>" >
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
		    <input type="text" class="form-control" name="address" value="<?php echo $data->address; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mobil Number</label>
		    <input type="text" class="form-control" name="mobile" value="<?php echo $data->mobile; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputName">Select House:</label>
			<select type="text" class="form-control" name="house">
				<option value="0">-Please Select-</option>
			   	<?php $odr->ViewHouseDetailesList(); ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputName">Category:</label>
			<select type="text" class="form-control" name="category">
				<option
					<?php 
						if($data->category == 'Territory officer'){
							echo "selected";
						}
					?>
				>Territory officer</option>
				
				<option
					<?php 
						if($data->category == 'Line man'){
							echo "selected";
						}
					?>
				>Line man</option>
				
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Active</label>
		    <input type="checkbox" name="active" value="1"
		    	 <?php
		    	 	if($data->is_active == '1'){
		    	 		echo "checked";
		    	 	}else{ echo "unchecked";}
		    	 ?>
		     >
		</div>
		
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $data->id; ?>">
		    <input type="submit" class="btn btn-primary" name="update_territory_officer" Value="Update">
		</div>
	
		
	</div>
	</form>

<?php

}

?>


