<?php
	if(!empty($_POST['department'])){
		$d_id = $_POST['department'];
	    //echo $d_id = 5;
	    
	    $query = mysql_query("SELECT * FROM batchs WHERE department_id = '$d_id' ");

	    while($data = mysqli_fetch_array($query)){
	    	?>
	    	<option value="<?php echo $data->id; ?>"> <?php echo $data->name; ?></option>
	    	<?php
	    }
	   /*echo "<pre>";
	    print_r($data);
	    echo "</pre>";*/
	    //return json_encode($data);

	}
    

 ?>