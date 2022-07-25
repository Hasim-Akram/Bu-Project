<?php

if($odr->IsOrderSubmit() == 0)
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
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> Order Collection </li>
	         </ol>
	         <h3 class="page-header">Order Collection Panel<small>  </small></h3>
	    </div>
	</div>

	
	
	<form action="" method="POST">
	
	<div class="col-md-6">
		
		<?php $odr->SendMessageOrder(); ?>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Mobile Number: </label>
		    <input type="text" class="form-control" name="mobile"
		    <?php
		    	if(isset($_POST['mobile'])){
		    		echo " value='".$_POST['mobile']."'";
		    	}else{ echo " value='' "; }
		    ?>
		     placeholder="Input mobile number" required>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Order Message: </label>
			<input type="text" class="form-control" name="message"
		    <?php
		    	if(isset($_POST['message'])){
		    		echo " value='".$_POST['message']."'";
		    	}else{ echo " value='' "; }
		    ?>
		      placeholder="Type your Order message here">
		</div>
		<div class="form-group">
		    <input type="submit" class="btn btn-primary" name="mssg_order" Value="Send Order">
		</div>
	
		
	</div>
</form>

<?php

}

?>


