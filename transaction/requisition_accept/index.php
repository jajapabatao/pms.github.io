<?php
session_start();
// print_r($_SESSION); exit();

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



$a= date("d/m/Y");

?>
<!DOCTYPE html>
<html>
<style type="text/css">
    no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(../../assets/img/Preloader_3.gif) center no-repeat #fff;
}
</style>
  <div class="se-pre-con"></div>
<head>
  <meta charset="UTF-8">
  <title>Requisition</title>
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
      

<script>
function showEditBox(editobj,id) {
  $('#frmAdd').hide();
  var currentMessage = $("#message_" + id + " .message-content").html();
  var editMarkUp = '<textarea rows="5" cols="80" id="txtmessage_'+id+'">'+currentMessage+'</textarea><button name="ok" onClick="callCrudAction(\'edit\','+id+')">Save</button><button name="cancel" onClick="cancelEdit(\''+currentMessage+'\','+id+')">Cancel</button>';
  $("#message_" + id + " .message-content").html(editMarkUp);
}
function cancelEdit(message,id) {
  $("#message_" + id + " .message-content").html(message);
  $('#frmAdd').show();
}
function cartAction(action,product_code) {
  var qty, qty2, qty1, qty3;
  qty = $("#qty_"+product_code).val();
  qty2= $("#qty2_"+product_code).val();
  qty1= parseInt(qty);
  qty3= parseInt(qty2);
  var queryString = "";
  if(action != "") {
    switch(action) {
      case "add":
      if(qty1>qty3)
      {
       alert("The quantity should not be  higher than the quantity needed");
      break;
      }  
       if(qty1<=0)
      {
        alert("Quantity cannot be zero or negative values");
      break;
      }
      else
      {
        queryString = 'action='+action+'&code='+ product_code+'&quantity='+$("#qty_"+product_code).val()+'&po_no='+$("#samp").val(); 
      break;
      }
      case "remove":
        queryString = 'action='+action+'&code='+ product_code;
      break;
      case "empty":
        queryString = 'action='+action;
      break;
    }  
  }
  jQuery.ajax({
  url: "materialrequisition3_action.php",
  data:queryString,
  type: "POST",
  success:function(data){
    $("#cart-item").html(data);
    if(action != "") {
      switch(action) {
        /*case "add":
          $("#add_"+product_code).hide();
          "#added_"+product_code).show();
        break;*/
        case "remove":
          $("#add_"+product_code).show();
          $("#added_"+product_code).hide();
        break;
        case "empty":
          $(".btnAddAction").show();
          $(".btnAdded").hide();
        break;
      }  
    }
  },
  error:function (){}
  });
}
</script>

   </head>

   <body class="skin-red fixed">


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
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" >
             
             
               <?php include("../../maintenance/nav.php"); ?>  
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
               

         <?php include("../../maintenance/user_type.php"); ?>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-center">
                  <a href="?logout=true" class="btn btn-primary btn-flat btn-center"><i class="fa fa-sign-in"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li> 
         
            <!-- User Account: style can be found in dropdown.less -->
          </ul>
        </div>
      </nav>
              <?php
if(isset($_GET['logout']))
{
  mysql_query("update sample set status='inactive' where user='".$_SESSION['user']."' and pass='".$_SESSION['pass']."' ");
  session_destroy();
  echo "<meta http-equiv='refresh' content='0'>";
}
?>
          
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include("../../maintenance/side_account.php") ?>


    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Material Requisition
          <small>Transaction</small>
        </h1>                              
      </section>
<?php
if(isset($_POST['scname']) && isset($_POST['quote_no'])  && isset($_POST['prepared']) )
{
$prepared=$_POST['prepared'];
$scname = $_POST['scname'];
$quote_no = $_POST['quote_no'];
}

?>

 <?php
$content4=mysql_query("select customer,project from quotation where quote_no='".$_GET['scname']."'");
$row4=mysql_fetch_array($content4);

