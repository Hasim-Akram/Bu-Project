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
		$sql_view_data = mysql_query("SELECT * From tbl_user_info AS A LEFT JOIN tbl_role AS B ON A.role=B.id WHERE A.id='$id' ");
		$data = mysql_fetch_object($sql_view_data);
	}


	?>
	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> User </li>
	             <li class="active"><i class="fa fa-file"></i> View User </li>
	         </ol>
	         <h3 class="page-header">Update User <small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		
		<?php $odr->UpdateUserManage(); ?>

		<div class="form-group">
			<label for="exampleInputEmail1">Full Name: </label>
		    <input type="text" class="form-control" name="name" value="<?php echo $data->full_name; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">User Name: </label>
		    <input type="text" class="form-control" name="user" value="<?php echo $data->user_name; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputName">Select Role:</label>
			<select type="text" class="form-control" name="role">
				<option value="<?php echo $data->role; ?>"> <?php echo $data->role_name; ?> </option>
			   	<?php $odr->ViewRoleList(); ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mobile Number: </label>
		    <input type="text" class="form-control" name="mobile" value="<?php echo $data->mobile; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Address: </label>
		    <input type="text" class="form-control" name="address" value="<?php echo $data->address; ?>">
		</div>
		<div class="form-group">
			<label>
		    <input type="checkbox" name="active" value="1"
		    	 <?php
		    	 	if($data->IsActive == '1'){
		    	 		echo "checked";
		    	 	}else{ echo "unchecked";}
		    	 ?>
		     > Active</label>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Password: </label>
		    <input type="password" class="form-control" name="pass01" placeholder="Password">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Confirm Password: </label>
		    <input type="password" class="form-control" name="pass02" placeholder="ConfirmPassword">
		</div>
		<div class="form-group">
		    <input type="hidden" name="id" Value="<?php echo $data->id; ?>">
		    <input type="submit" class="btn btn-primary" name="update_user" Value="Update">
		</div>
		
		
	</div>
</form>

<?php

}

?>


