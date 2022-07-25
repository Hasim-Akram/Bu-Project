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
	             <li class="active"><i class="fa fa-file"></i> User </li>
	             <li class="active"><i class="fa fa-file"></i> Permission Assign </li>
	         </ol>
	         <h3 class="page-header">Permission Assign <small>  </small></h3>
	    </div>
	</div>

	

	<form action="" method="POST">

	<div class="col-md-6">
		<?php $odr->PermissionAssign() ?>

		<form action="" method="POST">
			<div class="form-group">
			    <label for="exampleInputName">Select Role</label>
			    <select type="text" class="form-control" name="role">
			    	<option value='0'>-Please Select-</option>
			    		<?php
			    			/*
			    			if(!isset($_POST['role'])){
			    				echo "<option value='0'>-Please Select-</option>";
			    			}else{
			    				$role = mysql_fetch_object(mysql_query("SELECT role_name FROM tbl_role where id ='$_POST[role]' "));
			    				echo "<option>".$role->role_name."</option>";
			    			}
			    			*/
			    			/*
			    			if(isset($_POST['role'])){
			    				$role = mysql_fetch_object(mysql_query("SELECT role_name FROM tbl_role where id ='$_POST[role]' "));
			    				echo "<option>".$role->role_name."</option>";
			    			}
			    			*/
			    		?>
			    	<?php $odr->ViewRoleList(); ?>
			    </select>
		  	</div>
		  	<div class="form-group">
			    <input type="submit" class="btn btn-default" name="search_permission" value="Search">
		  	</div>
		</form>
		
		<?php $odr->ViewAssignedPermission(); ?>
		<br>
	</div>

	
</form>

<?php

}

?>


