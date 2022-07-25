<?php

if($odr->IsUserAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');
	$id = $u_info->id;
	$sql_view_data = mysql_query("SELECT * From tbl_user_info WHERE id='$id' ");
	$data = mysql_fetch_object($sql_view_data);


	?>

	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Update Profile </li>
	         </ol>
	         <h3 class="page-header"> <?php echo $u_info->full_name; ?> 
	</h3>
	    </div>
	</div>

	<div class="row">
		<form action="" method="POST">
		<div class="col-md-6">
		

			<?php $odr->MyAccountUpdateProfile(); ?>
			<div class="form-group">
				<label for="exampleInputEmail1">Full Name: </label>
			    <input type="text" class="form-control" name="name" value="<?php echo$data->full_name; ?>" required>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Address: </label>
			    <input type="text" class="form-control" name="address" value="<?php echo$data->address; ?>" required>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Molile Number: </label>
			    <input type="text" class="form-control" name="mobile" value="<?php echo$data->mobile; ?>" required>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">User Name:</label>
			    <input type="text" class="form-control" name="user" value="<?php echo$data->user_name; ?>" required>
			</div>

			<div class="form-group">
				<input type="hidden" name="id" Value="<?php echo $data->id; ?>">
				<input type="submit" class="btn btn-primary" name="update_profile" Value="Update">
			</div>
		</div>

		</form>
	<div>

	<div style="clear:both"></div>

<?php

}

?>


