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
	             <li class="active"><i class="fa fa-file"></i> Settings </li>
	         </ol>
	         <h3 class="page-header">Settings <small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		<?php $odr->MyAccountChangePassword(); ?>
		<div class="form-group">
			<label for="exampleInputEmail1">Old Password: </label>
		    <input type="password" class="form-control" name="old_pass" placeholder="Input Your Current Password" required>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">New Password: </label>
		    <input type="password" class="form-control" name="new_pass01" placeholder="New Password" required>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Confirm Password: </label>
		    <input type="password" class="form-control" name="new_pass02" placeholder="ConfirmPassword" required>
		</div>
		<div class="form-group">
			
			<input type="hidden" name="id" Value="<?php echo $u_info->id; ?>">
		    <input type="submit" class="btn btn-primary" name="change_pass" Value="Change">
		</div>
		
		<hr>
	</div>


	</form>

<?php

}

?>


