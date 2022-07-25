<?php
	error_reporting(0);

if($_SERVER['SERVER_NAME']=="localhost")
{


}
else
{
	error_reporting(0);
}

class Order
{
	public function __construct()
	{
		
	}
	
	//-------------Login here---------------
	function UserLogin()
	{
		
		if(isset($_POST['login'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$pass = sha1($pass);
			
			$query= mysql_query("SELECT id FROM tbl_user_info WHERE user_name='$user' AND password='$pass' AND IsActive = 1 ");
			//$result=mysql_fetch_array($query);
			$row= mysql_num_rows($query);
			$user = mysql_fetch_array($query);
			if($row == 1){
				$_SESSION['u_id']=$user['id'];
				echo "<p class='msg_success'>Login Successful</p>";
				echo "<meta http-equiv=refresh content=1;url=./index.php>";
			}else{
				echo "<p class='msg_error'>Login Failed. Invalid user name or password</h3></p></center>";
			}
		}
	}
	//-------------Login here---------------
	
	
	//-------------User Session----------
	function UserSession()
	{
		$id = $_SESSION['u_id'];
		$user_info = mysql_query("SELECT * FROM tbl_user_info WHERE id='$id'");
		$row = mysql_num_rows($user_info); 
		$student = mysql_fetch_object($user_info);
		return $student;
	}
	//-------------User Session----------
	
	//-------------user Logout----------
	function UserLogout()
	{
		//$server = $this->server;
		if(isset($_GET['logout'])){
			session_start();
			session_destroy();
			echo "<meta http-equiv=refresh content=0;url=./login.php>";
		}
	}
	//-------------user logout----------


	//------------- my account Change password----------
	function MyAccountChangePassword()
	{
		if(isset($_POST['change_pass'])){
			$id = $_POST['id'];
			$old_pass = SHA1($_POST['old_pass']);
			$new_pass01 = $_POST['new_pass01'];
			$new_pass02 = $_POST['new_pass02'];

			$event			= 'Settings | change password';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];


			$check_pass = mysql_num_rows(mysql_query("SELECT id FROM tbl_user_info WHERE id='$id' AND password='$old_pass' "));
			if($check_pass != 1){
				echo "<p class='msg_alert'>Your current password is not matched. Please input correct psssword.</p>";
				$status	= 'Wrong password';
				$this->AuditLog($event,'pass 1: '.$new_pass01.''.$new_pass02,'Wrong password',$status,$action_link,$ip_addr);
			}else if($new_pass01 != $new_pass02){
				echo "<p class='msg_error'>Password mismatched.</p>";
				$status	= 'Password not matched';
				$this->AuditLog($event,'pass 1: '.$new_pass01.''.$new_pass02,'pasword not matched',$status,$action_link,$ip_addr);
			}else{
				$new_pass = SHA1($_POST['new_pass02']);
				$sql_change_pass = "UPDATE tbl_user_info SET password='$new_pass' WHERE id = '$id' ";
				$result_change_pass = mysql_query($sql_change_pass);
				$fetch_data_array = mysql_fetch_object(mysql_query("SELECT full_name,user_name From tbl_user_info WHERE id ='$id' "));

				if($result_change_pass){
					echo "<p class='msg_success'>Successfully changed.</p>";
					$status	= 'Successful';
					$this->AuditLog($event,$sql_change_pass,$fetch_data_array,$status,$action_link,$ip_addr);
				
				}else{
					echo "<p class='msg_Error'>Failed to change password.</p>";
					$status	= 'Failed';
					$this->AuditLog($event,$sql_change_pass,$fetch_data_array,$status,$action_link,$ip_addr);
				}
				
			}
		}
	}
	//-------------my account Change password----------



	//------------- my account Update profile ----------
	function MyAccountUpdateProfile()
	{
		if(isset($_POST['update_profile'])){
			$id = $_POST['id'];
			$name 		= $_POST['name'];
			$address 	= $_POST['address'];
			$mobile 	= $_POST['mobile'];
			$user 	= $_POST['user'];

			$event			= 'Settings | Update profile';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			$sql_update_pro = "UPDATE tbl_user_info SET full_name = '$name' , user_name = '$user' , mobile = '$mobile' , address = '$address' WHERE id = '$id' ";
			$result_update_pro = mysql_query($sql_update_pro);
			$fetch_data_array = mysql_fetch_object(mysql_query("SELECT full_name,user_name,mobile,address From tbl_user_info WHERE id ='$id' "));

			if($result_update_pro){
				echo "<p class='msg_success'>Successfully Updated.</p>";
				$status	= 'Successful';
				$this->AuditLog($event,$sql_update_pro,$fetch_data_array,$status,$action_link,$ip_addr);
				echo "<meta http-equiv=refresh content=2;url=./index.php?id=my_profile>";
			}else{
				echo "<p class='msg_Error'>Failed to Update profile.</p>";
				$status	= 'Failed';
				$this->AuditLog($event,$sql_update_pro,$fetch_data_array,$status,$action_link,$ip_addr);
			}
		}
	}
	//-------------my account Update profile ----------



	//------------- user Access---------
	function IsUserAccess()
	{
		$u_id = $_SESSION['u_id'];
		$sql_get_role = "SELECT role FROM tbl_user_info WHERE id='$u_id' ";
		$user = mysql_fetch_array(mysql_query($sql_get_role));
		$sql_permission = "SELECT permission_id FROM role_permission_mapping Where role_id='$user[role]' and permission_id in (1,2,3,4,10,11,12,13)";
		$result_permission = mysql_query($sql_permission);
		
		if(mysql_num_rows($result_permission)>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	//------------- user Access---------

	//------------- Data Access---------
	function IsDataAccess()
	{
		$u_id = $_SESSION['u_id'];
		$sql_get_role = "SELECT role FROM tbl_user_info WHERE id='$u_id' ";
		$user = mysql_fetch_array(mysql_query($sql_get_role));
		$sql_permission = "SELECT permission_id FROM role_permission_mapping Where role_id='$user[role]' and permission_id in (6,7,8,9)";
		$result_permission = mysql_query($sql_permission);
		
		if(mysql_num_rows($result_permission)>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	//------------- Data Access---------

	//------------- Audit Access---------
	function IsAuditAccess()
	{
		return $this->search_role(5);	
	}
	//------------- Audit Access---------






	//------------- ----------
	function IsDataInsert()
	{
		return $this->search_role(6);	
	}
	//------------- ----------

	//---------------------
	function IsDataEdit()
	{
		return $this->search_role(7);	
	}
	//-------------------

	//---------------------
	function IsDataDelete()
	{
		return $this->search_role(8);	
	}
	//------------- ---------

	//------------- ---------
	function IsDataList()
	{
		return $this->search_role(9);	
	}
	//--------------------


	//------------- ----------
	function IsUserInsert()
	{
		return $this->search_role(1);	
	}
	//------------- ----------

	//---------------------
	function IsUserEdit()
	{
		return $this->search_role(2);	
	}
	//-------------------

	//---------------------
	function IsUserDelete()
	{
		return $this->search_role(3);	
	}
	//------------- ---------

	//------------- ---------
	function IsUserList()
	{
		return $this->search_role(4);	
	}
	//--------------------

	//------------- ---------
	function IsRoleAssign()
	{
		return $this->search_role(10);	
	}
	//--------------------

	//------------- ---------
	function IsRoleEdit()
	{
		return $this->search_role(11);	
	}
	//--------------------
	
	//------------- ---------
	function IsRoleCreate()
	{
		return $this->search_role(12);	
	}
	//--------------------
	
	//------------- ---------
	function IsRoleDelete()
	{
		return $this->search_role(13);	
	}
	//--------------------

	//------------- ---------
	function IsOrderSubmit()
	{
		return $this->search_role(14);	
	}
	//--------------------

	//------------- ---------
	function IsOrderReportView()
	{
		return $this->search_role(15);	
	}
	//--------------------



	//------------- Audit Access---------

	//--------------Main table----------------
	function MainTableDataView(){
		$sel_data_view = "SELECT * FROM tbl_main";
		$result_data_view = mysql_query($sel_data_view);

		$sl=1;
		While($d = mysql_fetch_object($result_data_view)){
			echo "<tr>";
			echo "<td>".$sl."</td>";
			echo "<td>".$d->field1."</td>";
			echo "<td>".$d->field2."</td>";
			echo "<td>".$d->field3."</td>";
			echo "<td>".$d->field4."</td>";
			echo "<td>".$d->field5."</td>";
			echo "<td>".$d->field6."</td>";
			echo "<td>".$d->field7."</td>";
			echo "<td>";
			if($this->IsUserEdit() != 0)
			{
				echo "<a href='index.php?id=data_edit&edit_id=".$d->id."'> Edit </a>";
			}
			if($this->IsUserDelete() != 0)
			{
				echo "<a href='index.php?id=data&del_id=".$d->id."'> Delete </a>";
			}
			echo "</td>";
			$sl++;
		}
	}
	//--------------Main table----------------

	//--------------Add new user----------------
	function AddNewUser()
	{
		if(isset($_POST['save'])){
			$fld1 = $_POST['fld1'];
			$fld2 = $_POST['fld2'];
			$fld3 = $_POST['fld3'];
			$fld4 = $_POST['fld4'];
			$fld5 = $_POST['fld5'];
			$fld6 = $_POST['fld6'];
			$fld7 = $_POST['fld7'];

			$event			= 'Add new Data';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			$sql_add_user = "INSERT INTO tbl_main(field1,field2,field3,field4,field5,field6,field7,create_datetime) VALUES('$fld1','$fld2','$fld3','$fld4','$fld5','$fld6','$fld7',now() )";
			$result_add_user = mysql_query($sql_add_user);
			$ins_id = mysql_insert_id();
			$fetch_data_array = mysql_fetch_object(mysql_query("SELECT field1,field2,field3,field4,field5,field6,field7,create_datetime From tbl_main WHERE id ='$ins_id' "));

			if($result_add_user)
			{
				echo "<p class='msg_success'>Successfully inserted</p> ";
				$status	= 'Successful';
				$this->AuditLog($event,$sql_add_user,$fetch_data_array,$status,$action_link,$ip_addr);

			}else
			{
				echo "<p class='msg_error'>Failed to inserted</p> ";
				$status	= 'Failed';
				$this->AuditLog($event,$sql_add_user,$fetch_data_array,$status,$action_link,$ip_addr);
			}
		}
	}
	//--------------Add new user----------------


	//--------------Update user----------------
	function UpdateUser()
	{
		if(isset($_POST['update'])){
			$id = $_POST['id'];
			$fld1 = $_POST['fld1'];
			$fld2 = $_POST['fld2'];
			$fld3 = $_POST['fld3'];
			$fld4 = $_POST['fld4'];
			$fld5 = $_POST['fld5'];
			$fld6 = $_POST['fld6'];
			$fld7 = $_POST['fld7'];

			$event			= 'Update Data';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			//$sql_edit_user = "INSERT INTO tbl_main(field1,field2,field3,field4,field5,field6,field7,create_datetime) VALUES('$fld1','$fld2','$fld3','$fld4','$fld5','$fld6','$fld7',now() )";
			$sql_edit_user = "UPDATE tbl_main SET 
							field1 = '$fld1' ,
							field2 = '$fld2' ,
							field3 = '$fld3' ,
							field4 = '$fld4' ,
							field5 = '$fld5' ,
							field6 = '$fld6' ,
							field7 = '$fld7' ,
							update_datetime = now() WHERE id = '$id' ";
			$result_edit_user = mysql_query($sql_edit_user);
			$fetch_data_array = mysql_fetch_object(mysql_query("SELECT full_name,user_name,mobile,address,role,IsActive* From tbl_main WHERE id ='$id' "));


			if($result_edit_user)
			{
				echo "<p class='msg_success'>Successfully Updatet</p> ";
				$status	= 'Successful';
				$this->AuditLog($event,$sql_edit_user,$fetch_data_array,$status,$action_link,$ip_addr);
				echo "<meta http-equiv=refresh content=1;url=./index.php?id=data>";
			}else
			{
				echo "<p class='msg_error'>Failed to update data</p> ";
				$status	= 'Failed';
				$this->AuditLog($event,$sql_edit_user,$fetch_data_array,$status,$action_link,$ip_addr);
			}
		}
	}
	//-------------Update user----------------


	//------------ Global Delete---------------
	function Delete($id,$table){
		
		$fetch_data_array = mysql_fetch_object(mysql_query("SELECT * From $table WHERE id ='$id' "));
		$sql_del = "DELETE FROM $table WHERE id='$id' ";
		$result_del = mysql_query($sql_del);

		$event			= 'Delete';
		$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$ip_addr		= $_SERVER['REMOTE_ADDR'];

		if($result_del)
		{
			echo "<p class='msg_success'>Successfully Deleted</p> ";
			$status	= 'Successful';
			$this->AuditLog($event,$sql_del,$fetch_data_array,$status,$action_link,$ip_addr);
		}else
		{
			echo "<p class='msg_error'>Failed to Delete data</p> ";
			$status	= 'Failed';
			$this->AuditLog($event,$sql_del,$fetch_data_array,$status,$action_link,$ip_addr);
		}
	}
	//------------ Global Delete---------------


	//--------------Audit log ------------------
	function AuditLog($event,$applied_sql,$full_data,$status,$action_link,$ip_addr){
		$description = " | Status : ".$status." | Hit page : ".$action_link." | IP : ".$ip_addr;
		$description = mysql_escape_string($description);
		$applied_sql = mysql_escape_string($applied_sql);
		
		$user_id = $_SESSION['u_id'];
		$user_info =  mysql_fetch_object(mysql_query("SELECT full_name FROM tbl_user_info WHERE id='$user_id'"));
		$user = $user_info->full_name;
		$data = json_encode($full_data);
		//$data = mysql_escape_string($data);
		$sql_audit_log = "INSERT INTO tbl_audit_log (event,applied_sql,full_data,user,description,action_datetime) VALUES('$event','$applied_sql','$data','$user','$description',now() ) ";
		
		//echo $sql_audit_log;
		//echo "Audit log : : : ".$data;

		$result_audit_log = mysql_query($sql_audit_log);
		/*
		if($result_audit_log){
			echo "<p class='msg_success'>Successfully Audit</p> ";
		}else
		{
			echo "<p class='msg_error'>Failed to Audit</p> ";
		}
		*/
	}
	//--------------Audit log ------------------

	//--------------Audit log view----------------
	function AuditLogView(){
		$sql_audit_view = "SELECT * FROM tbl_audit_log  ORDER BY id DESC";
		$result_audit_view = mysql_query($sql_audit_view);

		$sl=1;
		While($d = mysql_fetch_object($result_audit_view)){
			echo "<tr>";
			echo "<td>".$sl."</td>";
			echo "<td>".$d->event."</td>";
			echo "<td>".$d->user."</td>";
			echo "<td>".$d->description."</td>";
			echo "<td>".$d->action_datetime."</td>";
			echo "<td>".$d->full_data."</td>";
			$sl++;
		}
	}
	//--------------Audit log view----------------
	
	//--------------Add new role----------------
	function AddNewRole(){
		if(isset($_POST['save_role'])){
			
			$user_id = $_SESSION['u_id'];

			if(!isset($_POST['chk_perm']))
			{
				echo "<p class='msg_alert'>No Role selected yet</p>";
				$count = 0;
			}else
			{
				$role = $_POST['role'];
				$chk_q = $_POST['chk_perm'];

				$check_role = mysql_num_rows(mysql_query("SELECT role_name FROM tbl_role WHERE role_name = '$role' "));
				if($check_role > 0){
					$event			= 'Add New Role';
					$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					$ip_addr		= $_SERVER['REMOTE_ADDR'];

					$status	= 'Role already exist';
					$this->AuditLog($event,$sql_add_role,$role,$status,$action_link,$ip_addr);
						
					echo "<p class='msg_alert'>You have to insert a unique role. This role already exist.</p> ";
				}else{
					$sql_add_role = "INSERT INTO tbl_role(role_name,create_user_id,create_datetime) VALUES('$role','$user_id',now() ) ";
					$result_add_role = mysql_query($sql_add_role);
					$role_id = mysql_insert_id();
					$fetch_data_array = mysql_fetch_object(mysql_query("SELECT role_name,create_user_id,create_datetime From tbl_role WHERE id ='$role_id' "));
					
					$event			= 'Add New Role';
					$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					$ip_addr		= $_SERVER['REMOTE_ADDR'];
					
					for ($i=0; $i<count($chk_q); $i++) {
						$permission_id = $chk_q[$i];
				        //echo $group_id. $question_id."<br>";
						$sql_mapping = "INSERT INTO role_permission_mapping(role_id,permission_id) VALUES('$role_id','$permission_id') ";
						$result_mapping  = mysql_query($sql_mapping);

						if($result_mapping){
							//echo "Success..!!";$status	= 'Successful';
							$count = 1;
						}else{
							//echo "Failed..!!";
							$count = 0;
						}
				    }

//thi is comment

				    if ($count == 1){
				    	echo "<p class='msg_success'>Successful.</p> ";
				    	$status	= 'Successful';
						$this->AuditLog($event,$sql_add_role,$fetch_data_array,$status,$action_link,$ip_addr);
						echo "<meta http-equiv=refresh content=1;url=./index.php?id=manage_user_new_role>";
				    }else{
				    	echo "<p class='msg_error'>Failed to create role.</p> ";
				    	$status	= 'Failed';
						$this->AuditLog($event,$sql_add_role,$fetch_data_array,$status,$action_link,$ip_addr);
				    }
				}
			}    
		}
	}
	//--------------Add new role----------------
	
	//--------------update role----------------
	function UpdateRole(){
		if(isset($_POST['update_role'])){

			$user_id = $_SESSION['u_id'];

			if(!isset($_POST['chk_perm']))
			{
				echo "<p class='msg_alert'>No Role selected yet</p>";
			}else
			{
				$role		= $_POST['role'];
				$role_id	= $_POST['id'];
				$user_id	= $_SESSION['u_id'];
				$chk_q		= $_POST['chk_perm'];

				$sql_edit_role = "UPDATE tbl_role SET 
							role_name		= '$role' ,
							create_user_id	= '$user_id' ,
							update_datetime = now() WHERE id = '$role_id' ";
				$result_edit_role = mysql_query($sql_edit_role);

				$sql_detele_mapping = "DELETE FROM role_permission_mapping WHERE role_id='$role_id' ";
				$result_delete_mapping = mysql_query($sql_detele_mapping); // for fresh mapping

				$event			= 'Update Role';
				$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
				$ip_addr		= $_SERVER['REMOTE_ADDR'];
				
				for ($i=0; $i<count($chk_q); $i++) {
					$permission_id = $chk_q[$i];
			        //echo $group_id. $question_id."<br>";
					$sql_mapping = "INSERT INTO role_permission_mapping(role_id,permission_id) VALUES('$role_id','$permission_id') ";
					$result_mapping  = mysql_query($sql_mapping);
					$ins_id = mysql_insert_id();
					$fetch_data_array = mysql_fetch_object(mysql_query("SELECT role_id,permission_id From role_permission_mapping WHERE role_id ='$role_id' "));


					if($result_mapping){
						//echo "Success..!!";$status	= 'Successful';
						$count = 1;
						
					}else{
						//echo "Failed..!!";
						$count = 1;
						}
			    }

			    if ($count == 1){
			    	echo "<p class='msg_success'>Successful</p> ";
			    	$status	= 'Successful';
					$this->AuditLog($event,$sql_edit_role,$fetch_data_array,$status,$action_link,$ip_addr);
					echo "<meta http-equiv=refresh content=1;url=./index.php?id=manage_user_new_role>";
				}else{
			    	echo "<p class='msg_error'>Failed to Update role.</p> ";
			    	$status	= 'Failed';
					$this->AuditLog($event,$sql_edit_role,$fetch_data_array,$status,$action_link,$ip_addr);
			    }
			}
			/*
			if($result_edit_role)
			{
				echo "<p class='msg_success'>Successfully Updatet</p> ";
				$status	= 'Successful';
				$this->AuditLog($event,$sql_edit_role,$status,$action_link,$ip_addr);
				echo "<meta http-equiv=refresh content=1;url=./index.php?id=manage_user_new_role>";
			}else
			{
				echo "<p class='msg_error'>Failed to update data</p> ";
				$status	= 'Failed';
				$this->AuditLog($event,$sql_edit_role,$status,$action_link,$ip_addr);
			}
			*/
		}
	}
	//--------------update role----------------
	
	//--------------view role table----------------
	function ViewRoleTable(){
		$sql_role_view = "SELECT * FROM tbl_role  ORDER BY id DESC";
		$result_role_view = mysql_query($sql_role_view);

		While($d = mysql_fetch_object($result_role_view)){
			echo "<tr>";
			echo "<td>".$d->role_name."</td>";
			echo "<td>";
			if($this->IsRoleEdit() != 0)
			{
				if($d->id != 1){
					echo "<a href='index.php?id=manage_user_role_edit&edit_id=".$d->id."'> Edit </a>";
				}
			}
			if($this->IsRoleDelete() != 0)
			{
				if($d->id != 1){
					echo "<a href='index.php?id=manage_user_new_role&del_id=".$d->id."'> Delete </a>";
				}else{
					echo "Super Admin is not Changable";
				}
			}
			echo "</td>";
		}
	}
	//--------------view role table----------------
	
	//--------------view role list----------------
	function ViewRoleList(){
		$sql_view_role = "SELECT * FROM tbl_role ";
		$result_view_role = mysql_query($sql_view_role);

		while($q = mysql_fetch_object($result_view_role)){
			if($q->id != 1){
				echo "<option value='".$q->id."'>".$q->role_name."</option>";
			}
		}
	}
	//--------------view role list----------------
	
	//--------------view Permission table---------------
	function PermissionViewToAssign(){
		$sql_view_role = "SELECT * FROM tbl_permission";
		$result_view_role = mysql_query($sql_view_role);

		$sl = 1;
		while($q = mysql_fetch_object($result_view_role)){
			echo "<tr>";
				echo "<td>".$sl."</td>";
				echo "<td><input type='checkbox' name='chk_perm[]' value='".$q->id."' />
</td>";
				echo "<td>".$q->permission."</td>";
			echo "</tr>";
			$sl++;
		}
	}
	//--------------view Permission table---------------


	//--------------Add new user manage----------------
	function AddNewUserManage()
	{
		if(isset($_POST['save'])){
			$name = mysql_escape_string($_POST['name']);
			$user = mysql_escape_string($_POST['user']);
			$mobile = mysql_escape_string($_POST['mobile']);

			$address = mysql_escape_string($_POST['address']);
			$role = $_POST['role'];
			$pass01 = $_POST['pass01'];
			$pass02 = $_POST['pass02'];

			if($_POST['active']){
				$active = $_POST['active'];
			}else{
				$active = 0;
			}

			$event			= 'Add user';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			$check_user_exist = mysql_num_rows(mysql_query("SELECT user_name FROM tbl_user_info WHERE user_name = '$user' "));
			$check_mobile_exist = mysql_num_rows(mysql_query("SELECT mobile FROM tbl_user_info WHERE mobile = '$mobile' "));
			if($check_user_exist > 0){
				echo "<p class='msg_alert'>Your inserted user name already exist</p> ";
				$status	= ' duplicate user name';
				$this->AuditLog($event,'try with duplicate user name','duplicate user: '.$user,$status,$action_link,$ip_addr);
			}else if($check_mobile_exist > 0){
				echo "<p class='msg_alert'>Your inserted mobile number already exist</p> ";
				$status	= ' duplicate mobile number';
				$this->AuditLog($event,'try with duplicate mobile number','duplicate mobile: '.$mobile,$status,$action_link,$ip_addr);
			}else if($pass01 != $pass02){
				echo "<p class='msg_error'>Password mismatched</p> ";
				$status	= 'password mismatch';
				$this->AuditLog($event,'pass 1: '.$pass01.', pass 2: '.$pass02,'password mismatched.',$status,$action_link,$ip_addr);
			}else{
				$pass = sha1($pass02);

				$sql_add_user = "INSERT INTO tbl_user_info(full_name,user_name,mobile,address,password,role,IsActive) VALUES('$name','$user','$mobile','$address','$pass','$role',".$active." )";
				$result_add_user = mysql_query($sql_add_user);
				$ins_id = mysql_insert_id();
				$fetch_data_array = mysql_fetch_object(mysql_query("SELECT full_name,user_name,mobile,address,role,IsActive From tbl_user_info WHERE id ='$ins_id' "));

				if($result_add_user)
				{
					echo "<p class='msg_success'>Successfully inserted</p> ";
					//echo "<pre>".print_r($fetch_data_array)."</pre> ";
					$status	= 'Successful';
					$this->AuditLog($event,$sql_add_user,$fetch_data_array,$status,$action_link,$ip_addr);
					echo "<meta http-equiv=refresh content=2;url=./index.php?id=manage>";

				}else
				{
					echo "<p class='msg_error'>Failed to insert.</p> ";
					$status	= 'Failed';
					$this->AuditLog($event,$sql_add_user,$fetch_data_array,$status,$action_link,$ip_addr);
				}
			}			
		}
	}
	//--------------Add new user manage----------------


	//--------------Update user manage----------------
	function UpdateUserManage()
	{
		if(isset($_POST['update_user'])){
			$id = $_GET['edit_id'];
			$name = $_POST['name'];
			$user = $_POST['user'];
			$mobile = $_POST['mobile'];
			$address = $_POST['address'];
			$role = $_POST['role'];
			$pass01 = $_POST['pass01'];
			$pass02 = $_POST['pass02'];

			if($_POST['active']){
				$active = $_POST['active'];
			}else{
				$active = 0;
			}

			if($pass01 != $pass02){
				echo "<p class='msg_error'>Password mismatched.!</p> ";
			}else{
				$pass = sha1($pass02);

				//echo $user." : user<br>". $id." : id <br>". $role." : role<br>". $pass;
				
				$event			= 'Update user manage';
				$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
				$ip_addr		= $_SERVER['REMOTE_ADDR'];

				//$sql_edit_user = "INSERT INTO tbl_main(field1,field2,field3,field4,field5,field6,field7,create_datetime) VALUES('$fld1','$fld2','$fld3','$fld4','$fld5','$fld6','$fld7',now() )";
				$sql_edit_user = "UPDATE tbl_user_info SET  
								full_name	= '$name' ,
								user_name	= '$user' ,
								mobile		= '$mobile' ,
								address		= '$address' ,
								password 	= '$pass' ,
								role 		= '$role' ,
								IsActive 	= '$active' WHERE id = '$id' ";
				$result_edit_user = mysql_query($sql_edit_user);
				$fetch_data_array = mysql_fetch_object(mysql_query("SELECT full_name,user_name,mobile,address,role,IsActive From tbl_user_info WHERE id ='$id' "));


				if($result_edit_user)
				{
					echo "<p class='msg_success'>Successfully Updatet</p> ";
					$status	= 'Successful';
					$this->AuditLog($event,$sql_edit_user,$fetch_data_array,$status,$action_link,$ip_addr);
					echo "<meta http-equiv=refresh content=1;>";
				}else
				{
					echo "<p class='msg_error'>Failed to update data</p> ";
					$status	= 'Failed';
					$this->AuditLog($event,$sql_edit_user,$fetch_data_array,$status,$action_link,$ip_addr);
				}
				
			}
		}
	}
	//-------------Update manage user----------------

	//-------------- manage user----------------
	function ManageUserDataView(){
		$sel_data_view = "SELECT * FROM tbl_user_info";
		$result_data_view = mysql_query($sel_data_view);

		While($d = mysql_fetch_object($result_data_view)){
			echo "<tr>";
			echo "<td>".$d->full_name."</td>";
			echo "<td>".$d->user_name."</td>";
			echo "<td>".$d->mobile."</td>";

			$role = mysql_fetch_array(mysql_query("SELECT role_name FROM tbl_role WHERE id = $d->role "));
			
			if($role['role_name'] == null){
				echo "<td><p class='msg_alert'>No Role assigned</p></td>";
				//echo "no";
			}else{
				echo "<td>".$role['role_name']."</td>";
			}
			
			echo "<td>".$d->address."</td>";
			//$d->role
			
			
			if($d->IsActive == 1){
				echo "<td><p class='msg_success'>Yes</p></td>";
			}else{
				echo "<td><p class='msg_error'>No</p></td>";
			}
			
			echo "<td>";
			if($this->IsUserEdit() != 0)
			{
				if($d->role != 1){
					echo "<a href='index.php?id=manage_user_edit_data&edit_id=".$d->id."'> Edit </a>";
				}
			}
			if($this->IsUserDelete() != 0)
			{
				if($d->role != 1){
					echo "<a href='index.php?id=manage&del_id=".$d->id."'> Delete </a>";
				}else{

				}
			}
			echo "</td>";
		}
	}
	//-------------- manage user----------------


	//-------------- manage user list----------------
	function ManageUserList(){
		$sql_view_user = "SELECT * FROM tbl_user_info ";
		$result_view_user = mysql_query($sql_view_user);

		while($q = mysql_fetch_object($result_view_user)){
			echo "<option value='".$q->id."'>".$q->user_name."</option>";
		}
	}
	//-------------- manage user list----------------

	//-------------- manage user ROLE----------------
	function PermissionAssign(){
		if(isset($_POST['permission_assign']))
		{
			if(!isset($_POST['chk_perm']))
			{
				echo "<p class='msg_alert'>No Role selected yet</p>";
			}else
			{
				$role_id = $_POST['role_id'];
				$chk_q = $_POST['chk_perm'];

				$sql_detele_mapping = "DELETE FROM role_permission_mapping WHERE role_id='$role_id' ";
				$result_delete_mapping = mysql_query($sql_detele_mapping); // for fresh mapping

				$event			= 'Update user manage';
				$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
				$ip_addr		= $_SERVER['REMOTE_ADDR'];
				
				for ($i=0; $i<count($chk_q); $i++) {
					$permission_id = $chk_q[$i];
			        //echo $group_id. $question_id."<br>";
					$sql_mapping = "INSERT INTO role_permission_mapping(role_id,permission_id) VALUES('$role_id','$permission_id') ";
					$result_mapping  = mysql_query($sql_mapping);
					$ins_id = mysql_insert_id();
					$fetch_data_array = mysql_fetch_object(mysql_query("SELECT role_id,permission_id From role_permission_mapping WHERE id ='$ins_id' "));


					if($result_mapping){
						//echo "Success..!!";$status	= 'Successful';
						$status	= 'Succsess.!';
						$this->AuditLog($event,$sql_mapping,$fetch_data_array,$status,$action_link,$ip_addr);

			
					}else{
						//echo "Failed..!!";
						$status	= 'Failed';
						$this->AuditLog($event,$sql_mapping,$fetch_data_array,$status,$action_link,$ip_addr);
					}
			    }
			    //echo "<meta http-equiv=refresh content=0;url=./index.php?id=admin_group_mapping>";

			}
		    
		}
	}
	//-------------- manage user ROLE----------------



	//-------------- view assigned role ----------------
	function ViewAssignedPermission($role){
			
		$sql_view_permission = "SELECT * FROM tbl_permission ";
		$result_view_permission = mysql_query($sql_view_permission);
		echo "<ul style='list-style:none;'>";
		while($q = mysql_fetch_object($result_view_permission))
		{
			$permission_id = $q->id;

			if($this->CheckPermission($role,$permission_id) == 1){
				echo "<li><input type='checkbox' name='chk_perm[]'' value='".$q->id."' checked /> ";
			}else{
				echo "<li><input type='checkbox' name='chk_perm[]'' value='".$q->id."' unchecked/> ";
			}
			echo " ".$q->permission."</li>";
						
		}
		echo "</ul>";

	}
	//-------------- view assigned role ----------------

	//-------------- view Permission list----------------
	function ViewPermissionList(){
		$role = $_POST['role'];
			
		$sql_view_permission = "SELECT * FROM tbl_permission ";
		$result_view_permission = mysql_query($sql_view_permission);
		echo "<ul style='list-style:none;'>";
			while($q = mysql_fetch_object($result_view_permission))
			{
				$permission_id = $q->id;
				echo "<li><label><input type='checkbox' name='chk_perm[]'' value='".$q->id."' /> ".$q->permission."</label></li>";				
			}
		echo "</ul>";

	}
	//-------------- view Permission list----------------


	//-------------- Sample function for message order ----------------
	function SendMessageOrder(){
		if(isset($_POST['mssg_order']))
		{
			$mob = $_POST['mobile'];
			$mssg = $_POST['message'];

			//---check mobile number permitter to send order sms or not---
			$search_sumitter_role_id = mysql_fetch_object(mysql_query("SELECT role FROM tbl_user_info WHERE mobile = '$mob' "));
			$role_id = $search_sumitter_role_id->role;
			$check_permission = mysql_query("SELECT permission_id FROM role_permission_mapping WHERE role_id = '$role_id' and permission_id = 14 ");
			$check_permission_active =  mysql_num_rows($check_permission);
			//---check mobile number permitter to send order sms or not---


			$event			= 'SMS Order Submit';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			$sql_insert_message = "INSERT INTO tbl_sms(sms,mobile_number,create_datetime,is_valid) VALUES('$mssg' , '$mob', now(), 0 ) ";
			$result_insert_message = mysql_query($sql_insert_message);
			$last_inserted_id = mysql_insert_id();
			$fetch_data_array = mysql_fetch_object(mysql_query("SELECT sms,mobile_number,create_datetime,is_valid From tbl_sms WHERE id ='$last_inserted_id' "));
			

			$mssg_data = explode("|", $mssg);
			//echo "mobile number: ".$mob."<br>";

			$order_number 	= $mssg_data[0];
			$house_id 		= $mssg_data[1];
			
			$get_date 		= $mssg_data[2];
			$year 	= substr("$get_date",0,4);
			$month 	= substr("$get_date",4,2);
			$day 	= substr("$get_date",6,2);
			
			$date 	= "$year-$month-$day";
			
			//echo "<hr>";
			
			$mob_check 		= mysql_num_rows(mysql_query("SELECT * FROM tbl_user_info WHERE mobile = '$mob' "));
			$house_check 	= mysql_num_rows(mysql_query("SELECT house_id FROM tbl_house_info_details WHERE house_id = '$house_id' "));
			

			
			if($mob_check == 0){
				echo "<p class='msg_error'>Sorry! Your inserted mobile number is not Authorized. </p>";
				$status	= 'Unknown number';
				$this->AuditLog($event,$sql_insert_message,$fetch_data_array,$status,$action_link,$ip_addr);
			}elseif ($check_permission_active == 0) {
				echo "<p class='msg_error'>Sorry! Your hae no permission to submit sms order.</p>";
				$status	= 'Unauthorized number';
				$this->AuditLog($event,$sql_insert_message,$fetch_data_array,$status,$action_link,$ip_addr);
			}elseif ($house_check == 0) {
				echo "<p class='msg_error'>Sorry! Your inserted house ID not Found </p>";
				$status	= 'Unauthorized number';
				$this->AuditLog($event,$sql_insert_message,$fetch_data_array,$status,$action_link,$ip_addr);
			}
			else
			{	if(count($mssg_data) != 11){
					echo "<p class='msg_error'>Invalid SMS. You need to add total 11 parameters.</p>";
					$status	= 'Invalid message';
					$this->AuditLog($event,$sql_insert_message,$fetch_data_array,$status,$action_link,$ip_addr);
				}else{
					$sql_update_message_validation = " UPDATE tbl_sms SET is_valid=1 WHERE id='$last_inserted_id' ";
					$result_update_message_validation = mysql_query($sql_update_message_validation);

					$fetch_data_array = mysql_fetch_object(mysql_query("SELECT sms,mobile_number,create_datetime,is_valid From tbl_sms WHERE id ='$last_inserted_id' "));

					$status	= 'Valid message';
					$this->AuditLog($event,$sql_insert_message,$fetch_data_array,$status,$action_link,$ip_addr);

					$sql_check_order_exist = mysql_query("SELECT house_id FROM tbl_sms_order WHERE house_id='$house_id' AND order_date='$date' ");
					if(mysql_num_rows($sql_check_order_exist) > 0){
						mysql_query("DELETE FROM tbl_sms_order WHERE house_id='$house_id' AND order_date='$date'");
					}

					for($i = 3; $i<=10; $i++){
						$pro_info 		= explode(":", $mssg_data[$i]);
						$brand_pack_id 	= $pro_info[0];
						$quantity 		= $pro_info[1];
						//echo "product Id: ".$pro_info[0]."; product quantity ".$pro_info[1]."<br>";
						
						$sql_insert_order = "INSERT INTO tbl_sms_order(house_id,brand_pack_id,quantity,order_date,create_datetime) VALUES('$house_id','$brand_pack_id','$quantity','$date', now() ) ";
						$result_insert_order = mysql_query($sql_insert_order);
						
						if($result_insert_order){
							$order_status = 1;
						}else{
							$order_status = 0;
						}
					}

					if($order_status == 1){
						echo "<p class='msg_success'>Your order has been successful</p>";
						echo "<meta http-equiv=refresh content=1;url=./index.php?id=sample_order_collection>";
					}else{
						echo "<p class='msg_error'>Failed</p>";
					}
				}
			}
			


		}
	}
	//-------------- Sample function for message order ----------------



	//-------------- Sample function for generate order report ----------------
	function GenerateOrderReport(){
		$today = date('Y-m-d');
		
		$sql_house_view = "SELECT region_name,area_name,territory_name,house_name,brand_name,pack_name,quantity
		
		
		FROM tbl_house_info_details AS A 
		INNER JOIN tbl_house_info_region AS B ON A.region_id = B.id 
		INNER JOIN tbl_house_info_area AS C ON A.area_id = C.id
		INNER JOIN tbl_house_info_territory AS D ON A.territory_id = D.id
		INNER JOIN tbl_house_info_house AS E ON A.house_id = E.id 
		INNER JOIN tbl_sms_order AS F ON A.house_id = F.house_id 
		INNER JOIN tbl_brand_pack AS H 
		INNER JOIN tbl_brand AS G ON H.brand_id = G.id
		WHERE F.brand_pack_id = H.id AND f.order_date = '$today'
		ORDER BY A.region_id,A.area_id,A.territory_id,A.house_id ASC

		";

		$result_house_view = mysql_query($sql_house_view);

		$count = 0;

		While($d = mysql_fetch_object($result_house_view))
		{
			echo "<tr>";
			echo "<td>".$d->region_name."</td>";
			echo "<td>".$d->area_name."</td>";
			echo "<td>".$d->territory_name."</td>";
			echo "<td>".$d->house_name."</td>";
			
			$brand= $d->brand_name;

			echo "<td> <b>".$this->BrandColor($brand)." ".$d->brand_name." </b> </td>";
			echo "<td>".$this->BrandColor($brand)." ".$d->pack_name."</td>";
			/*
			echo "<td>".$d->house_id."</td>";
			echo "<td>".$d->brand_pack_id."</td>";
			*/
			echo "<td>".$d->quantity."</td>";
			$count = $count + $d->quantity;
		}

		echo "<tr><td colspan='6'><b> Total </b></td> <td> <b> ".$count." </b> </td> <tr>";
	}
	//-------------- Sample function for generate order report ----------------



	//-------------- Sample function for generate order report ----------------
	function GenerateOrderReportEveryday(){
		$today = date('Y-m-d');
		
		$sql_house_view = "SELECT region_name,area_name,territory_name,house_name,brand_name,pack_name,quantity
		
		
		FROM tbl_house_info_details AS A 
		INNER JOIN tbl_house_info_region AS B ON A.region_id = B.id 
		INNER JOIN tbl_house_info_area AS C ON A.area_id = C.id
		INNER JOIN tbl_house_info_territory AS D ON A.territory_id = D.id
		INNER JOIN tbl_house_info_house AS E ON A.house_id = E.id 
		INNER JOIN tbl_sms_order AS F ON A.house_id = F.house_id 
		INNER JOIN tbl_brand_pack AS H 
		INNER JOIN tbl_brand AS G ON H.brand_id = G.id
		WHERE F.brand_pack_id = H.id AND f.order_date = '$today'
		ORDER BY A.region_id,A.area_id,A.territory_id,A.house_id ASC

		";

		$result_house_view = mysql_query($sql_house_view);

		$count = 0;

		While($d = mysql_fetch_object($result_house_view))
		{
			echo "<tr>";
			echo "<td>".$d->region_name."</td>";
			echo "<td>".$d->area_name."</td>";
			echo "<td>".$d->territory_name."</td>";
			echo "<td>".$d->house_name."</td>";
			
			$brand= $d->brand_name;

			echo "<td> <b>".$this->BrandColor($brand)." ".$d->brand_name." </b> </td>";
			echo "<td>".$this->BrandColor($brand)." ".$d->pack_name."</td>";
			/*
			echo "<td>".$d->house_id."</td>";
			echo "<td>".$d->brand_pack_id."</td>";
			*/
			echo "<td>".$d->quantity."</td>";
			$count = $count + $d->quantity;
		}

		echo "<tr><td colspan='6'><b> Total </b></td> <td> <b> ".$count." </b> </td> <tr>";
	}
	//-------------- Sample function for generate order report ----------------

	function BrandColor($brand){
		$brand = mysql_fetch_array(mysql_query("SELECT brand_name FROM tbl_brand WHERE brand_name = '$brand' "));

		if($brand['brand_name'] == 'Marlboro RED'){
			return "<font color='#e90404'>";
		}
		else if($brand['brand_name'] == 'Marlboro Gold'){
			return "<font color='#ff6600'>";
		}
		else if($brand['brand_name'] == 'Marlboro Advance'){
			return "<font color='#023498'>";
		}
		else if($brand['brand_name'] == 'BOND STREET'){
			return "<font color='Black'>";
		}
	}





	//-------------- house list view category wise ----------------
	function HouseListView($category){
		if($category == 'region')
		{
			$table = 'tbl_house_info_region';
			$field = 'region_name';
		}
		else if($category == 'area')
		{
			$table = 'tbl_house_info_area';
			$field = 'area_name';
		}
		else if($category == 'territory')
		{
			$table = 'tbl_house_info_territory';
			$field = 'territory_name';
		}
		else if($category == 'house')
		{
			$table = 'tbl_house_info_house';
			$field = 'house_name';
		}

		$sql_view_house = "SELECT * FROM $table";
		$result_view_house = mysql_query($sql_view_house);

		while($d = mysql_fetch_object($result_view_house))
		{
			echo "<option>".$d->$field."</option>";
			
		}
	}
	//-------------- house list view category wise ----------------



	//-------------- house area new add ----------------
	function HouseAreaAddNew(){
		if(isset($_POST['save_house']))
		{
			$region = $_POST['region'];
			$area = $_POST['area'];
			$territory = $_POST['territory'];
			$house = $_POST['house'];

			//--check region--
			$check_region = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_region WHERE region_name ='$region' "));
			if($check_region->id > 0){
				$region_id = $check_region->id;
			}else{
				$region_insert = mysql_query("INSERT INTO tbl_house_info_region(region_name) VALUES('$region') " );
				$region_id = mysql_insert_id();

			}

			//--check area--
			$check_area = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_area WHERE area_name ='$area' "));
			if($check_area->id > 0){
				$area_id = $check_area->id;
			}else{
				$area_insert = mysql_query("INSERT INTO tbl_house_info_area(area_name) VALUES('$area') " );
				$area_id = mysql_insert_id();
			}

			//--check territory--
			$check_territory = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_territory WHERE territory_name ='$territory' "));
			if($check_territory->id > 0){
				$territory_id = $check_territory->id;
			}else{
				$territory_insert = mysql_query("INSERT INTO tbl_house_info_territory(territory_name) VALUES('$territory') " );
				$territory_id = mysql_insert_id();
			}

			//--check house--
			$check_house = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_house WHERE house_name ='$house' "));
			if($check_house->id > 0){
				$house_id = $check_house->id;
			}else{
				$house_insert = mysql_query("INSERT INTO tbl_house_info_house(house_name) VALUES('$house') " );
				$house_id = mysql_insert_id();
			}

			/*
			echo "Region : ". $region. " id:".$region_id."<br>";
			echo "area : ". $area. " id:".$area_id."<br>";
			echo "territory : ". $territory. " id:".$territory_id."<br>";
			echo "house : ". $house. " id:".$house_id."<br>";
			*/
			$event			= 'Add New House details';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];


			$sql_insert_house_detailes = "INSERT INTO tbl_house_info_details(region_id,area_id,territory_id,house_id) VALUES ('$region_id','$area_id','$territory_id','$house_id') ";
			$result_insert_house_details = mysql_query($sql_insert_house_detailes);
			$ins_id = mysql_insert_id();
			$fetch_data_array = mysql_fetch_object(mysql_query("SELECT region_id,area_id,territory_id,house_id From tbl_house_info_details WHERE id ='$ins_id' "));

			
			if($result_insert_house_details){
				$status	= 'Succsess.!';
				$this->AuditLog($event,$sql_insert_house_detailes,$fetch_data_array,$status,$action_link,$ip_addr);
				echo "<p class='msg_success'>New house has been successfully Added.!</p>";
				echo "<meta http-equiv=refresh content=1;url=./index.php?id=area_house_add_new>";
			}else{
				$status	= 'Failed';
				$this->AuditLog($event,$sql_insert_house_detailes,$fetch_data_array,$status,$action_link,$ip_addr);
			}
		}
	}
	//-------------- house area new add ----------------


	//-------------- house area Update ----------------
	function HouseAreaUpdate(){
		if(isset($_POST['update_house']))
		{
			$id = $_POST['id'];
			$region = $_POST['region'];
			$area = $_POST['area'];
			$territory = $_POST['territory'];
			$house = $_POST['house'];

			//--check region--
			//$update_region = mysql_query("UPDATE ");
			$check_region = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_region WHERE region_name ='$region' "));
			$region_id = $check_region->id;
			if($check_region->id > 0){
				$region_id = $region_id;
			}else{
				$region_update = mysql_query("UPDATE tbl_house_info_region SET region_name='$region' WHERE ID='$region_id' " );
				$region_id = mysql_insert_id();
			}

			//--check area--
			$check_area = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_area WHERE area_name ='$area' "));
			if($check_area->id > 0){
				$area_id = $check_area->id;
			}else{
				$area_insert = mysql_query("INSERT INTO tbl_house_info_area(area_name) VALUES('$area') " );
				$area_id = mysql_insert_id();
			}

			//--check territory--
			$check_territory = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_territory WHERE territory_name ='$territory' "));
			if($check_territory->id > 0){
				$territory_id = $check_territory->id;
			}else{
				$territory_insert = mysql_query("INSERT INTO tbl_house_info_territory(territory_name) VALUES('$territory') " );
				$territory_id = mysql_insert_id();
			}

			//--check house--
			$check_house = mysql_fetch_object(mysql_query("SELECT id FROM tbl_house_info_house WHERE house_name ='$house' "));
			if($check_house->id > 0){
				$house_id = $check_house->id;
			}else{
				$house_insert = mysql_query("INSERT INTO tbl_house_info_house(house_name) VALUES('$house') " );
				$house_id = mysql_insert_id();
			}

			/*
			echo "Region : ". $region. " id:".$region_id."<br>";
			echo "area : ". $area. " id:".$area_id."<br>";
			echo "territory : ". $territory. " id:".$territory_id."<br>";
			echo "house : ". $house. " id:".$house_id."<br>";
			*/
			$event			= 'Update House details';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];


			$sql_insert_house_detailes = "Updated tbl_house_info_details(region_id,area_id,territory_id,house_id) VALUES ('$region_id','$area_id','$territory_id','$house_id') ";
			//$result_insert_house_details = mysql_query($sql_insert_house_detailes);
			
			if($result_insert_house_details){
				$status	= 'Succsess.!';
				$this->AuditLog($event,$sql_insert_house_detailes,$fetch_data_array,$status,$action_link,$ip_addr);
				echo "<p class='msg_success'>New house has been successfully Added.!</p>";
				echo "<meta http-equiv=refresh content=1;url=./index.php?id=area_house_add_new>";
			}else{
				$status	= 'Failed';
				$this->AuditLog($event,$sql_insert_house_detailes,$fetch_data_array,$status,$action_link,$ip_addr);
			}
		}
	}
	//-------------- house area Update ----------------

	

	//-------------- view house list ----------------
	function ViewHouseDetailesList()
	{
		//$sql_view_house = "SELECT region_name,area_name,territory_name,house_name,brand_name,pack_name,quantity
		$sql_view_house = "SELECT *
		
		FROM tbl_house_info_details AS A 
		INNER JOIN tbl_house_info_region AS B ON A.region_id = B.id 
		INNER JOIN tbl_house_info_area AS C ON A.area_id = C.id
		INNER JOIN tbl_house_info_territory AS D ON A.territory_id = D.id
		INNER JOIN tbl_house_info_house AS E ON A.house_id = E.id 
		ORDER BY A.region_id,A.area_id,A.territory_id,A.house_id ASC
		";
		$result_view_house = mysql_query($sql_view_house);

		while($q = mysql_fetch_object($result_view_house)){
			echo "<option value='".$q->house_id."'>".$q->region_name." > ".$q->area_name." > ".$q->territory_name." > ".$q->house_name."</option>";
		}
	}
	//-------------- view house list ----------------



	//-------------- view house list ----------------
	function ViewHouseDetailesTable()
	{
		//$sql_view_house = "SELECT region_name,area_name,territory_name,house_name,brand_name,pack_name,quantity
		$sql_view_house = "SELECT *
		
		FROM tbl_house_info_details AS A 
		INNER JOIN tbl_house_info_region AS B ON A.region_id = B.id 
		INNER JOIN tbl_house_info_area AS C ON A.area_id = C.id
		INNER JOIN tbl_house_info_territory AS D ON A.territory_id = D.id
		INNER JOIN tbl_house_info_house AS E ON A.house_id = E.id 
		ORDER BY A.region_id,A.area_id,A.territory_id,A.house_id ASC
		";
		$result_view_house = mysql_query($sql_view_house);

		while($q = mysql_fetch_object($result_view_house)){
			echo "<tr>";
			
			echo "<td>$q->region_name</td>";
			echo "<td>$q->area_name</td>";
			echo "<td>$q->territory_name</td>";
			echo "<td>$q->house_name</td>";
			echo "<td>$q->house_id</td>";

			echo "<td>";
			if($this->IsDataEdit() != 0)
			{
				//echo "<a href='index.php?id=area_house_edit&edit_id=".$q->id."'> Edit </a>";
				
			}
			if($this->IsDataDelete() != 0)
			{
				echo "<a href='index.php?id=area_house_territory&del_id=".$q->id."'> Delete </a>";
				
			}
			echo "</td>";

			echo "<tr>";
		}
	}
	//-------------- view house list ----------------




	//--------------Add new territory officer----------------
	function AddNewTerritoryOfficer()
	{
		if(isset($_POST['save_territory_officer'])){
			$name = $_POST['name'];
			$address = $_POST['address'];
			$mobile = $_POST['mobile'];
			$house = $_POST['house'];
			$category = $_POST['category'];

			if($_POST['active']){
				$active = $_POST['active'];
			}else{
				$active = 0;
			}

			//echo $name."<br>".  $address ."<br>". $mobile  ."<br>". $house ."<br>". $category ."<br>". $active ."<br>";

			$event			= 'Add territory officer';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			$check_mobile_exist = mysql_num_rows(mysql_query("SELECT mobile FROM tbl_territory_officers_info WHERE mobile = '$mobile' "));
			if($check_mobile_exist > 0){
				echo "<p class='msg_alert'>Your inserted mobile number already exist.!</p> ";
			}else{
				$sql_add_territory = "INSERT INTO tbl_territory_officers_info(name,address,mobile,category,house_id,is_active) VALUES('$name','$address','$mobile','$category','$house',".$active." )";
				$result_add_territory = mysql_query($sql_add_territory);
				$ins_id = mysql_insert_id();
				$fetch_data_array = mysql_fetch_object(mysql_query("SELECT name,address,mobile,category,house_id,is_active From tbl_territory_officers_info WHERE id ='$ins_id' "));

				if($result_add_territory)
				{
					echo "<p class='msg_success'>Successfully inserted</p> ";
					$status	= 'Successful';
					$this->AuditLog($event,$sql_add_ter,$fetch_data_array,$status,$action_link,$ip_addr);
					echo "<meta http-equiv=refresh content=1;url=./index.php?id=territory_officer>";
				}else
				{
					echo "<p class='msg_error'>Failed to inserted</p> ";
					$status	= 'Failed';
					$this->AuditLog($event,$sql_add_territory,$fetch_data_array,$status,$action_link,$ip_addr);
				}
			}					
		}
	}
	//--------------Add new territory officer----------------


	//-------------- update territory officer----------------
	function UpdateTerritoryOfficer()
	{
		if(isset($_POST['update_territory_officer'])){
			$id = $_POST['id'];
			$name = $_POST['name'];
			$address = $_POST['address'];
			$mobile = $_POST['mobile'];
			$house = $_POST['house'];
			$category = $_POST['category'];

			if($_POST['active']){
				$active = $_POST['active'];
			}else{
				$active = 0;
			}

			//echo $name."<br>".  $address ."<br>". $mobile  ."<br>". $house ."<br>". $category ."<br>". $active ."<br>";

			$event			= 'Update territory officer';
			$action_link	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$ip_addr		= $_SERVER['REMOTE_ADDR'];

			//$sql_update_territory = "INSERT INTO tbl_territory_officers_info(name,address,mobile,category,house_id,is_active) VALUES('$name','$address','$mobile','$category','$house',".$active." )";
			$sql_update_territory = "UPDATE tbl_territory_officers_info SET name='$name', address='$address', mobile='$mobile', category='$category', house_id='$house', is_active='$active' WHERE id = '$id' ";

//echo "Yo Man - ".$sql_update_territory;


			$result_update_territory = mysql_query($sql_update_territory);

			if($result_update_territory)
			{
				echo "<p class='msg_success'>Successfully Updated</p> ";
				$status	= 'Successful';
				$this->AuditLog($event,$sql_update_territory,$fetch_data_array,$status,$action_link,$ip_addr);
				echo "<meta http-equiv=refresh content=1;url=./index.php?id=territory_officer>";
			}else
			{
				echo "<p class='msg_error'>Failed to Update</p> ";
				$status	= 'Failed';
				$this->AuditLog($event,$sql_update_territory,$fetch_data_array,$status,$action_link,$ip_addr);
			}
								
		}
	}
	//-------------- update territory officer----------------



	//-------------- territory officer ----------------
	function TerritoryOfficerTableView(){
		$sql_data_view = "SELECT * FROM tbl_territory_officers_info";
		$result_data_view = mysql_query($sql_data_view);

		While($d = mysql_fetch_object($result_data_view)){
			echo "<tr>";
			echo "<td>".$d->name."</td>";
			echo "<td>".$d->address."</td>";
			echo "<td>".$d->mobile."</td>";
			echo "<td>".$d->category."</td>";
			//$d->role
			$house = mysql_fetch_array(mysql_query("SELECT house_name FROM tbl_house_info_house WHERE id = $d->house_id "));
			
			if($house['house_name'] == null){
				echo "<td><p class='msg_alert'>No House</p></td>";
				//echo "no";
			}else{
				echo "<td>".$house['house_name']."</td>";
			}

			echo "<td>".$d->house_id."</td>";
			
			if($d->is_active == 1){
				echo "<td><p class='msg_success'>Yes</p></td>";
			}else{
				echo "<td><p class='msg_error'>No</p></td>";
			}
			
			echo "<td>";
			if($this->IsUserEdit() != 0)
			{
				if($d->role != 1){
					echo "<a href='index.php?id=territory_officer_edit&edit_id=".$d->id."'> Edit </a>";
				}
				
			}
			if($this->IsUserDelete() != 0)
			{
				if($d->role != 1){
					echo "<a href='index.php?id=territory_officer&del_id=".$d->id."'> Delete </a>";
				}else{

				}
			}
			echo "</td>";
		}
	}
	//-------------- manage user----------------




























	//------------Check permmision assigned or not----------
	function CheckPermission($role_id,$permission_id){
		$sql_get_permission = "SELECT * FROM role_permission_mapping WHERE role_id='$role_id' AND permission_id='$permission_id' ";
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
	//------------Check permmision assigned or not----------

	//------------- Search Role---------
	function search_role($permission_id)
	{
		$u_id = $_SESSION['u_id'];
		$sql_get_role = "SELECT role FROM tbl_user_info WHERE id='$u_id' ";
		$user = mysql_fetch_array(mysql_query($sql_get_role));
		
		$sql_permission = "SELECT permission_id FROM role_permission_mapping Where role_id=".$user['role']." and permission_id = ".$permission_id;
		$result_permission = mysql_query($sql_permission);
		if(mysql_num_rows($result_permission)>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	//------------- Search Role---------


	

}




?>