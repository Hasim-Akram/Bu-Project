<?php
//Include database configuration file
include('../class/connection.php');
//echo $department_id = 6;
if(isset($_POST["department_id"]) && !empty($_POST["department_id"])){
    //Get all state data
    $query = mysql_query("SELECT * FROM batchs WHERE department_id = ".$_POST['department_id']." ORDER BY name ASC");
    //$query = mysql_query("SELECT * FROM batchs WHERE department_id = 5 ORDER BY name ASC");
    
    //Count total number of rows
    $rowCount = mysql_num_rows($query);
    
    //Display states list
    if($rowCount > 0){
        echo '<option value=""> - Select Batch - </option>';
        while($row = mysql_fetch_array($query)){ 
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }else{
        echo '<option value="">Data not available</option>';
    }
}

if(isset($_POST["batch_id"]) && !empty($_POST["batch_id"])){
    //Get all state data
    $query = mysql_query("SELECT current_semester FROM batchs WHERE id = ".$_POST['batch_id']." ");
    //$query = mysql_query("SELECT * FROM batchs WHERE department_id = 5 ORDER BY name ASC");
    
    //Count total number of rows
    $rowCount = mysql_num_rows($query);
    
    //Display states list
    if($rowCount > 0){
        //echo '<option value="">Select Batch</option>';
        while($row = mysql_fetch_array($query)){ 
            echo '<label class="col-sm-2 control-label">Current Semester</label>
                    <div class="col-md-10" >
                    <input type="text" class="form-control" value="'.$row['current_semester'].'" name="semester" >
                    </div>';
        }
    }else{
    }
}
?>