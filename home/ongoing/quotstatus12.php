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
  echo '<script type="text/javascript">window.location.href="login.php";</script>'; 
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


$a= date("Y-m-d");

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
  <!-- ionics -->   
  <link href="../../plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />  
  <!-- FontAwesome 4.3.0 -->
  <link href="../../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />  
  <!-- Theme style -->
  <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    folder instead of downloading all of them to reduce the load. -->
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- SweetAlert -->    
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />       
    <!-- Date Picker -->
    <link href="../../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="w3.css">
    

  </head>

  <body class='skin-red fixed'>
    <?php



    $prepare= $_POST['prepared'];
    ?>

    <form action="" method="post" name="frm" id="frm">
      <header class="main-header">
        <!-- Logo --> 
        <a href="index.php" class="logo">

         <span class="logo-lg"><img style="HEIGHT:45px;" src="../../assets/img/logo.png" alt="Logo" style="float: left;"><label style="font-family: 'Cinzel'; font-size: 110%">PERSAN INC.</label></span>

         <!-- logo for regular state and mobile devices -->
         <span class="logo-lg"><img style="HEIGHT:45px;" src="../../assets/img/logo.png" alt="Logo" style="float: left;"><label style="font-family: 'Cinzel'; font-size: 110%">PERSAN INC.</label></span>
       </a>
       <!-- Logo -->
       <!-- Header Navbar: style can be found in header.less -->
       <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>      
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a class="label-primary" >
                <!-- The user image in the navbar-->

                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <?php
                if(isset($_SESSION['pos']) && ($_SESSION['pos']=='admin' || $_SESSION['pos']=='Admin') )
                {
                  ?>
                  <span class="hidden-xs" style="font-weight: bolder;"><?php echo ''.ucfirst($lastname2).', '.ucfirst($firstname2).' '.strtoupper($middlename2[0]).'.'; ?></span>
                </a>
                <?php
              } 
              if(isset($_SESSION['pos']) && $_SESSION['pos']=='Quantity Surveyor')
              {

                mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
                session_destroy();
                echo '<script type="text/javascript">window.location.href="login.php";</script>'; 

              }

              if(isset($_SESSION['pos']) && $_SESSION['pos']=='Secretary')
              {

                mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
                session_destroy();
                echo '<script type="text/javascript">window.location.href="login.php";</script>'; 
              }
              if(isset($_SESSION['pos']) && $_SESSION['pos']=='Foreman')
              {

                mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
                session_destroy();
                echo '<script type="text/javascript">window.location.href="login.php";</script>'; 

              }
              if(isset($_SESSION['pos']) && $_SESSION['pos']=='Stockman')
              {

                mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
                session_destroy();
                echo '<script type="text/javascript">window.location.href="login.php";</script>'; 
              }
              if(isset($_SESSION['pos']) && $_SESSION['pos']=='Accountant')
              {
                mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
                session_destroy();
                echo '<script type="text/javascript">window.location.href="login.php";</script>'; 
              }
              ?>
              <!--navbar-->

              <?php
              if(isset($_GET['logout']))
              {
                mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
                session_destroy();
                echo "<meta http-equiv='refresh' content='0'>";
              }
              ?>  
            </li>
            <li class="dropdown user user-menu" style="width: 80px; text-align: center;" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-lg"></i>
              </a>

              <ul class="dropdown-menu" style="width:10%;border-radius:5px">
                <li style="text-align:center"> 
                  <small style="font-size:0.8em"><?php echo ucfirst($usertype); ?></small>
                </li>


                <li><a href="#"><i class="fa fa-gear"></i> Account Setting</a></li>

                <li><a href="?logout=true"> <i class="fa fa-sign-in"></i><span>Log-out</span></a>
                </li>
                <br>
              </ul>
            </li>     
            <!-- User Account: style can be found in dropdown.less -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include("aside.php") ?>


    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Ongoing
          <small>Projects</small>
        </h1>                              
      </section>

      
      <!-- Main content -->
      <section class="content">
        <!--Table function-->


        <!-- Small boxes (Stat box) -->
        <div class="row" >                                 
          <div class="col-lg-12 col-lg-12 col-lg-12">             <!-- NEW RECORD -->
                <!-- <a href="addTax.php"><button class="btn btn-success btn-lg" style="margin-bottom:5px;
                  box-shadow: 0px 4px 8px #888888"> 
                  + ADD NEW RECORD</button> </a> -->
                  <div class="box-header with-border">
                    <div id="loading" class="modal fade">
                      <div class="modal-dialog">
                        <div class="overlay">
                          <div class="modal-body" style="text-align:center">
                            <div class="overlay">
                              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                              <i class="fa fa-spinner fa-pulse fa-spin"  
                              style="font-size:60px;"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php include("crud.php") ?>



                    <div class="row">                     <!-- TABLES -->
                      <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="box box-solid">
                          <div class="box-header">
                            <h3 class="box-title">Browse Projects</h3>
                            <div class="myData"></div>

                          </div><!-- /.box-header -->
                          <div class="box-body">

                            <?php
                            date_default_timezone_set('Asia/Manila');
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "projectmonitoring";

// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
                            if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                            } 

                            $contents=mysql_query("select * from quotation where quote_no='".$_GET['id']."'");
                            $totals=@mysql_affected_rows();
                            $rows=mysql_fetch_array($contents);

                            echo'
                            <div class="container" style="width:98%; margin-left: 10px;">
                              <br> <br>
                              <label >Project: '.$_GET['project'].'</label>
                              <br>
                              <label >Start Date: '.$rows['date'].'</label>
                              <br> 
                              <label >Due Date: '.$rows['due_date'].'</label>
                              <br><br>';


                              function getNumberOFDays($from,$to){
                                $from_date = new DateTime($from);
                                $to_date = new DateTime($to);
                                return $from_date->diff($to_date)->days;

                              }
                              function getNumberOFDays1($from,$to){
                                $from_date = new DateTime($from);
                                $to_date = new DateTime($to);
                                return $from_date->diff($to_date)->days;

                              }

                              $ngayon1 = getNumberOFDays($a,$rows['date']);

                              $totaldate=getNumberOFDays1($rows['date'], $rows['due_date']);

                              $d1 = strtotime($rows['date']);
                              $d2 = strtotime($rows['due_date']);

                              if(isset($_POST['re_date']))
                              {
                                $due_dates = $_POST['dates'];
                                $dd=date_create($due_dates);
                                $datepic=date_format($dd,"Y-m-d");
                                mysql_query("UPDATE quotation SET due_date='".$datepic."' WHERE quote_no='".$_GET['id']."'");
                                echo "<script type='text/javascript'>alert('Update Successful!')</script>";
                                echo "<meta http-equiv='refresh' content='0'>";

                              }


                              ?>
                              <input type="hidden" value="<?= $ngayon1 ?>" id="ngayon" name="ngayon"/>
                              <input type="hidden" value="<?= $totaldate ?>" id="totaldate" name="totaldate"/>
                              <input type="hidden" value="<?php echo $d1 ?>" id="d1" name="d1"/>
                              <input type="hidden" value="<?php echo $d2 ?>" id="d2" name="d2"/>

                              <?php
// if($_POST['ngayon']==$_POST['totaldate'])
// {
//   echo'<input type="date" value="" id="date" name="date" readonly/>';
// }
// else
// {
//   echo'<input type="date" value="" id="date" name="date"/>';
// }
                              ?>
                              <!--Progressbar-->

                             <div class="w3-container">
  <h2>Project (base on date):</h2>

  <div class="w3-progress-container">
    <div id="myBar1" class="w3-progressbar w3-round-xlarge w3-green" style="width:0%">
      <div id="demo1" class="w3-center w3-text-white"></div>
    </div>
  </div>
  <br>
 <div style="text-align: center; float: center">
  <input type="date" name="dates" id="dates" style="text-align: center" value="<?php echo $a?>">
  <button class="btn btn-default" type="submit" name="re_date" id="re_date">Extend Date
  </div>
  <br>
