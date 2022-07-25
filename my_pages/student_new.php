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
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'my_pages/ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>

<?php
    
    if(isset($_POST['save'])){
        
        $name           = $_POST['name'];
        $roll           = $_POST['roll'];
        $department     = $_POST['department'];
        $batch          = $_POST['batch'];
        $mobile         = $_POST['mobile'];
        $address        = $_POST['address'];
        $pass           = sha1('123456');

       /* $find_semester = mysql_query("SELECT current_semester FROM batchs WHERE id = '$batch' ");
        $semester_data = mysql_fetch_object($find_semester);
        $semester      = $semester_data->current_semester;
        
        $add_std = mysql_query("INSERT INTO students(name,roll,department_id,batch_id,current_semester) VALUES('$name','$roll','$department','$batch','$semester') ");*/

        $add_std = mysql_query("INSERT INTO students(name,roll,department_id,batch_id) VALUES('$name','$roll','$department','$batch')");
        
        $add_user = mysql_query("INSERT INTO tbl_user_info(full_name,user_name,mobile,address,password,role,IsActive) 
            VALUES('$name','$roll','$mobile','$address','$pass',3,1) ");

        if($add_std && $add_user){
            echo "<p class='msg_success'> Successful</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=student_list>";
        }else{
            echo "<p class='msg_error'>Failed to save data</p></center>";
        }
    }

?>


                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Add New Student </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="post">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Student Name" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Roll No</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Roll no" name="roll">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Departmnet</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Department" name="department" id="department">
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
                                                <select type="text" class="form-control" placeholder="Batch" name="batch" id="batch">
                                                    <option value="">Select department first</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Mobile</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Mobile Number" name="mobile">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Address </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Address" name="address">
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






                