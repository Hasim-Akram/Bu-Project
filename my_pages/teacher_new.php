<?php
    
    if(isset($_POST['save'])){
        
        $name           = $_POST['name'];
        $email          = $_POST['email'];
        $department     = $_POST['department'];
        $mobile         = $_POST['mobile'];
        $address        = $_POST['address'];
        $pass           = sha1('0000');
        
        $add_std = mysql_query("INSERT INTO teachers(name,email,department_id) VALUES('$name','$email','$department') ");
        
        $add_user = mysql_query("INSERT INTO tbl_user_info(full_name,user_name,mobile,address,password,role,IsActive) 
            VALUES('$name','$email','$mobile','$address','$pass',2,1) ");

        if($add_std && $add_user){
            echo "<p class='msg_success'> Successful</p>";
            echo "<meta http-equiv=refresh content=0;url=./index.php?id=teacher_list>";
        }else{
            echo "<p class='msg_error'>Failed to save data</p></center>";
        }
    }

?>


                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Add New Teacher </h3>
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
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Email Address" name="email">
                                            </div>
                                        </div>

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






                