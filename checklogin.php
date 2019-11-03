<?php
session_start();
require_once("config/config.php");
if(!isset($_POST['doit'])) $_POST['doit']="";
if(!isset($_POST['username'])) $_POST['username']="";
if(!isset($_POST['password'])) $_POST['password']="";

if(isset($_POST['doit']) && $_POST['doit']=="confirm")
{

$username=mysql_real_escape_string($_POST['username']);
$password=mysql_real_escape_string($_POST['password']);
$role=mysql_real_escape_string($_POST['role']);

$select_data=mysql_query("SELECT * FROM users WHERE ( username ='".$username."') AND ( password ='".$password."') AND ( role ='".$role."') AND ( status ='Active')") or die(mysql_error());
$userdata=mysql_fetch_array($select_data);


$count=mysql_num_rows($select_data);

if($role=='admin')
{
		if($count==1)
		{                   
			$_SESSION['username']=$username;
			echo "<script>
			window.location='admin/index.php';
			</script>";

		}
		
		else
		{
			
			echo "<script> 
			alert('Failure: Wrong user name and password');
			window.location='index.php';
			</script>";
		
		}

}elseif($role=='sales')
{

if($count==1)
		{
		   	
			$_SESSION['adminname']=$username;
			echo "<script>
			window.location='sales/index.php';
			</script>";
			
		   }
		   else
		   {
			
			echo "<script> 
			alert('Failure: Wrong user name and password');
			window.location='index.php';
			</script>";
		
		}

		
}
}

?>