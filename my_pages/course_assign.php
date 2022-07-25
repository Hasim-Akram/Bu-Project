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
    
    if(isset($_POST['save'])){
        
        if(!isset($_POST['chk_perm']))
            {
                echo "<p class='msg_alert'>No Subject selected yet</p>";
            }else
            {
                $teacher_id         = $_POST['teacher_id'];

                $department_id      = $_POST['department_id'];
                $batch_id           = $_POST['batch_id'];
                $semester           = $_POST['semester'];

                $chk_q              = $_POST['chk_perm'];

                //exit();
                $sql_detele_mapping = "DELETE FROM assign_courses WHERE teacher_id='$teacher_id' AND
                 department_id='$department_id' AND batch_id='$batch_id' AND semester = '$semester' ";
                $result_delete_mapping = mysql_query($sql_detele_mapping); // for fresh mapping

                for ($i=0; $i<count($chk_q); $i++) {
                    $course_id = $chk_q[$i];
                    //echo $group_id. $question_id."<br>";
                    $sql_mapping = "INSERT INTO assign_courses(teacher_id,course_id,department_id,batch_id,semester) 
                    VALUES('$teacher_id','$course_id','$department_id','$batch_id','$semester') ";
                    $result_mapping  = mysql_query($sql_mapping);
                    /*$ins_id = mysql_insert_id();
                    $fetch_data_array = mysql_fetch_object(mysql_query("SELECT role_id,permission_id From role_permission_mapping WHERE id ='$ins_id' "));*/

                }

            }
    }

?>

<?php
function CheckPermission($teacher_id,$course_id,$department_id,$batch_id,$semester){
        $sql_get_permission = "SELECT * FROM assign_courses WHERE teacher_id='$teacher_id' 
                            AND course_id ='$course_id' AND department_id = '$department_id' 
                            AND batch_id = '$batch_id' AND semester = '$semester' ";
        $result_get_permission = mysql_query($sql_get_permission);
        
        if(mysql_num_rows($result_get_permission)>0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

?>
                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Assign Course </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <?php
                                    if(!isset($_POST['search']) && !isset($_POST['save'])){
                                    ?>
                                    <form class="form-horizontal" role="form" method="post">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Teacher Name</label>
                                            <div class="col-md-10">
                                            <?php
                                            if(isset($_GET['t_id'])){
                                                $tid=$_GET['t_id'];
                                                $t_query = mysql_query("SELECT * FROM teachers WHERE id = '$tid' ");
                                                $t_data = mysql_fetch_object($t_query);
                                            }
                                            ?>
                                                <input type="text" class="form-control" placeholder="Student Name" name="name" value="<?php echo $t_data->name; ?>">

                                                <input type="hidden" name="teacher_id" value="<?php echo $t_data->id; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Departmnet</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Department" name="department_id" id="department">
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
                                            <label class="col-sm-2 control-label">Batch</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Batch" name="batch_id" id="batch">
                                                    <option value="">Select department first</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="semester">
                                            
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-md-10">
                                                <input type="submit" class="btn btn-info" value="Search for Course" name="search"/>
                                            </div>
                                        </div>                                   
                                    </form>
                                    <?php
                                    }
                                    ?>

                                    

                                    <?php
                                    if(isset($_POST['search']) || isset($_POST['save'])){
                                        $teacher_id         = $_POST['teacher_id'];
                                        $department_id      = $_POST['department_id'];
                                        $batch_id           = $_POST['batch_id'];
                                        $semester           = $_POST['semester'];
                                    ?>

                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;">Subject Assigned for : </div>
                                        <div class="col-sm-7">
                                        <?php
                                            $teacher = mysql_fetch_object(mysql_query("SELECT name FROM teachers WHERE id = '$teacher_id' "));
                                            echo "<b> $teacher->name </b>";
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

                                    <hr>

                                    <form class="form-horizontal" role="form" method="post">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Courses</label>
                                            <div class="col-md-10">
                                                <?php 
                                                $sql_view_permission = "SELECT * FROM courses WHERE department_id = '$department_id' ";
                                                $result_view_permission = mysql_query($sql_view_permission);
                                                while($q = mysql_fetch_object($result_view_permission))
                                                {
                                                    echo "<div class ='col-sm-4'>";
                                                    $course_id = $q->id;

                                                    if(CheckPermission($teacher_id,$course_id,$department_id,$batch_id,$semester) == 1){
                                                        echo "<input type='checkbox' name='chk_perm[]'' value='".$q->id."' checked /> ";
                                                    }else{
                                                        echo "<input type='checkbox' name='chk_perm[]'' value='".$q->id."' unchecked/> ";
                                                    }
                                                    echo " ".$q->name;
                                                    echo "</div>";
                                                                
                                                }
                                                ?>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-md-10">
                                                <input type="hidden" value="<?php echo $teacher_id; ?>" name="teacher_id" >
                                                <input type="hidden" value="<?php echo $department_id; ?>" name="department_id" >
                                                <input type="hidden" value="<?php echo $batch_id; ?>" name="batch_id" >
                                                <input type="hidden" value="<?php echo $semester; ?>" name="semester" >

                                                <input type="submit" class="btn btn-info" value="Save" name="save"/>
                                            </div>
                                        </div>                                   
                                    </form> 


                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>






                