$project= $row4['project'];
$cust=$row4['customer'];

    ?>
      <!-- Main content -->
      <section class="content">
        <!--Table function-->


        <!-- Small boxes (Stat box) -->
        <div class="row" >                                 
          <div class="col-md-12 col-sm-8 col-xs-8">             <!-- NEW RECORD -->
                <!-- <a href="addTax.php"><button class="btn btn-success btn-lg" style="margin-bottom:5px;
                  box-shadow: 0px 4px 8px #888888"> 
                + ADD NEW RECORD</button> </a> -->
                <div class="box-header with-border">
                
                  <div class="col-sm-6" style="margin-bottom: 10px;">                        
                   <div class="row" style="margin-bottom:5px;"> <!-- ROW 2-->

                    <div class="col-xs-3" style="text-align: center;"> 
                      <label>Material Req ID</label> <!-- Prod_Name -->
                      <input class="form-control" type="text" name="quote" id="quote" value="<?php echo 'MAT-000'.$_GET['id'].''; ?>" style="text-align: center;" readonly>
                      
                    </div>  

                     <div class="col-xs-3" style="text-align: center;"> 
                      <label>Customer Name</label> <!-- Prod_Name -->
                      <input class="form-control" type="text" name="comp" id="comp" value="<?php echo ''.$cust.''; ?>" style="text-align: center;" readonly>
                      <input class="form-control" type="hidden"name="samp" id="samp" value="<?php echo ''.$_GET['scname'].''; ?>"">
                      
                    </div>   

                    <div class="col-xs-3" style="text-align: center;"> 
                      <label>Project Name</label> <!-- Prod_Name -->
                      <input class="form-control" type="text" name="comp" id="comp" value="<?php echo ''.$project.''; ?>" style="text-align: center;" readonly>
                      
                      
                    </div>   

                                          
                    </div>   


                </div>          

                <div class="col-md-9 col-xs-12"> <!-- MESSAGE -->

                  <div class="alert alert-xs  bg-teal alert-dismissable" style="width:85%; display:none" id="msg">
                    <i class="icon fa fa-check"></i>
                    <label id="msgContent"></label>
                  </div>  

                </div>    
                                                
            </div>








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
           



            <div class="row">                     <!-- TABLES -->
              <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="box box-solid">
                  <div class="box-header">
                    <h3 class="box-title">Available Items</h3>
                    <div class="myData"></div>

                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table id="jsontable" class="table table-condensed table-striped table-hover" style="font-size: 0.9em;">
                      <thead>

                        <tr>
                         

                      <th style="text-align:center"><strong>Brand</strong></th>
                      <th style="text-align:center"><strong>Category</strong></th>
                      <th style="text-align:center"><strong>Subcategory</strong></th>
                      <th style="text-align:center"><strong>Description</strong></th>
                      <th style="text-align:center"><strong>Color</strong></th>
                      <th style="text-align:center"><strong>Package</strong></th>
                      <th style="text-align:center"><strong>Measurement</strong></th>

                      <th style="text-align:center"><strong>Qty remaining</strong>
                      <strong>(Quotation)</strong>
                      </th>
                      <th  style="text-align:center"><strong>Qty Available</strong>
                      <strong>(Inventory)</strong>
                      </th>
                      <th style="text-align:center"><strong>Quantity</strong></th>
                      <th style="text-align:center"><strong>Action</strong></th>
                        </tr>

                      </thead>

                      <?php  


                      $servername = "localhost";
                      $username = "root";
                      $password = "";
                      $dbname = "pms";

// Create connection
                      $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
                      if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                      } ?>
                  
  <?php
   /*$product_array = $db_handle->runQuery("SELECT quotation_cart.quote_no,quotation_cart.material_no, quotation_cart.code,quotation_cart.brand_name,quotation_cart.category,quotation_cart.scategory_name,quotation_cart.description,quotation_cart.color,quotation_cart.package,quotation_cart.unit_measurement,quotation_cart.abbre,quotation_cart.quantity_remaining,quotation_cart.price, materials.quantity as quantity_available 
      FROM quotation_cart 
      INNER JOIN materials 
      ON quotation_cart.material_no=materials.material_no where quotation_cart.quote_no = '".$_GET['scname']."' and quotation_cart.quantity_remaining >'0' ORDER BY quote_no ASC");
*/   $product_array = $db_handle->runQuery("SELECT `quotation`.*, `quotation_cart`.*, materials.quantity as quantity_available FROM `quotation` LEFT JOIN `quotation_cart` ON `quotation`.project = `quotation_cart`.project INNER JOIN materials ON quotation_cart.material_no=materials.material_no WHERE `quotation`.quote_no = '".$_GET['scname']."' AND `quotation_cart`.quantity_remaining >'0' ORDER BY `quotation_cart`.quote_no ASC");
     
  if (!empty($product_array))
   {  
    echo'<tbody>';
    foreach($product_array as $key=>$value)
    {
  ?>    <tr>
        <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>&employee=<?php echo $scname?>&materialreq=<?php echo $quote_no?>">
      <td class="brand_name"><?php echo $value["brand_name"]; ?></td>
      <td class="category"><?php echo $value["category"]; ?></td>
      <td class="scategory_name"><?php echo $value["scategory_name"]; ?></td>
      <td class="description"><?php echo $value["description"]; ?></td>
      <td class="color"><?php echo $value["color"]; ?></td>
      <td class="package"><?php echo $value["package"]; ?></td>
      <td class="unit_measurement" style="text-align: center;"><?php echo $product_array[$key]["unit_measurement"];?> <?php echo $product_array[$key]["abbre"];?></strong></td>
      <td class="quantity_remaining" style="text-align: center;"><?php echo $product_array[$key]["quantity_remaining"];?>
          <input type="number" hidden id="qty2_<?php echo $product_array[$key]["code"]; ?>" class="qty2" name="quantity2" value="<?php echo $product_array[$key]["quantity"]; ?>" size="1"/ ></td>

      </td>
      <td class="quantity_available" style="text-align: center;"><?php echo $product_array[$key]["quantity_available"];?>
         <input type="number" hidden id="qty1_<?php echo $product_array[$key]["code"]; ?>" class="qty1"  name="quantity1" value="<?php echo $product_array[$key]["quantity_available"]; ?>" size="" />

      </td>
      <td style="text-align: center;"><input type="number" id="qty_<?php echo $product_array[$key]["code"]; ?>" class="form-control qty" name="quantity" value="" size="1" style="text-align: center; width: 30%;"/></td>
      <td><input type="button" id="add_<?php echo $product_array[$key]["code"]; ?>" name ="adds" value="Add" class="btn btn-primary btnAddAction cart-action" onClick = "cartAction('add','<?php echo $product_array[$key]["code"]; ?>')" /></td>
      </form>
      </tr>
    </div>
    </tr>
  <?php
      }
  }
  ?> 
     </tbody>
  </table>



                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!-- /.col -->
                </div>  <!-- /.row -->         
                

  
                  </div> <!-- /.row --> 
                </section><!-- right col -->
                 
                  <section class="content-header">
                             

                  </section>
                          <section class="content">


    <div class="row">
    <div class="col-md-12 col-sm-8 col-sm-8">     
