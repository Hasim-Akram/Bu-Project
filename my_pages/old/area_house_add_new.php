<?php

if($odr->IsDataInsert() == 0)
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
	             <li class="active"><i class="fa fa-file"></i> New House </li>
	         </ol>
	         <h3 class="page-header">New hosue<small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		<?php $odr->HouseAreaAddNew(); ?>
		<!--
		<select>
			<option>-p-</option>
			<?php $odr->HouseListView('territory'); ?>

		</select>
		-->
		
		<div class="form-group">
			<label for="exampleInputEmail1">Region: </label>
		    <input list="region" name="region" type="text" class="form-control" placeholder="Input Region" required>
			<datalist id="region">
				<?php $odr->HouseListView('region'); ?>
			</datalist>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Area: </label>
		    <input list="area" name="area" type="text" class="form-control" placeholder="Input Area" required>
			<datalist id="area">
				<?php $odr->HouseListView('area'); ?>
			</datalist>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Territory: </label>
		    <input list="territory" name="territory" type="text" class="form-control" placeholder="Input Territory" required>
			<datalist id="territory">
				<?php $odr->HouseListView('territory'); ?>
			</datalist>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">House: </label>
		    <input list="house" name="house" type="text" class="form-control" placeholder="Input House" required>
		</div>

		<div class="form-group">
		    <input type="submit" class="btn btn-primary" name="save_house" Value="Save">
		</div>
	
		
	</div>
</form>

<?php

}

?>


