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
	             <li class="active"><i class="fa fa-file"></i> Territory Area </li>
	         </ol>
	         <h3 class="page-header">Territory 
	         	
	         </h3>
	    </div>
	</div>

	<small> <a href="index.php?id=area_house_add_new">Add New area</a></small>
	<div class="row">
		<div class="col-md-7">
		
		<?php
		if(isset($_GET['del_id'])){
			$id = $_GET['del_id'];
			$odr->Delete($id,'tbl_house_info_details');
		}
		?>

		<table class="table table-bordered">
			<tr>
				<th>Region</th>
				<th>Area</th>
				<th>Territory</th>
				<th>House</th>
				<th>House ID</th>
				<th>Action</th>
			</tr>
			<?php $odr->ViewHouseDetailesTable(); ?>
		</table>
		</div>
	<div>

	<div style="clear:both"></div><hr>

<?php

}

?>


