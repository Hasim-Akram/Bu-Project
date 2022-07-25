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
	             <li class="active"><i class="fa fa-file"></i> Profile </li>
	         </ol>
	         <h3 class="page-header"> <?php echo $u_info->full_name; ?> 
	         <small><a href="index.php?id=my_profile_edit"> Edit profile</a></small>
	</h3>
	    </div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table border="0" class="table">
 				<tr>
 					<td width="150"> Address :</td>
 					<td> <?php echo $u_info->address; ?></td>
 				</tr>	
 				<tr>
 					<td> Mobile Number :</td>
 					<td> <?php echo $u_info->mobile; ?></td>
 				</tr>

 				<tr>
 					<td> User Name :</td>
 					<td> <?php echo $u_info->user_name; ?></td>
 				</tr>	
			</table>

			<hr>
		</div>
	<div>

	<div style="clear:both"></div>

<?php

}

?>