<div class="box box-solid">
  <div class="box-body">
    <div id="cart-item"></div>
    <form method="post" action="index.php?id=<?php echo ''.$_GET['id'].''?>&scname=<?php echo ''.$_GET['scname'].''?>&prepared=<?php echo ''.$_GET['prepared'].''?>">
<?php



if(isset($_POST['btnAdd']))
{

if(empty($_SESSION["cart_itemmq"]))
{
 echo '<script type="text/javascript">alert("Cart empty")</script>'; 
}

else
{
  ?>
<div class="container" style="width:100%; margin-left: 0px; margin-top:0px;">
<table class="table-bordered w3-table w3-bordered w3-striped w3-border w3-hoverable" id="tableko" name="tableko" style="font-size: 0.9em;">
<thead>
<tr class="w3-green">
<th><strong>No.</strong></th>
<th><strong>Brand</strong></th>
<th><strong>Category</strong></th>
<th><strong>Sub-Category</strong></th>
<th><strong>Description</strong></th>
<th><strong>Color</strong></th>
<th><strong>Package</strong></th>
<th><strong>Measurement</strong></th>
<th><strong>Abbreviation</strong></th>
<th><strong>Quantity</strong></th>
</tr> 
</thead>
<tbody>
<H1> RECENTLY ADDED </H1>
<br>
<?php   
    foreach ($_SESSION["cart_itemmq"] as $item){
    ?>
       <?php
       $int++;
       $code=$item["code"];
       $brand_name = $item["brand_name"];
       $category = $item["category"];
       $scategory_name = $item["scategory_name"];
       $description = $item["description"];
       $color = $item["color"];
       $package = $item["package"];
       $unit_measurement = $item["unit_measurement"];
       $abbre = $item["abbre"];
       $quantity = $item["quantity"];
       ?>
        <tr>
        <td><strong><?php echo $int; ?></strong></td>
        <td><strong><?php echo $brand_name; ?></strong></td>
        <td><strong><?php echo $category; ?></strong></td>
        <td><strong><?php echo $scategory_name; ?></strong></td>
        <td><strong><?php echo $description; ?></strong></td>
        <td><strong><?php echo $color; ?></strong></td>
        <td><strong><?php echo $package; ?></strong></td>
        <td><strong><?php echo $unit_measurement; ?></strong></td>
        <td><strong><?php echo $abbre; ?></strong></td>
        <td style="width:7%;"><?php echo $quantity; ?></input></td>
        </tr>
        <?php

    }
    ?>

</tbody>
</table> 
<?php

  $order=mysql_real_escape_string($_GET['prepared']);

    $accepted='active';
    foreach($_SESSION["cart_itemmq"] as $item)
    {
     

    $material_no = $item['material_no'];
    $brand_name = $item['brand_name'];
    $category = $item['category'];
    $scategory_name = $item['scategory_name'];
    $description = $item['description'];
    $color = $item['color'];
    $packages = $item['package'];
    $unit_measurement = $item['unit_measurement'];
    $abbre = $item['abbre'];
    $quantity = $item['quantity'];
    $quantitys = $item['quantitys'];
    $quantity_total = $quantitys - $quantity;
    $hash1= $_GET['scname'];
    $hash3= mt_rand(1,9999999);
    $hash2= md5($hash1+$material_no+$hash3);

$content5=mysql_query("select *, max(material_no) as max from materialreq_cart where req_no='".$_GET['id']."' and material_no='".$material_no."'");
    $total5=@mysql_affected_rows();
    $row5=mysql_fetch_array($content5);

    $quantity_total=$quantity+$row5['quantity'];

    if($row5['max']>=1)
{
     mysql_query("UPDATE materialreq_cart SET quantity='".$quantity_total."' where req_no='".$_GET['id']."' and material_no='".$material_no."' ");
    echo '<script type="text/javascript">alert("Materials '.$_GET['po_no'].' has been sssadded")</script>'; 
}
else  
{
 mysql_query("insert into materialreq_cart (req_no, code, customer,project,material_no,brand_name,category,scategory_name,description,color,package,unit_measurement,quantity,abbre,status) values('".$_GET['id']."','".$hash2."','".$cust."','".$project."','".$material_no."','".$brand_name."','".$category."','".$scategory_name."','".$description."','".$color."','".$packages."','".$unit_measurement."','".$quantity."','".$abbre."','".$accepted."') ");

}

   
  
    }
    mysql_query("insert into materialreq (req_no,customer,project,date,requested_by,status) values ('".$_GET['id']."','".$cust."','".$project."','".$a."','".$order."','".$accepted."') ");
     echo '<script type="text/javascript">alert("Materials has been added")</script>'; 


     ?>
     

   <?php
    unset($_SESSION["cart_itemmq"]);
  }
  }  
