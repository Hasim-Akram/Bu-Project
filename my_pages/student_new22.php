<?php
if(isset($_POST['get_option']))
{


 $state = $_POST['get_option'];
 $find=mysql_query("select id,name from bathcs where department_id='$state'");
 while($row=mysql_fetch_array($find))
 {
  echo "<option>".$row['name']."</option>";
 }
 exit;
}
?>



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'my_pages/student_new22.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}

</script>

</head>
<body>
<p id="heading">Dynamic Select Option Menu Using Ajax and PHP</p>
<center>
<div id="select_box">
 <select onchange="fetch_select(this.value);">
  <option>Select state</option>
  <?php
  $select=mysql_query("select id, name from departments group by name");
  while($row=mysql_fetch_array($select))
  {
   echo "<option value='".$row['id']."'>".$row['name']."</option>";
  }
 ?>
 </select>

 <select id="new_select">
 </select>
      
</div>     
