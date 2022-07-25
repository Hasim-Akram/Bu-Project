<?php

if($odr->IsUserAccess() == 0)
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
	             <li class="active"><i class="fa fa-file"></i> Role </li>
	         </ol>
	         <h3 class="page-header">New Role <small>  </small></h3>
	    </div>
	</div>

	
	<form action="" method="POST">
	<div class="col-md-6">

	<?php $odr->AddNewRole(); ?>
		<div class="form-group">
			<label for="exampleInputEmail1">Role Name</label>
		    <input type="text" class="form-control" name="role" 
		    <?php
		    	if(isset($_POST['role'])){
		    		echo "value='".$_POST['role']."' ";
		    	}else{
		    		echo "placeholder='Type your role' "; 
		    	}
		    ?>
		    required>
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Permission</label>
			<?php $odr->ViewPermissionList(); ?>
		</div>

		
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="save_role" Value="Save">
		</div>

	</div>

	</form>




<?php

}

?>