?>
<div style="text-align: center; float: center;">
<button type="button"  onclick="done()" class="btn btn-default">Go Back</button>
<button type="button"  class="btn btn-danger"> <a id="btnEmpty" class="cart-action" onClick="cartAction('empty','');" style="color: white;">Remove All</a></button>
<button type="submit" name="btnAdd" id="btnAdd" class="btn btn-primary">Process Order</button>
     
    <?php
    $contents6=mysql_query("select max(req_no) as max from materialreq_cart where req_no='".$_GET['id']."'");   
    $rows6=mysql_fetch_array($contents6);

 if($rows6['max']>=1)
{
  echo'<button type="button"  onclick="print()" class="btn btn-success">Print</button>';
}
else{
   echo'<button type="button"  onclick="print()" class="btn btn-success" disabled>Print</button>';
}
?>

<script>
$(document).ready(function () {
  cartAction('','');
})
</script>
<br>
</div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
    $('#jsontable').DataTable({
         "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
});
    </script>
<!--Input-->
    <script>
    function done() {
    window.location.href="../requisition/index.php";
    }
    </script>

    <script>
    function print() {
     window.open("../../pdf/print/printreq.php?id=<?php echo $_GET['scname']?>&customer=<?php echo $_GET['scname']?>&prepared=<?php echo $_GET['prepared']?>");
    }
    </script>
    </div> <!-- /. col -->
  </div> <!--/.box-body-->
</div> <!-- /.box -->
        
    </div> <!-- /. row -->

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


     
  <script type="text/javascript">
    function get_id(o) {
      myRowIndex = $(o).parent().parent().index();
      var getid=  (document.getElementById("jsontable").rows[($(o).parent().parent().index())+1].cells[0].innerHTML);    
      var $modal = $('#editModal'),
      $category_no1 = $modal.find('#category_no1');
      $category_no1.val(getid);
      $category_no1 = $modal.find('#category_no1');
      $category_no1.val(document.getElementById("jsontable").rows[($(o).parent().parent().index())+1].cells[0].innerHTML);


      $c_name1 = $modal.find('#c_name1');
      $c_name1.val(document.getElementById("jsontable").rows[($(o).parent().parent().index())+1].cells[1].innerHTML);

    }
  </script>

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

  </html>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#jsontable').DataTable({
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]

      });
    });

      $(document).ready(function(){
      $('#jsontable1').DataTable({
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]

      });
    });
  </script>
<script>
$(document).ready(function () {
  cartAction('','');
})
</script>
<script>
function pass() {
var oTable = $('#filtertable_data').dataTable( );
// to reload
oTable.api().ajax.reload();
}
</script>
<script>
$(document).ready(function () {
  cartAction('','');
})
</script>
<script type="text/javascript">
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");

    });
</script>