<?php

if($odr->IsDataAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
	include ('data_navigation.php');

	if(isset($_GET['del_id'])){
		$id = $_GET['del_id'];
		$odr->Delete($id,'tbl_main');
	}


	?>

	<div class="row">
	    <div class="col-lg-12">
	         
	         <ol class="breadcrumb">
	             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
	             <li class="active"><i class="fa fa-file"></i> Data </li>
	             <li class="active"><i class="fa fa-file"></i> View Data </li>
	         </ol>
	         <h3 class="page-header"> Data <small> This is Example page for manage permission </small></h3>
	    </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
	        <div class="table-responsive">
	        	<table class="table table-bordered table-hover" style="overflow:auto; display:inline-block;  width:100%; height:400px;">
	                 <thead>
	                    <tr>
							<th>SL</th>
							<th>Field 1</th>
							<th>Field 2</th>
							<th>Field 3</th>
							<th>Field 4</th>
							<th>Field 5</th>
							<th>Field 6</th>
							<th>Field 7</th>
							<th>Action</th>
						</tr>
	                </thead>
	                <tbody>
	                	<?php $odr->MainTableDataView(); ?>
	                </tbody>
	            </table>
	        </div>
	    </div>			

	</div>
	

<?php

}

?>


