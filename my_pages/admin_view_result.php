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


                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Student Result Sheet </h3>
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
                                                <input type="submit" class="btn btn-info" value="Search" name="search_result"/>
                                            </div>
                                        </div>                                   
                                    </form>                                                                                         
                                </div>
                            </div>
                        </div>
                    </div>





                <?php
                    if(isset($_POST['search_result'])){
                        $department_id      = $_POST['department_id'];
                        $batch_id           = $_POST['batch_id'];
                        $semester           = $_POST['semester'];

                        $department = mysql_fetch_object(mysql_query("SELECT * FROM departments WHERE id = '$department_id' "));
                        $batch      = mysql_fetch_object(mysql_query("SELECT * FROM batchs WHERE id = '$batch_id' "));
                ?>
                    <div class="row">
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Result sheet <b> Semester <?php echo $semester; ?> </b> </h3>
                                    <ul class="panel-controls">
                                        <li><a href="javascript:void(0)" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body" id="printableArea">

                                    <div style="text-align:center; margin-bottom:20px;">
                                        <h2>Bangladesh University</h2>
                                        <p> 
                                            Department of <b> <?php echo $department->name; ?> </b> <br>
                                            Batch : <b> <?php echo $batch->name; ?> </b> 
                                         </p>

                                        <h3>Semester <?php echo $semester; ?></h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <?php
                                                $subject = mysql_query(" SELECT course_code, name, credit FROM courses AS A 
                                                            INNER JOIN student_marks AS B ON A.id = B.course_id 
                                                            WHERE B.department_id = '$department_id' 
                                                            AND B.batch_id = '$batch_id' AND B.semester = '$semester' 
                                                            GROUP BY B.course_id ");
                                                $sub_count = mysql_num_rows($subject);
                                            ?>
                                                <tr>
                                                    <th rowspan="2">SL</th>
                                                    <th rowspan="2">Name</th>
                                                    <th rowspan="2">Roll</th>
                                                    
                                                    <?php
                                                    while($sub = mysql_fetch_object($subject)){
                                                        echo "<th colspan='5'> $sub->name  ( $sub->course_code ) - $sub->credit Credit</th>";
                                                    }
                                                    ?>
                                                    <th rowspan="2">Final Result</th>
                                                </tr>
                                                <tr>

                                                    <?php
                                                    for($i = 1; $i <= $sub_count; $i++){
                                                    ?>  
                                                        <th>Cont Ass.</th>
                                                        <th>Final</th>
                                                        <th>Total</th>
                                                        <th>GL</th>
                                                        <th>GP</th>
                                                    <?php
                                                    }
                                                    ?>

                                                    <!-- <th>GL</th>
                                                    <th>GP</th> -->
                                                    
                                                <tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr><td>rtr</td>
                                                    <td>rtrt</td>
                                                    <td>
                                                        <a href="index.php?id=department_ertrt"> Edit </a> | 
                                                        <a href="index.php?id=departmentrtrt"> Delete </a>

                                                    </td>
                                                </tr> -->

                                                
                                            <?php
                                                $sl = 1;
                                                $data = mysql_query("SELECT A.id,A.name,A.roll FROM students AS A
                                                    INNER JOIN student_marks AS B ON A.id = B.student_id
                                                    WHERE B.department_id = '$department_id' 
                                                    AND B.batch_id = '$batch_id' AND B.semester = '$semester'
                                                    GROUP BY B.student_id ");

                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here</td></tr>";
                                                }else{
                                                    
                                                    while($d = mysql_fetch_object($data)){
                                                        $student_id = $d->id;
                                                        
                                                        ?>

                                                            <tr>
                                                                <td><?php echo $sl; ?> </td>
                                                                <td><?php echo $d->name; ?> </td>
                                                                <td><?php echo $d->roll; ?> </td>
                                                                <?php
                                                                $student_marks = mysql_query("SELECT A.mid_mark, A.final_mark, B.credit FROM 
                                                                                student_marks AS A INNER JOIN courses AS B 
                                                                                ON A.course_id = B.id
                                                                                WHERE A.student_id = '$student_id' 
                                                                                AND A.department_id = '$department_id' 
                                                                                AND A.batch_id = '$batch_id'
                                                                                AND A.semester = '$semester' ");
                                                                /*$marks = mysql_fetch_object($student_marks);
                                                                echo '<pre>';
                                                                print_r($marks);
                                                                echo '<pre>';*/
                                                                $total_point = 0;
                                                                $fail = 0;
                                                                while($marks = mysql_fetch_object($student_marks)){
                                                                    //$credit = $marks->credit;
                                                                    echo "<td> $marks->mid_mark </td>";
                                                                    echo "<td> $marks->final_mark </td>";

                                                                    $total_mark = $marks->mid_mark + $marks->final_mark;

                                                                    echo "<td> $total_mark </td>";

                                                                    $raange = 100;
                                                                    $percentanc = ($total_mark * 100)/ $raange;

                                                                    if($percentanc < 40){
                                                                        $grade = 'F'; $point = '0.00';
                                                                        $fail = 1;
                                                                    }elseif($percentanc >= 40 && $percentanc < 45){
                                                                        $grade = 'D'; $point = '2.00';
                                                                    }elseif($percentanc >= 45 && $percentanc < 50){
                                                                        $grade = 'C'; $point = '2.25';
                                                                    }elseif($percentanc >= 50 && $percentanc < 55){
                                                                        $grade = 'C+'; $point = '2.50';
                                                                    }elseif($percentanc >= 55 && $percentanc < 60){
                                                                        $grade = 'B-'; $point = '2.75';
                                                                    }elseif($percentanc >= 60 && $percentanc < 65){
                                                                        $grade = 'B'; $point = '3.00';
                                                                    }elseif($percentanc >= 65 && $percentanc < 70){
                                                                        $grade = 'B+'; $point = '3.25';
                                                                    }elseif($percentanc >= 70 && $percentanc < 75){
                                                                        $grade = 'A-'; $point = '3.50';
                                                                    }elseif($percentanc >= 75 && $percentanc < 80){
                                                                        $grade = 'A'; $point = '3.75';
                                                                    }elseif($percentanc >= 80 ){
                                                                        $grade = 'A+'; $point = '4.00';
                                                                    }

                                                                    if($grade == 'F'){
                                                                        echo "<td> <span style='color:red; font-weight:bold;'> $grade </span> </td>";
                                                                        echo "<td> <span style='color:red; font-weight:bold;'> $point </span> </td>";
                                                                    }else{
                                                                        echo "<td> $grade </td>";
                                                                        echo "<td> $point </td>";
                                                                    }

                                                                    $total_point = $total_point+$point;
                                                                    $cgpa = $total_point/$sub_count;
                                                                }



                                                                if($fail == 1){
                                                                   echo "<td> <span style='color:red; font-weight:bold;'> F </span></td>"; 
                                                                  // echo "<td> - </td>"; 
                                                                }else{
                                                                    echo "<td> <b>".number_format($cgpa ,2) ."</b></td>";
                                                                    //echo "<td> ".number_format($cgpa ,2) ."</td>";
                                                                }
                                                                 
                                                                ?>
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



<script>

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>