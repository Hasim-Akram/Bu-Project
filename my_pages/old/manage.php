<?php

if($odr->IsUserAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('user_manage_navigation.php');

	if(isset($_GET['del_id'])){
		$id = $_GET['del_id'];

		if($id == $_SESSION['id']){
			echo "somthing";
		}else{
			$odr->Delete($id,'tbl_user_info');
		}
		
	}


	?>

	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> User </li>
	             <li class="active"><i class="fa fa-file"></i> View User </li>
	         </ol>
	         <h3 class="page-header">View User <small>  </small></h3>
	    </div>
	</div>

	<table class="table table-bordered" style="overflow:auto; display:inline-block;  width:; height:400px;">
		<tr>
			<th>Full Name</th>
			<th>User Name</th>
			<th>Mobile</th>
			<th>Role</th>
			<th>Address</th>
			<th>Is Active</th>
			<th>Action</th>
		</tr>
		<?php $odr->ManageUserDataView(); ?>
	</table>

<?php

}

?>


