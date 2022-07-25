<?php

if($odr->IsDataAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('data_navigation.php');

	if(isset($_GET['edit_id'])){
		$id = $_GET['edit_id'];
		$sql_view_data = mysql_query("SELECT * From tbl_main WHERE id='$id' ");
		$data = mysql_fetch_object($sql_view_data);
	}


	?>

	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> View Data </li>
	             <li class="active"><i class="fa fa-file"></i> Edit </li>
	         </ol>
	         <h3 class="page-header"> Update Data <small>  </small></h3>
	    </div>
	</div>

	<?php $odr->UpdateUser() ?>
	<form action="" method="POST">
		
	<div class="col-md-6">
		<div class="form-group">
			<label for="exampleInputEmail1">Field 1</label>
		    <input type="text" class="form-control" name="fld1" value="<?php echo $data->field1; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 2</label>
		    <input type="text" class="form-control" name="fld2" value="<?php echo $data->field2; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 3</label>
		    <input type="text" class="form-control" name="fld3" value="<?php echo $data->field3; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 4</label>
		    <input type="text" class="form-control" name="fld4" value="<?php echo $data->field4; ?>">
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="exampleInputEmail1">Field 5</label>
		    <input type="text" class="form-control" name="fld5" value="<?php echo $data->field5; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 6</label>
		    <input type="text" class="form-control" name="fld6" value="<?php echo $data->field6; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 7</label>
		    <input type="text" class="form-control" name="fld7" value="<?php echo $data->field7; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">--</label><br>
			<input type="hidden" name="id" value="<?php echo $data->id; ?>">
		    <input type="submit" class="btn btn-primary" name="update" Value="Update">
		</div>
	</div>
</form>

<div style="clear:both"></div>
<hr>

<?php

}

?>


