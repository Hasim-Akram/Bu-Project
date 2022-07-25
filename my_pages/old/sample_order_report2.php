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
                 <li class="active"><i class="fa fa-file"></i> Data </li>
                 <li class="active"><i class="fa fa-file"></i> Order Report </li>
             </ol>
             <h3 class="page-header">Order Report Generate Panel
                <small><a target="_blank" href="my_pages/sample_order_report_download.php">Generate EXCEL Report</a>  </small>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="overflow:auto; display:inline-block;  width:100%; height:400px;">
                     <thead>
                        <tr>
                            <th>Region</th>
                            <th>Area</th>
                            <th>Territory</th>
                            <th>House</th>
                            <th>Brand</th>
                            <th>Pack</th>
                            <th><?php echo date('d-M-Y'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $odr->GenerateOrderReportEveryday(); ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

<?php

}

?>