</div>

                                <script>
                                 $(document).ready(function() {
                                  var elem = document.getElementById("myBar1"); 
                                  var width = 0;
                                  var nga= (parseFloat(parseFloat($("#ngayon").val(),10)));
                                  var tot= (parseFloat(parseFloat($("#totaldate").val(),10)));
                                  var d1=$("#d1").val();
                                  var d2=$("#d2").val();
                                  var id = setInterval(frame, 10);
                                  var total = (parseFloat(parseFloat($("#ngayon").val(), 10) / (parseFloat($("#totaldate").val(), 10)+nga))) * 100;
                                  function frame() {
                                    if (width >= total) {
                                      clearInterval(id);
                                    } 
                                    else {
                                      width++; 
                                      elem.style.width = width + '%'; 
      //document.getElementById("demo1").innerHTML = width * 1  + '%';
      if(width=='100')
      {
        document.getElementById("demo1").innerHTML = "DONE";
        elem.style.width= 100 +'%';
        $("#re_date").show();
        $("#dates").show();
      }
      else if(total<=.90)
      {
        document.getElementById("demo1").innerHTML = "DONE";
        elem.style.width= 100 +'%';
        $("#re_date").show();
        $("#dates").show();
      }
      else if(d1>d2)
      {
        document.getElementById("demo1").innerHTML = "DONE";
        elem.style.width= 100 +'%';
        $("#re_date").show();
        $("#dates").show();
      }
      else
      {
        document.getElementById("demo1").innerHTML = width * 1  + '%';
        $("#re_date").hide();
        $("#dates").hide();

      }
    }
  }
});
</script>


<div class="w3-container">
  <h1  style="text-align: center; float: center">Project's Progress</h1>
  <br>
  <h2  style="text-align: center; float: center">Project:</h2>

  <div class="w3-progress-container">
    <div id="myBar" class="w3-progressbar w3-round-xlarge w3-green" style="width:0%">
      <div id="demo" class="w3-center w3-text-white"></div>
    </div>
  </div>
  <br>
  <br>
</div>

<script>
 $(document).ready(function() {
  var elem = document.getElementById("myBar"); 
  var width = 0;
  var id = setInterval(frame, 10);
  var total = parseFloat(parseFloat($("#qua1").val(), 10) * 100)/ parseFloat($("#qua").val(), 10);
  function frame() {
    if (width >= total) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      if(width>='100')
      {
        document.getElementById("demo").innerHTML = "DONE";
        elem.style.width= 100 +'%';
      }
      else
      {
        document.getElementById("demo").innerHTML = width * 1  + '%';
      }

    }
  }
});
</script>
<?php

echo '<table class="table table-condensed table-striped table-hover" id="tableko" name="tableko" >
<thead>
  <tr class="w3-camo-dark-green">
    <th>No.</th>
    <th>Brand</th>
    <th>Category</th>
    <th>Sub-category</th>
    <th>Description</th>
    <th>Color</th>
    <th>Package</th>
    <th>Measurement</th>
    <th style="text-align:center">Qty
      (Ordered)</th>
      <th style="text-align:center">Qty remaining</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    ';
    $a=0;
    $sql = "SELECT *  FROM quotation_cart where quote_no='".$_GET['id']."' and status='active' group by material_no";
      //$sql = "SELECT * FROM quotation_cart where project='".$_GET['project']."' and status='active'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    { 
      echo'<tr>';

      $a++;
      echo'<td>'.$a.'</td>';
      echo'<td>'.ucfirst($row['brand_name']).'</td>';
      echo'<td>'.ucfirst($row['category']).'</td>';
      echo'<td>'.ucfirst($row['scategory_name']).'</td>';
      echo'<td>'.ucfirst($row['description']).'</td>';
      echo'<td>'.ucfirst($row['color']).'</td>';
      echo'<td>'.ucfirst($row['package']).'</td>';
      echo'<td>'.ucfirst($row['unit_measurement']).''.$row['abbre'].'</td>';
      echo'<td>'.ucfirst($row['quantity']).'</td>';
      echo'<td>'.ucfirst($row['quantity_remaining']).'</td>';
      echo'<td>&#8369;'.ucfirst($row['price']).'</td>';

    }
    echo'</tr>';
    echo' 
  </tbody>
</table>
<br></br>';
$conn->close();
?> 

<script type="text/javascript">
  $(document).ready(function(){
    $('#tableko').DataTable();
  });
