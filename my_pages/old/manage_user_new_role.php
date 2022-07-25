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
	             <li class="active"><i class="fa fa-file"></i> Role </li>
	         </ol>
	         <h3 class="page-header">Role 
	         	
	         </h3>
	    </div>
	</div>

	<small> <a href="index.php?id=manage_user_add_new_role">Add New role</a></small>
	<div class="row">
		<div class="col-md-7">
		
		<?php
		if(isset($_GET['del_id'])){
			$id = $_GET['del_id'];
			$odr->Delete($id,'tbl_role');
		}
		?>

		<table class="table table-bordered">
			<tr>
				<th>Role</th>
				<th>Action</th>
			</tr>
			<?php $odr->ViewRoleTable(); ?>
		</table>
		</div>
	<div>

	<div style="clear:both"></div><hr>

<?php

}

?>


