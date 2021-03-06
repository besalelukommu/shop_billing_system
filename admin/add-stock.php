<?php
error_reporting(0);
session_start();

include_once("../config/config.php");

if(isset($_POST["submit"])){
  
  $category = $_POST['category'];
  $supplier = $_POST['supplier'];
  $nos = $_POST['nos'];
  $weight = $_POST['weight'];
  $date = date('d-m-Y');
  $invoice = $_POST['invoice'];
  $type = $_POST['type'];
  $amount = $_POST['amount'];
  
  $insert_stock_query = mysql_query("INSERT INTO stock(category,supplier,no_items,weight,invoice_no,type,amount,date) 
                                    values('".$category."','".$supplier."','".$nos."','".$weight."','".$invoice."','".$type."','".$amount."','".$date."')")or die(mysql_error());
  
  if($insert_stock_query){
    $msg = "Successfully stock added !";
  }else{
    $msg = "Please try again !!";
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Billing System - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
      include_once "include/sidebar.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            

            <!-- Nav Item - User Information -->
            <?php include_once 'include/username.php'; ?>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Stock</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>
         
          <!-- Content Row -->
          <div class="row">
          <div class="col-xl-5 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Stock Details</h6>
                  <span class="red"><?php echo $msg; ?></span>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                  <div class="p-12">
                  <form class="user" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label>Category<span class="require">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                      <?php
                        $all_categories_query = mysql_query("SELECT * FROM categories") or die(mysql_error());

                        if(mysql_num_rows($all_categories_query) > 0){
                          
                            ?>
                            <select name="category" class="form-control" required>
                              <option value="">Select</option>
                              <?php
                              $j = 0;
                              while($row = mysql_fetch_array($all_categories_query)){
                              ?>
                              <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                               <?php
                                $j++;
                              }
                            }
                                ?>
                            </select>
                            
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label>Supplier<span class="require">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                      <?php
                        $all_supplier_query = mysql_query("SELECT * FROM customer WHERE type = 'Supplier'") or die(mysql_error());

                        if(mysql_num_rows($all_supplier_query) > 0){
                          
                            ?>
                            <select name="supplier" class="form-control" required>
                              <option value="">Select</option>
                              <?php
                              $k = 0;
                              while($row = mysql_fetch_array($all_supplier_query)){
                              ?>
                              <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                               <?php
                                $k++;
                              }
                            }
                                ?>
                            </select>
                            
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label class="font-weight-bold text-primary">Stock Details</label>
                    </div>
                    <div class="col-md-4 form-group">
                      <label>Invoice No</label>
                    </div>
                    <div class="col-md-4 form-group">
                      <input type="text" class="form-control" name="invoice">
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-3 form-group">
                      <label for="nos">Stock in Nos<span class="require">*</span></label>
                    </div>
                    <div class="col-md-3 form-group">
                      <input type="text" class="form-control" name="nos" required>
                    </div>
                    <div class="col-md-2 form-group">
                      <label for="weight">Weight</label>
                    </div>
                    <div class="col-md-4 form-group">
                      <input type="text" class="form-control" name="weight" placeholder="K.G's">
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-3 form-group">
                      <label for="nos">Type<span class="require">*</span></label>
                    </div>
                    <div class="col-md-3 form-group">
                      <select name="type" class="form-control">
                        <option value="">Select</option>
                        <option value="cash">Cash</option>
                        <option value="credit">Credit</option>
                      </select>
                    </div>
                    <div class="col-md-2 form-group">
                      <label for="weight">Amount<span class="require">*</span></label>
                    </div>
                    <div class="col-md-4 form-group">
                      <input type="text" class="form-control" name="amount" placeholder="Rs" required>
                    </div>
                  </div>
                  <div class="col-md-12 form-group center">
                   <input type="submit" class="btn btn-primary" value="Add Stock" name="submit" />
                    
                  </div> 
                    
                  </form>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-7 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Stock Details</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie">
                    <div class="row">
                    
                      <div class="col-md-3" style="color:#ef1c08;font-weight:bold;">CATEGORY</div>
                      <div class="col-md-3" style="color:#ef1c08;font-weight:bold;">SUPPLIER</div>
                      <div class="col-md-2" style="color:#ef1c08;font-weight:bold;">NOs</div>
                      <div class="col-md-2" style="color:#ef1c08;font-weight:bold;">WEIGHT</div>
                      <div class="col-md-2" style="color:#ef1c08;font-weight:bold;">DATE</div>
                    </div>
                    <?php
                      $all_stock_query = mysql_query("SELECT * FROM stock") or die(mysqli_error());

                      if (mysql_num_rows($all_stock_query) > 0) {
                        $i=0;
                        while($row = mysql_fetch_array($all_stock_query)) {
                          ?>
                          <div class="row">
                            
                            <div class="col-md-3"><?php echo $row['category']; ?></div>
                            <div class="col-md-3"><?php echo $row['supplier']; ?></div>
                            <div class="col-md-2"><?php echo $row['no_items']; ?></div>
                            <div class="col-md-2"><?php echo $row['weight']; ?></div>
                            <div class="col-md-2"><?php echo $row['date']; ?></div>
                          </div>
                          <?php
                          $i++;
                        }
                      }
                      else{
                          echo "Stock details not found!!";
                      }
                    ?>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <!-- <i class="fas fa-circle text-primary"></i> Direct -->
                    </span>
                    <span class="mr-2">
                      <!-- <i class="fas fa-circle text-success"></i> Social -->
                    </span>
                    <span class="mr-2">
                      <!-- <i class="fas fa-circle text-info"></i> Referral -->
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
           </div>

          <!-- Content Row --

          <div class="row">

          
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include_once 'include/logout.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
