<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#department').on('change',function(){
        var departmentID = $(this).val();
        /*alert(departmentID);*/
        if(departmentID){
            $.ajax({
                type:'POST',
                url:'my_pages/ajaxData.php',
                data:'department_id='+departmentID,
                success:function(html){
                    $('#batch').html(html);
                    /*$('#city').html('<option value="">Select state first</option>'); */
                }
            }); 
        }else{
            $('#batch').html('<option value="">Select department first</option>');
           /* $('#city').html('<option value="">Select state first</option>'); */
        }
    });
    
    $('#batch').on('change',function(){
        var batchID = $(this).val();
        if(batchID){
            $.ajax({
                type:'POST',
                url:'my_pages/ajaxData.php',
                data:'batch_id='+batchID,
                success:function(html){
                    $('#semester').html(html);
                }
            }); 
        }else{
            $('#semester').html('<p> No Semester assigned yet </p>'); 
        }
    });
});
</script>

<?php
    

    function getMarks($exm,$std,$semester,$crs){
        if($exm == 1){ $exam = 'mid_mark'; }
        if($exm == 2){ $exam = 'final_mark'; }

        $mark_query = mysql_query("SELECT $exam FROM student_marks 
            WHERE student_id='$std' AND semester = '$semester' AND course_id='$crs'");
        $get_mark   = mysql_fetch_object($mark_query);
        if(mysql_num_rows($mark_query) > 0){
            echo $get_mark->$exam;
        }else{
            echo "";
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
                                    <h3 class="panel-title"> Course Details </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <?php 
                                    if(isset($_GET['course_id'])){
                                        $course_id = $_GET['course_id'];
                                        $department_id = $_GET['department_id'];
                                        $batch_id = $_GET['batch_id'];
                                        $semester = $_GET['semester'];
                                    ?>

                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;">Subject : </div>
                                        <div class="col-sm-7">
                                        <?php
                                            $course = mysql_fetch_object(mysql_query("SELECT course_code,name FROM courses WHERE id = '$course_id' "));
                                            echo "<b> $course->name ( $course->course_code )</b>";
                                        ?>
                                        </div>
                                    </div> <hr> 
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;">Department : </div>
                                        <div class="col-sm-7">
                                        <?php
                                            $department = mysql_fetch_object(mysql_query("SELECT name FROM departments WHERE id = '$department_id' "));
                                            echo "<b> $department->name </b>";
                                        ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;">Batch : </div>
                                        <div class="col-sm-7">
                                        <?php
                                            $batch = mysql_fetch_object(mysql_query("SELECT name, current_semester FROM batchs WHERE id = '$batch_id' "));
                                            echo "<b> $batch->name </b>";
                                        ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;">Running Semester : </div>
                                        <div class="col-sm-7">
                                        <?php
                                            //$teacher = mysql_fetch_object(mysql_query("SELECT name FROM teachers WHERE id = '$teacher_id' "));
                                            echo "<b> Semester $batch->current_semester </b>";
                                        ?>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                    ?>
                                                                                                                          
                                </div>
                            </div>
                        </div>
                    </div>






                    <?php 
                    if(isset($_GET['course_id'])){
                        $course_id = $_GET['course_id'];
                        $department_id = $_GET['department_id'];
                        $batch_id = $_GET['batch_id'];
                        $semester = $_GET['semester'];
                    ?>

                    <div class="row">
                        <div class="col-md-12">

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
                                
                                <?php
                                    if(isset($_POST['save_mark'])){
                                        $student_id     = $_POST['student_id'];
                                        $department_id  = $_POST['department_id'];
                                        $batch_id       = $_POST['batch_id'];
                                        $semester       = $_POST['semester'];
                                        $course_id      = $_GET['course_id'];

                                        $midexam        = $_POST['midexam'];
                                        $finalexam      = $_POST['finalexam'];

                                        $query1 = mysql_query("SELECT * FROM student_marks 
                                            WHERE student_id = '$student_id' 
                                            AND department_id = '$department_id' 
                                            AND batch_id = '$batch_id' 
                                            AND semester = '$semester' 
                                            AND course_id = '$course_id' 
                                            ");
                                        $query_check = mysql_num_rows($query1);
                                        
                                        if($query_check > 0){
                                            $query2 = mysql_query("UPDATE student_marks SET 
                                            mid_mark = '$midexam', final_mark = '$finalexam'
                                            WHERE student_id = '$student_id' AND course_id = '$course_id'
                                            AND department_id = '$department_id' AND batch_id = '$batch_id' ");

                                            if($query2){
                                                echo "<p class='msg_alert'> Result sucessfully Updated. </p>";
                                            }else{
                                                echo "<p class='msg_error'> Failed to update result. </p>";
                                            }

                                        }else{
                                            $query3 = mysql_query("INSERT INTO student_marks
                                            (student_id,department_id,batch_id,semester,course_id,mid_mark,final_mark) 
                                            VALUES('$student_id','$department_id','$batch_id','$semester','$course_id','$midexam','$finalexam') ");

                                            if($query3){
                                                echo "<p class='msg_success'> Result sucessfully saved. </p>";
                                            }else{
                                                echo "<p class='msg_error'> Failed to save result. </p>";
                                            }
                                        }

                                    }
                                ?>
                                    <div class="table-responsive">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Roll No</th>
                                                    <th>Student Name</th>
                                                    <th>Cont Ass</th>
                                                    <th>Final</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $sl = 1;
                                                $data = mysql_query("SELECT * 
                                                    FROM students WHERE department_id = '$department_id' AND batch_id = '$batch_id' ");
                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here<td><tr>";
                                                }else{
                                                    while($d = mysql_fetch_object($data)){
                                                    ?>

                                                
                                                <tr>
                                                <form action="#" method="POST">
                                                    
                                                    <td><?php echo $sl; ?> </td>
                                                    <td>
                                                    <input type="hidden" name="student_id" value="<?php echo $d->id; ?>">
                                                    <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                                                    <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
                                                    <input type="hidden" name="semester" value="<?php echo $semester; ?>">
                                                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                                    <?php echo $d->roll; ?> 

                                                    </td>
                                                    <td><b><?php echo $d->name; ?> </b></td>
                                                    <td> <input type="text" name="midexam" placeholder="Cont Ass Mark" value="<?php getMarks(1,$d->id,$semester,$course_id); ?>" ></td>
                                                    <td> <input type="text" name="finalexam" placeholder="Final Mark" value="<?php getMarks(2,$d->id,$semester,$course_id); ?>" ></td>

                                                    <td> <input type="submit" name="save_mark" value="SET" ></td>
                                                
                                                </form>
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
                        </div>
                    </div>
                            <?php
                            }
                            ?>