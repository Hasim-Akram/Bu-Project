<?php

if($odr->IsUserAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');
	
	if(isset($_GET['edit_id'])){
		$id = $_GET['edit_id'];
		$sql_view_data = mysql_query("SELECT * From tbl_role WHERE id='$id' ");
		$data = mysql_fetch_object($sql_view_data);
	}
	?>

	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> User </li>
	             <li class="active"><i class="fa fa-file"></i> Role </li>
	         </ol>
	         <h3 class="page-header">Update Role <small>  </small></h3>
	    </div>
	</div>

	
	<form action="" method="POST">
	<div class="col-md-6">
	

		<?php $odr->UpdateRole(); ?>
		<div class="form-group">
			<label for="exampleInputEmail1">Role Name</label>
		    <input type="text" class="form-control" name="role" value="<?php echo$data->role_name; ?>" required>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Permission</label>
			<?php $odr->ViewAssignedPermission($data->id); ?>
		</div>

		<div class="form-group">
			<input type="hidden" name="id" Value="<?php echo $data->id; ?>">
			<input type="submit" class="btn btn-primary" name="update_role" Value="Update">
		</div>
	</div>

	</form>

	<div style="clear:both"></div><hr>


<?php

}

?>


