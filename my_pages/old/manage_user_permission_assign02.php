<?php

if($odr->IsDataAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');

	?>

	<hr>

	<h3>User Role Assign</h3>

	<?php $odr->AddNewUser(); ?>

	<form action="" method="POST">
	<div class="col-md-6">
		<?php $odr->UserRoleAssign() ?>

		<form action="" method="POST">
			<div class="form-group">
			    <label for="exampleInputName">Select Role</label>
			    <select type="text" class="form-control" name="user">
			    	<option>-Please Select-</option>
			    	<?php $odr->ViewRoleList(); ?>
			    </select>
		  	</div>

			<table class="table table-bordered">
			  <tr>
			  		<th>SL</th>
			  		<th>Check</th>
			  		<th>Permission</th>
			  <tr>
			  <?php $odr->PermissionViewToAssign(); ?>
			</table>
			<input type="submit" class="btn btn-default" name="assign_role" value="Save">
		</form>
	</div>

	<div class="col-sm-6">
		<form action="" method="POST">
			<div class="form-group">
				<label for="exampleInputName">Select Role:</label>
				<select type="text" class="form-control" name="role">
					<option value="0">-Please Select-</option>
			    	<?php $odr->ViewRoleList(); ?>
				</select>
			</div>
			<input type="submit" class="btn btn-default" name="view_assigned_role" value="View">
			<hr>
		</form>

		<?php $odr->UserRemoveRoleAssign() ?>
		<?php //$adm->AdminUnsetQuestionFromGroup() ?>
		
		<?php $odr->ViewAssignedRole(); ?>
		
		
	</div>
</form>

<?php

}

?>


