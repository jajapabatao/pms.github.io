<?php include("var.php"); ?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Delivery</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <?php include("../../maintenance/plugins.php"); ?>
  <div class="se-pre-con"></div>


   </head>

   <body class='skin-red'>
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
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include("../../maintenance/side_account.php") ?>


    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Inventory
          <small>Report</small>
        </h1>                              
      </section>

      <?php
      $content1=mysql_query("SELECT max(delivery_no) as max from delivery");
      $total1=@mysql_affected_rows();


      $row=mysql_fetch_array($content1);
      $noo=$row['max'];

      $hell=$noo+1;



      $a= date("d/m/Y");


      ?>
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
                          <h3 class="box-title">Browse Inventory</h3>
                          <div class="myData"></div>

                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <table id="jsontable" class="table table-condensed table-striped table-hover">
                            <thead>
                              <tr>


                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Brand</th>
                                <th>Description</th>
                                <th>Color</th>
                                <th>Package</th>
                                <th>Unit Measurement</th>
                                <th>Abbreviation</th>
                                <th>Quantity</th>


                              </tr>

                            </thead>
                            <form action="" method="post">
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
                              <script type="text/javascript">


                              </script>
                              <form action="" method="post">
                                <?php
                                $sql = " select * from materials where quantity>=0 and status='active' group by material_no";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc())
                                { 
                                 $brand_name=$row['brand_name'];
                                 $category=$row['category'];
                                 $scategory_name=$row['scategory_name'];
                                 $description =$row['description'];
                                 $color=$row['color'];
                                 $package=$row['package'];
                                 $unit_measurement= $row['unit_measurement'];
                                 $quantity=$row['quantity'];
                                 $abbre=$row['abbre'];

                                 echo'<tr>';
                                 echo'<td>'.$category.'</td>';
                                 echo'<td>'.$scategory_name.'</td>';
                                 echo'<td>'.$brand_name.'</td>';
                                 echo'<td>'.$description.'</td>';
                                 echo'<td>'.$color.'</td>';
                                 echo'<td>'.$package.'</td>';
                                 echo'<td>'.$unit_measurement.'</td>';
                                 echo'<td>'.$abbre.'</td>';
                                 echo'<td>'.$quantity.'</td>';
                               }

                               echo'</tr>';
                               echo' 

                               </tbody>
                               </table>
                               <br></br>';
                               $conn->close();

                               $contents6=mysql_query("select sum(material_no) as max from materials where status='active' or status='Active'");   
                               $rows6=mysql_fetch_array($contents6);

                               if($rows6['max']>=1)
                               {
                                echo'<center><button type="button"  onclick="print()" class="btn btn-primary">Print</button></center>';
                              }
                              else{
                               echo'<center><button type="button"  onclick="print()" class="btn btn-primary" disabled>Print</button></center>';
                             }

                             ?> 
                           </form>


                           <script>
                            function print(a) {
                              window.open("../../pdf/print/printinventory.php");
                            }
                          </script>







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

    <div id="editModal" class="fade modal" >
      <form name="formCust" method="post" action=""> <!-- FORM element -->
        <div class="modal-dialog">
          <div class="modal-content" >
            <div class="modal-header">
              <button type="butt on" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"> <i class="ion-android-person"></i> Edit Category Form </h4>
            </div>          
            <div class="modal-body" >


              <?php include('update.php');
              ?>

            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" name="btnSave" class="btn bg-blue btn-lg btn-block" data-dismiss="modal fade"><i class="fa fa-send"></i> SAVE</button>                                
          </div>

        </div>
      </div>
    </form>
  </div> 


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


  </html>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#jsontable').DataTable({
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]

      });
    });
  </script>
  <script>
    function myFunctions() {

      if (confirm("Are you sure?") == true) {

      } 
      else {
        return false;
        //window.location.href="purchaseorder1.php";
      }
    }


  </script>