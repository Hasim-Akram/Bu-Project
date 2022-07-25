<?php
    
    if(isset($_POST['save'])){
        $department     = $_POST['department'];
        $course_code    = $_POST['course_code'];
        $course_name    = $_POST['name'];
        $credit         = $_POST['credit'];
        $add            = mysql_query("INSERT INTO courses(department_id,course_code,name,credit) 
                        VALUES('$department','$course_code','$course_name','$credit') ");

        if($add){
            echo "<p class='msg_success'> Successful</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=course>";
        }else{
            echo "<p class='msg_error'>Failed to save data</p></center>";
        }
    }

?>


<?php // for Delete dala

    if(isset($_GET['del_id'])){
        $id = $_GET['del_id'];

        $del_data = mysql_query("DELETE FROM courses WHERE id = '$id' ");

        if($del_data){
            echo "<p class='msg_success'> Successfully Deleted.</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=course>";
        }else{
            echo "<p class='msg_error'>Failed to Delete data</p></center>";
        }
    }
?>


                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Add New Course </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="post">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Department</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Department" name="department">
                                                    <option value=""> - Pelese Select - </option>
                                                    <?php
                                                        $data = mysql_query("SELECT * FROM departments");
                                                        $row = mysql_num_rows($data);
                                                        while($d = mysql_fetch_object($data)){
                                                            echo "<option value='".$d->id."'> ".$d->name." </option>";
                                                        }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Course Code</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Course Code" name="course_code">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Course</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Course Name" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Course Credit </label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" name="credit">
                                                    <option value='3'> Credit 3</option>
                                                    <option value='2'> Credit 2</option>
                                                    <option value='1'> Credit 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-md-10">
                                                <input type="submit" class="btn btn-info" value="Save" name="save"/>
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
                                    <h3 class="panel-title">Course List</h3>
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
                                                    <th>Course Code</th>
                                                    <th>Course Name</th>
                                                    <th>Course Credit</th>
                                                    <th>Department</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $sl = 1;
                                                $data = mysql_query("SELECT A.*, B.name AS department 
                                                    FROM courses AS A INNER JOIN departments AS B 
                                                    ON A.department_id = B.id");
                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here</td></tr>";
                                                }else{
                                                    while($d = mysql_fetch_object($data)){
                                                    ?>

                                                <tr>
                                                    <td><?php echo $sl; ?> </td>
                                                    <td><?php echo $d->course_code; ?> </td>
                                                    <td><b><?php echo $d->name; ?> </b></td>
                                                    <td><b><?php echo $d->credit; ?> </b></td>
                                                    <td><?php echo $d->department; ?> </td>
                                                    <td>
                                                        <a href="index.php?id=course_edit&edit_id=<?php echo $d->id; ?>"> Edit </a> | 
                                                        <a href="index.php?id=course&del_id=<?php echo $d->id; ?>"> Delete </a>

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