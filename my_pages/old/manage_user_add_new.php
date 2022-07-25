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
	             <li class="active"><i class="fa fa-file"></i> New User </li>
	         </ol>
	         <h3 class="page-header">New User <small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		<?php $odr->AddNewUserManage(); ?>
		<div class="form-group">
			<label for="exampleInputEmail1">Full Name:</label>
		    <input type="text" class="form-control" name="name"
		    <?php
		    	if(isset($_POST['name'])){
		    		echo "value='".$_POST['name']."' ";
		    	}else{
		    		echo "placeholder='Full name' "; 
		    	}
		    ?> required>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">User Name:</label>
		    <input type="text" class="form-control" name="user"
		    <?php
		    	if(isset($_POST['user'])){
		    		echo "value='".$_POST['user']."' ";
		    	}else{
		    		echo "placeholder='User name' "; 
		    	}
		    ?>  required>
		</div>
		<div class="form-group">
			<label for="exampleInputName">Select Role:</label>
			<select type="text" class="form-control" name="role">
				<option value="0">-Please Select-</option>
			   	<?php $odr->ViewRoleList(); ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mobile Number:</label>
		    <input type="text" class="form-control" name="mobile"
		    <?php
		    	if(isset($_POST['mobile'])){
		    		echo "value='".$_POST['mobile']."' ";
		    	}else{
		    		echo "placeholder='Input Mobile number' "; 
		    	}
		    ?>  required>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Address:</label>
		    <input type="text" class="form-control" name="address" 
		    <?php
		    	if(isset($_POST['address'])){
		    		echo "value='".$_POST['address']."' ";
		    	}else{
		    		echo "placeholder='Input Address' "; 
		    	}
		    ?> >
		</div>
		<div class="form-group">
			
		    <label>
		    	<input type="checkbox"name="active" value="1"> Active 
			</label>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Password: </label>
		    <input type="password" class="form-control" name="pass01" placeholder="Password" required>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Confirm Password: </label>
		    <input type="password" class="form-control" name="pass02" placeholder="ConfirmPassword" required>
		</div>
		<div class="form-group">
		    <input type="submit" class="btn btn-primary" name="save" Value="Save">
		</div>
	
	</div>


	</form>

<?php

}

?>


