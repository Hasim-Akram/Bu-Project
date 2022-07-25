<script type="text/javascript">
var path='university';

  $(document).ready(function(){
    $(".district_option").html("<option value='0'>Select District</option>"); 
   
  });
  function getDepartmentId(did){

    $.ajax({
        alert(did);
       type: 'POST',
       dataType: 'json',
       url: path+'index.php?id=marks_upload20',
       data: {department_id:did}, 
       success: function(data) {
         $(".district_option").empty();
         $.each(data, function(index, value) {
           
          $(".district_option").append("<option value='"+index+"'>"+value+"</option>"); 
         }); 
         }       
    }); 
  }

</script>

<?php
    

    function getMarks($exm,$std,$semester,$crs){
        if($exm == 1){ $exam = 'mid_mark'; }
        if($exm == 2){ $exam = 'final_mark'; }

        $mark_query = mysql_query("SELECT $exam FROM student_marks 
            WHERE student_id='$std' AND semester_id = '$semester' AND course_id='$crs'");
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
                                    <h3 class="panel-title"> Search Students list </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="GET">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Course Name</label>
                                            <div class="col-md-10">

                                                




                                            <?php
                                            if(isset($_GET['course'])){
                                                $course_id = $_GET['course'];
                                                $course_query = mysql_fetch_object(mysql_query("SELECT * FROM courses WHERE id = '$course_id' "));
                                            }
                                            ?>
                                                <input type="hidden" name="id" value="marks_upload">

                                                <input type="text" class="form-control" name="course_name" value="<?php echo $course_query->name; ?>">

                                                <input type="hidden" name="course" value="<?php echo $course_query->id; ?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Department</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Department" onChange="getDepartmentId(this.value);" name="department">
                                                    <option value=''> - Pelese Select - </option>
                                                    <?php
                                                        if(isset($_GET['department'])){
                                                            $d_id = $_GET['department'];
                                                        }

                                                        $data = mysql_query("SELECT * FROM departments");
                                                        $row = mysql_num_rows($data);
                                                        while($d = mysql_fetch_object($data)){
                                                            if($d_id == $d->id){
                                                                echo "<option value='".$d->id." selected ='selected ' > ".$d->name." </option>";
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
                                                <select type="select" class="form-control district_option" placeholder="Batch" name="batch">
                                                   </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Semester</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Semester" name="semester">
                                                    <option value=""> - Pelese Select - </option>
                                                    <?php
                                                        if(isset($_GET['semester'])){
                                                            $s_id = $_GET['semester'];
                                                        }
                                                        for($i = 1 ; $i<=12; $i++){
                                                            if($s_id == $i){
                                                                echo "<option value='".$i."' selected='selected'> Semester - ".$i." </option>";
                                                            }else{
                                                                echo "<option value='".$i."'> Semester - ".$i." </option>";
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-md-10">
                                                <input type="submit" class="btn btn-info" value="Search" name="search"/>
                                            </div>
                                        </div>                                   
                                    </form>                                                                                         
                                </div>
                            </div>
                        </div>
                    </div>






                    <?php 
                    if(isset($_GET['search'])){
                        $course_id = $_GET['course'];
                        $department_id = $_GET['department'];
                        $batch_id = $_GET['batch'];
                        $semester_id = $_GET['semester'];
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
                                        $semester_id    = $_POST['semester_id'];
                                        $course_id      = $_GET['course'];

                                        $midexam        = $_POST['midexam'];
                                        $finalexam      = $_POST['finalexam'];

                                        $query1 = mysql_query("SELECT * FROM student_marks 
                                            WHERE student_id = '$student_id' 
                                            AND department_id = '$department_id' 
                                            AND batch_id = '$batch_id' 
                                            AND semester_id = '$semester_id' 
                                            AND course_id = '$course_id' 
                                            ");
                                        $query_check = mysql_num_rows($query1);
                                        
                                        if($query_check > 0){
                                            $query2 = mysql_query("UPDATE student_marks SET 
                                            mid_mark = '$midexam', final_mark = '$finalexam'
                                            WHERE student_id = '$student_id' AND course_id = '$course_id'");

                                            if($query2){
                                                echo "<p class='msg_alert'> Result sucessfully Updated. </p>";
                                            }else{
                                                echo "<p class='msg_error'> Failed to update result. </p>";
                                            }

                                        }else{
                                            $query3 = mysql_query("INSERT INTO student_marks
                                            (student_id,department_id,batch_id,semester_id,course_id,mid_mark,final_mark) 
                                            VALUES('$student_id','$department_id','$batch_id','$semester_id','$course_id','$midexam','$finalexam') ");

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
                                                    <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>">
                                                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

                                                    <?php echo $d->roll; ?> 

                                                    </td>
                                                    <td><b><?php echo $d->name; ?> </b></td>
                                                    <td> <input type="text" name="midexam" placeholder="Cont Ass Mark" value="<?php getMarks(1,$d->id,$semester_id,$course_id); ?>" ></td>
                                                    <td> <input type="text" name="finalexam" placeholder="Final Mark" value="<?php getMarks(2,$d->id,$semester_id,$course_id); ?>" ></td>

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
                            <?php
                            }
                            ?>