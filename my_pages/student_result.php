<?php

    $ses_roll = $user_data->user_name;

    $student_data = mysql_fetch_object(mysql_query("SELECT A.id AS student_id, A.name, A.roll, 
                    B.id AS department_id, B.name AS department, 
                    C.id AS batch_id, C.name AS batch
                    FROM students AS A
                    INNER JOIN departments AS B ON A.department_id = B.id
                    INNER JOIN batchs AS C ON A.batch_id = C.id
                    WHERE A.roll = '$ses_roll' "));

    $student_id         = $student_data->student_id;
    $name               = $student_data->name;
    $roll               = $student_data->roll;
    $department_id      = $student_data->department_id;
    $department         = $student_data->department;
    $batch_id           = $student_data->batch_id;
    $batch              = $student_data->batch;

    /*echo '<pre>';
    print_r($student_data);
    echo '</pre>';*/


?>




                    <div class="row">
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"> Student Information </h3>
                                    <ul class="panel-controls">
                                        <li><a href="wsdindex.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="wsdindex.html#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;"> Name : </div>
                                        <div class="col-sm-7"> <b> <?php echo $name; ?> </b> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;"> Roll : </div>
                                        <div class="col-sm-7"> <b> <?php echo $roll; ?> </b> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;"> Department : </div>
                                        <div class="col-sm-7"> <b> <?php echo $department; ?> </b> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5" style="text-align:right;"> batch : <b> </div>
                                        <div class="col-sm-7"> <b> <?php echo $batch; ?> </b> </div>
                                    </div>
                                    <hr>

                                    <form class="form-horizontal" role="form" method="post">
                                        <div class="form-group">
                                            <?php
                                                $semester = mysql_query("SELECT semester FROM student_marks 
                                                            WHERE student_id = '$student_id' AND department_id = '$department_id' 
                                                            AND batch_id = '$batch_id' GROUP BY semester DESC ");
                                            ?>
                                            <label class="col-sm-2 control-label">Select Semester</label>
                                            <div class="col-md-10">
                                                <select type="text" class="form-control" placeholder="Department" name="semester">
                                                <?php
                                                    while($s = mysql_fetch_object($semester)){
                                                        echo "<option> $s->semester</option>";
                                                    }
                                                
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> </label>
                                            <div class="col-md-10">
                                                <input type="hidden" value="<?php echo $student_id ?>" name="student_id" >
                                                <input type="hidden" value="<?php echo $department_id ?>" name="department_id" >
                                                <input type="hidden" value="<?php echo $batch_id ?>" name="batch_id" >
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
                        $student_id         =$_POST['student_id'];
                        $department_id      =$_POST['department_id'];
                        $batch_id           =$_POST['batch_id'];
                        $semester           =$_POST['semester'];
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
                                <div class="panel-body" id ="printableArea">

                                    <div style="text-align:center; margin-bottom:20px;">
                                        <h2>Bangladesh University</h2>
                                        <p> 
                                            Department of <?php echo $department; ?> <br>
                                            <?php echo $batch; ?> Batch
                                         </p>

                                        <h3>Semester <?php echo $semester; ?></h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <?php
                                                $subject = mysql_query(" SELECT course_code, name, credit FROM courses AS A 
                                                            INNER JOIN student_marks AS B ON A.id = B.course_id 
                                                            WHERE B.student_id = '$student_id' AND B.department_id = '$department_id' 
                                                            AND B.batch_id = '$batch_id' AND B.semester = '$semester' ");
                                                $sub_count = mysql_num_rows($subject);
                                            ?>
                                                <tr>
                                                    <th rowspan="2">SL</th>
                                                    
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
                                                $data = mysql_query("SELECT * FROM students WHERE id = '$student_id' ");
                                                $row = mysql_num_rows($data);
                                                if($row == 0 ){
                                                    echo "<tr><td colsapn='3'> No data available here</td></tr>";
                                                }else{
                                                    while($d = mysql_fetch_object($data)){
                                                    ?>

                                                <tr>
                                                    <td><?php echo $sl; ?> </td>
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

                                                        echo "<td> $grade </td>";
                                                        echo "<td> $point </td>";

                                                        $total_point = $total_point+$point;
                                                        $cgpa = $total_point/$sub_count;



                                                       


                                                    }

                                                    if($fail == 1){
                                                       echo "<td> <span style='color:red; font-weight:bold;'> F </span> </td>"; 
                                                      // echo "<td> - </td>"; 
                                                    }else{
                                                        echo "<td> ".number_format($cgpa ,2) ."</td>";
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
