<?php

if($odr->IsDataAccess() == 0)
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
            $odr->Delete($id,'tbl_territory_officers_info');
        }
        
    }

    ?>
    <div class="row">
        <div class="col-lg-12">
             
             <ol class="breadcrumb">
                 <li><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard </a></li>
                 <li class="active"><i class="fa fa-file"></i> Data </li>
                 <li class="active"><i class="fa fa-file"></i> Territory Officer </li>
             </ol>
             <h3 class="page-header">Territory officer list
                
            </h3>
        </div>
    </div>
    <small><a href="index.php?id=territory_officer_add_new">New Territory Officer</a>  </small>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="overflow:auto; display:inline-block;  width:100%; height:400px;">
                     <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Category</th>
                            <th>House Name</th>
                            <th>House Id</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $odr->TerritoryOfficerTableView(); ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

<?php

}

?>


