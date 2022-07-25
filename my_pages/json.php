<script type="text/javascript">
var path='<?php echo $this->webroot;?>';

  $(document).ready(function(){
    $(".district_option").html("<option value='0'>Select District</option>"); 
   
  });

  function getDistrictId(id){

    $.ajax({
       type: 'POST',
       dataType: 'json',
       url: path+'districts/districtList',
       data: {division_id:id}, 
       success: function(data) {
         $(".district_option").empty();
         $.each(data, function(index, value) {
           
          $(".district_option").append("<option value='"+index+"'>"+value+"</option>"); 
         }); 
         }       
    }); 
  }

</script>


  <input type="" name="" class="" value="" />
 <?php echo $this->Form->input('Profile.0.division_id',array('onChange'=>'getDistrictId(this.value);','class'=>'form-control','placeholder'=>'Division','label'=>false,'empty'=>'Select Division'));?>

<?php 
  public function districtList(){
    $this->autoRender = false;
    $data = $_REQUEST['division_id'];
    $districts = $this->District->find(
        'list',
        array('fields'=>array('id','name'),'recursive'=>-1, 'conditions'=>array('District.division_id'=>$data))
      );
    return json_encode($districts);
  }
?>