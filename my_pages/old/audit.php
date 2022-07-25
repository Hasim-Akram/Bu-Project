<?php

if($odr->IsAuditAccess() == 0)
{
	echo "<meta http-equiv=refresh content=0;url=./index.php>";
}
else
{
?>

<div class="row">
    <div class="col-lg-12">
         
         <ol class="breadcrumb">
             <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
             <li class="active"><i class="fa fa-file"></i> Audit log </li>
         </ol>
         <h3 class="page-header"> Audit Log <small> View log history </small></h3>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
            <table class="table table-bordered table-hover" style="overflow:auto; display:inline-block;  width:; height:400px;">
                 <thead>
                    <tr>
						<th class="width:200px">SL</th>
						<th>Event</th>
                        <th>User Name</th>
                        <th>Description</th>
                        <th>Action Date</th>
						<th>Full Data</th>
					</tr>
                </thead>
                <tbody>
                	<?php $odr->AuditLogView(); ?>
                </tbody>
            </table>
    </div>			

</div>


<?php

}

?>


