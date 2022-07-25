<?php

if($odr->IsDataAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('data_navigation.php');

	?>

	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> New Data </li>
	         </ol>
	         <h3 class="page-header"> Data <small> New data entry </small></h3>
	    </div>
	</div>

	<?php $odr->AddNewUser(); ?>

	<form action="" method="POST">
	<div class="col-md-6">
		<div class="form-group">
			<label for="exampleInputEmail1">Field 1</label>
		    <input type="text" class="form-control" name="fld1" placeholder="Feild 1">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 2</label>
		    <input type="text" class="form-control" name="fld2" placeholder="Feild 2">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 3</label>
		    <input type="text" class="form-control" name="fld3" placeholder="Feild 3">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 4</label>
		    <input type="text" class="form-control" name="fld4" placeholder="Feild 4">
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="save" Value="Save">
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="exampleInputEmail1">Field 5</label>
		    <input type="text" class="form-control" name="fld5" placeholder="Feild 5">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 6</label>
		    <input type="text" class="form-control" name="fld6" placeholder="Feild 6">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 7</label>
		    <input type="text" class="form-control" name="fld7" placeholder="Feild 7">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Field 8</label>
		    <input type="text" class="form-control" name="fld8" placeholder="Feild 8">
		</div>
	</div>
</form>

<div style="clear:both"></div>
<hr>

<?php

}

?>


