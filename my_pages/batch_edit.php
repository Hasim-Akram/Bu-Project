<?php
    
    if(isset($_GET['edit_id'])){
        $batch_id = $_GET['edit_id'];
        
        $batch_query = mysql_query("SELECT A.id, A.department_id, A.name, A.current_semester AS semester, B.name AS department 
                        FROM batchs AS A INNER JOIN departments AS B 
                        ON A.department_id = B.id
                        WHERE A.id = '$batch_id' ");

        $batch = mysql_fetch_object($batch_query);
    }


    if(isset($_POST['batch_update'])){
        $batch_id   = $_POST['batch_id'];
        $department = $_POST['department'];
        $batch_name = $_POST['name'];
        $semester   = $_POST['semester'];
        //exit();
        //$add = mysql_query("INSERT INTO batchs(department_id,name,current_semester) VALUES('$department','$batch_name','$semester') ");
        $edit = mysql_query("UPDATE batchs SET department_id = '$department', name = '$batch_name', current_semester = '$semester'
                WHERE id = '$batch_id' ");

        if($edit){
            echo "<p class='msg_success'> Successful</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=batch>";
        }else{
            echo "<p class='msg_error'>Failed to Update data</p></center>";
        }
    }

?>


<?php // for Delete dala

    if(isset($_GET['del_id'])){
        $id = $_GET['del_id'];

        $del_data = mysql_query("DELETE FROM batchs WHERE id = '$id' ");

        if($del_data){
            echo "<p class='msg_success'> Successfully Deleted.</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=batch>";
        }else{
            echo "<p class='msg_error'>Failed to Delete data</p></center>";
        }
    }
?>


                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Add New Batch </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="post">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Departmnet</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Department" name="department">
                                                    <option value=""> - Pelese Select - </option>
                                                    <?php
                                                        $data = mysql_query("SELECT * FROM departments");
                                                        $row = mysql_num_rows($data);
                                                        while($d = mysql_fetch_object($data)){
                                                            if($batch->department_id == $d->id){
                                                                echo "<option value='".$d->id."' selected='selected'> ".$d->name." </option>";
                                                            }else{
                                                                echo "<option value='".$d->id."'> ".$d->name." </option>";
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Batch</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?php echo $batch->name; ?>" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Running Semester</label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <?php
                                                    for($i = 1; $i<=12; $i++){
                                                        if($batch->semester == $i){
                                                            echo "<div class='col-sm-3'> <input type='radio' name='semester' value='".$i."' checked='checked'> Semester ".$i." </div>";
                                                        }else{
                                                            echo "<div class='col-sm-3'> <input type='radio' name='semester' value='".$i."'> Semester ".$i." </div>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-md-10">
                                                <input type="hidden" value="<?php echo $batch_id ?>" name="batch_id" >
                                                <input type="submit" class="btn btn-info" value="Update" name="batch_update"/>
                                            </div>
                                        </div>                                   
                                    </form>                                                                                         
                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="row">
                        <div class="col-md-10">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Batch List</h3>
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
                                                    <th>Department</th>
                                                    <th>Batch</th>
                                                    <th>Running Semester</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $sl = 1;
                                                $data = mysql_query("SELECT A.id as id, A.name AS name, A.current_semester AS semester, B.name AS department 
                                                    FROM batchs AS A INNER JOIN departments AS B 
                                                    ON A.department_id = B.id");
                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here</td></tr>";
                                                }else{
                                                    while($d = mysql_fetch_object($data)){
                                                    ?>

                                                <tr>
                                                    <td><?php echo $sl; ?> </td>
                                                    <td><?php echo $d->department; ?> </td>
                                                    <td> <b> <?php echo $d->name; ?> </b> </td>
                                                    <td><?php echo $d->semester; ?> </td>
                                                    <td>
                                                        <a href="index.php?id=batch_edit&edit_id=<?php echo $d->id; ?>"> Edit </a> | 
                                                        <a href="index.php?id=batch&del_id=<?php echo $d->id; ?>"> Delete </a>

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