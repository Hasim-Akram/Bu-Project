<?php // for Delete dala

    if(isset($_GET['del_id'])){
        $id = $_GET['del_id'];

        $del_data = mysql_query("DELETE FROM students WHERE roll = '$id' ");
        $deactive_user = mysql_query("UPDATE tbl_user_info SET IsActive = 0 WHERE user_name = '$id' ");

        if($del_data && $deactive_user){
            echo "<p class='msg_success'> Successfully Deleted.</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=student_list>";
        }else{
            echo "<p class='msg_error'>Failed to Delete data</p></center>";
        }
    }
?>


                    

                    <div class="row">
                        <div class="col-md-10">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Students List <a href="index.php?id=student_new" class="btn btn-info"> Add New + </a></h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Name</th>
                                                    <th>Roll</th>
                                                    <th>Department</th>
                                                    <th>Batch</th>
                                                    <th>Mobile</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $sl = 1;
                                                $data = mysql_query("SELECT A.id, A.name, A.roll, B.id AS user_id, B.mobile, B.address, 
                                                    C.name as department, D.name as batch
                                                    FROM students AS A INNER JOIN tbl_user_info AS B 
                                                    INNER JOIN departments AS C
                                                    INNER JOIN batchs AS D
                                                    ON A.roll = B.user_name AND A.department_id = C.id AND A.batch_id = D.id
                                                    WHERE B.role = 3");
                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here</td></tr>";
                                                }else{
                                                    while($d = mysql_fetch_object($data)){
                                                    ?>

                                                <tr>
                                                    <td><?php echo $sl; ?> </td>
                                                    <td><?php echo $d->name; ?> </td>
                                                    <td><b><?php echo $d->roll; ?> </b></td>
                                                    <td><?php echo $d->department; ?> </td>
                                                    <td><?php echo $d->batch; ?> </td>
                                                    <td><?php echo $d->mobile; ?> </td>
                                                    <td><?php echo $d->address; ?> </td>
                                                    <td>
                                                        <a href="index.php?id=student_edit&edit_id=<?php echo $d->id; ?>"> Edit </a> | 
                                                        <a href="index.php?id=student_list&del_id=<?php echo $d->roll; ?>"> Delete </a>

                                                    </td>
                                                </tr>

                                                    <?php
                                                    $sl++;
                                                    }
                                                }
                                            ?>    
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>