
                    <div class="row">
                        <div class="col-md-10">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">My Courses </h3>
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
                                                    <th>Semester</th>
                                                    <th>Course Code</th>
                                                    <th>Course Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $sl = 1;
                                                $teacher_data = mysql_fetch_object(mysql_query("SELECT id FROM teachers where email = '$user_data->user_name'"));
                                                $teacher_id = $teacher_data->id;
                                                $data = mysql_query("SELECT B.* , D.id AS department_id, D.name AS department, 
                                                    E.id AS batch_id, E.name AS batch, E.current_semester AS semester
                                                    FROM assign_courses AS A
                                                    INNER JOIN courses AS B ON A.course_id = B.id
                                                    INNER JOIN teachers AS C ON A.teacher_id = C.id
                                                    INNER JOIN departments AS D ON A.department_id = D.id
                                                    INNER JOIN batchs AS E ON A.batch_id = E.id
                                                    WHERE C.id = '$teacher_id' ");
                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here</td></tr>";
                                                }else{
                                                    while($d = mysql_fetch_object($data)){
                                                    ?>

                                                <tr>
                                                    <td><?php echo $sl; ?> </td>
                                                    <td><?php echo $d->department; ?> </td>
                                                    <td><?php echo $d->batch; ?> </td>
                                                    <td><?php echo $d->semester; ?> </td>
                                                    <td><?php echo $d->course_code; ?> </td>
                                                    <td><b><?php echo $d->name; ?> </b></td>
                                                    <td>
                                                        <?php echo "<a href='index.php?id=marks_upload&course_id=".$d->id."&department_id=".$d->department_id."&batch_id=".$d->batch_id."&semester=".$d->semester."
                                                         '> Marks upload </a>";

                                                        ?>
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