<?php

if($odr->IsDataAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');

	?>
	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> New Territory Officre </li>
	         </ol>
	         <h3 class="page-header">New Territory officer <small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		
		<?php $odr->AddNewTerritoryOfficer(); ?>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
		    <input type="text" class="form-control" name="name" placeholder="Input name">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
		    <input type="text" class="form-control" name="address" placeholder="Address">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mobil Number</label>
		    <input type="text" class="form-control" name="mobile" placeholder="Input Mobile number">
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
				<option>Territory officer</option>
				<option>Line man</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Active</label>
		    <input type="checkbox" name="active" value="1">
		</div>
		
		<div class="form-group">
		    <input type="submit" class="btn btn-primary" name="save_territory_officer" Value="Save">
		</div>
	
		
	</div>
	</form>

<?php

}

?>


