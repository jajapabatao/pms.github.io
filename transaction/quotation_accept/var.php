<?php
ini_set('display-error',1);
error_reporting(E_ALL&~E_NOTICE);

if($connect=@mysql_connect("localhost","root"))
  echo"";
  else
die(@mysql_error());
$connect=@mysql_select_db("pms");
session_start();

if($_SESSION['user']=='' && $_SESSION['pass']=='')
{
 echo '<script type="text/javascript">window.location.href="../../index.php";</script>'; 
}

if($_GET['id']=='' && $_GET['customer']=='' && $_GET['scname']=='' && $_GET['prepared']=='')
{
  echo'<script type="text/javascript">
  alert("Authentication Error");
  window.location.href="../quotation/index.php";

  </script>';
     //   return;
  //header('Location: quot1.php');
}

$content2=mysql_query("select * from employee where username='".$_SESSION['user']."' and password='".$_SESSION['pass']."' ");
$total2=@mysql_affected_rows();

    
$row=mysql_fetch_array($content2);

$user2=$row['username'];
$pass2=$row['password'];
$cust_type2=$row['cust_type'];
$comp_name2=$row['comp_name'];
$phone_num2=$row['phone_num'];
$fax2=$row['fax'];
$email2=$row['email'];
$firstname2=$row['firstname'];
$middlename2=$row['middlename'];
$lastname2=$row['lastname'];
$contact2=$row['contact'];
$city2=$row['city'];
$street2=$row['street'];
$position=$row['position'];

require_once("dbcontroller.php");
$db_handle = new DBController();

$a= date("Y-m-d");

?>