</script>
</div>
<!--DataTable-->
<?php

$content5=mysql_query("select *, sum(quantity) as max, sum(quantity_remaining) as total from quotation_cart where quote_no='".$_GET['id']."'");
$total5=@mysql_affected_rows();
$row5=mysql_fetch_array($content5);
echo'<input type="hidden" value="'.$row5['max'].'" id="qua" name="qua"/>';
echo'<input type="hidden" value="'.$row5['total'].'" id="qua1" name="qua1"/>';
?>

Total Amount: <?php echo'&#8369;'.number_format((double)$rows['total_amount'],2,'.','').''; ?>
<br>
Balance: <?php echo'&#8369;'.number_format((double)$rows['balance'],2,'.','').''; ?>
<br></br>



</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->
</div>  <!-- /.row -->         



</div> <!-- /.row --> 
</section><!-- right col -->
</div><!-- /.row (main row) -->
</section><!-- /.content -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 3.0
  </div>
  <strong>Copyright &copy; 2016<?php if(date("Y")!=2015)echo" - ".date("Y")."";?></strong> All rights reserved.
</footer>        
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<div id="myModal" class="fade modal" >
  <form name="formCust" method="post" action=""> <!-- FORM element -->
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="butt on" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"> <i class="ion-android-person"></i> Position Form </h4>
        </div>          
        <div class="modal-body" >
          <!-- ------------------------------------------------------------------------------------------- -->




          <!-- ------------------------------------------------------------------------------------------- -->

          <div class="row" style="margin-bottom:5px"> <!-- ROW 2-->

            <div class="col-xs-6" id="addErDv"> 
              <label><font color="darkred">*</font>Category</label> <!-- Prod_Name -->
              <input type="text" class="form-control" name="txtname" id="textbox_A">
            </div>           



          </div> <!-- /.row -->   
          <!-- ------------------------------------------------------------------------------------------- <-->                               
          <!-- ------------------------------------------------------------------------------------------- -->


          <!-- ------------------------------------------------------------------------------------------- -->


        </form>

      </div>
      <div class="modal-footer">
        <button type="submit" id="btnAdd" name="btnAdd" class="btn bg-blue btn-lg btn-block" data-dismiss="modal fade" onclick="return confirm('Are you sure?');"><i class="fa fa-send"></i> SAVE</button>  

      </div>

    </div>
  </div>
</form>
</div> 




<!-- EDIT MODAL -->



<!-- jQuery 2.1.3 -->
<script src="../../plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>
<!-- <script src="jquery.js" ype="text/javascript"></script> -->

<!-- jQuery UI 1.11.2 -->
<script src="../../plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.2 JS -->
<script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    

<script src="../../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->

<!-- mask -->
<script src="../../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="../../plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

<!-- FastClick -->

<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js" type="text/javascript"></script>
<!-- DataTables -->
<link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>


 <link rel="stylesheet" href="../../DataTables/responsive/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="../..//DataTables/css/jquery.dataTables.min.css">
  <script src="../..//DataTables/js/jquery.dataTables.min.js"></script>
  <script src="../..//DataTables/responsive/js/dataTables.responsive.min.js"></script>
<script>
 function setTime() {
  var d = new Date(),
  el = document.getElementById("time");

  el.innerHTML = formatAMPM(d);

  setTimeout(setTime, 1000);
}

function formatAMPM(date) {
  var weekday = new Array(7);
  weekday[0]=  "Sunday";
  weekday[1] = "Monday";
  weekday[2] = "Tuesday";
  weekday[3] = "Wednesday";
  weekday[4] = "Thursday";
  weekday[5] = "Friday";
  weekday[6] = "Saturday";
  var hours = date.getHours(),
  minutes = date.getMinutes(),
  seconds = date.getSeconds(),
  months = date.getMonth(),
  days = date.getDate(),
  year = date.getFullYear(),
  n = weekday[date.getDay()];
  ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? '0'+minutes : minutes;
      months=months+1;

      var strTime = n + ' ' + months + '/' + days + '/' + year + '\n' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
      return strTime;
    }

    setTime();
  </script>



  </html>
