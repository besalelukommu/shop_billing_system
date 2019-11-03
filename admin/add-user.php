<?php
error_reporting(0);
session_start();

include_once("../config/config.php");

if(isset($_POST["submit"])){
  
  $name = $_POST['fullname'];
  $branch_id = $_POST['branch'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $rand = rand(100, 1000);

  $firstname = strtok($name, ' ');
  $usr = trim($firstname);
  $user_id = $usr.$rand;
  
  $insert_users_query = mysql_query("INSERT INTO users (branch_id,fullname,username,password,email,mobile,role,status)
                                    values('".$branch_id."','".$name."','".$user_id."','pass1234','".$email."','".$mobile."','".$role."','Active')") or die(mysqli_error());

  if($insert_users_query){
    $msg = "Successfully user added !";
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
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>
         
          <!-- Content Row -->
          <div class="row">
          <div class="col-xl-6 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Adding User Details</h6>
                  <span class="red"><?php echo $msg; ?></span>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                  <div class="p-12">
                  <form class="user" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label for="fullname">Full Name<span class="require">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                      <input type="text" class="form-control" name="fullname" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label for="mobile">Mobile No<span class="require">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                      <input type="number" class="form-control" name="mobile" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label for="email">Email Id</label>
                    </div>
                    <div class="col-md-8 form-group">
                      <input type="email" class="form-control" name="email" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label for="branch">Branch<span class="require">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="branch" class="form-control" required>
                            <option value="">Select</option>
                          <?php
                          $branch_query = mysql_query("SELECT * FROM branch WHERE status = 'Active' ORDER BY branch_name")or die (mysql_error());
                            if(mysql_num_rows($branch_query) > 0){
                              $j = 0;
                              while($row = mysql_fetch_array($branch_query)){
                                ?>
                                
                                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></option>
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
                      <label for="email">Role<span class="require">*</span></label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="role" class="form-control" required>
                            <option value="">Select</option>
                            <option value="admin">Admin</option>
                            <option value="sales">Sales</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-12 form-group center">
                   <input type="submit" class="btn btn-primary" value="Add User" name="submit" />
                    
                  </div> 
                    
                  </form>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                  <span id="autosavenotify" class="red"></span>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie">
                    <div class="row">
                    
                      <div class="col-md-4" style="color:#ef1c08;font-weight:bold;">FULLNAME</div>
                      <div class="col-md-3" style="color:#ef1c08;font-weight:bold;">BRANCH</div>
                      <div class="col-md-2" style="color:#ef1c08;font-weight:bold;">ROLE</div>
                      <div class="col-md-3" style="color:#ef1c08;font-weight:bold;">STATUS</div>
                    </div>
                    <?php
                      $all_users_query = mysql_query("SELECT * FROM users") or die(mysql_error());

                      if (mysql_num_rows($all_users_query) > 0) {
                        $i=0;
                        while($row = mysql_fetch_array($all_users_query)) {
                          ?>
                          <div class="row">
                            <div class="myid col-md-1"><?php echo $row['user_id']; ?></div>
                            <div class="col-md-3"><?php echo $row['fullname']; ?></div>
                            <?php
                            $br_id = $row['branch_id'];
                            $branch_id = mysql_query("SELECT branch_name FROM branch WHERE branch_id = '$br_id'")or die(mysql_error());
                            if(mysql_num_rows($branch_id) > 0){
                              $jj = 0;
                              while($row1 = mysql_fetch_array($branch_id)){
                                ?>
                                  <div class="col-md-3"><?php echo $row1['branch_name']; ?></div>
                                <?php
                                $jj++;
                              }
                            }
                              
                            ?>
                            
                            <div class="col-md-2"><?php echo $row['role']; ?></div>
                            <div class="col-md-3">
                                <select name="status"  class="status form-control">
                                  <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                                  <?php
                                    if ($row['status'] == 'Active'){
                                      ?>
                                      <option value="Inactive">Inactive</option>
                                      <?php
                                    }else{
                                  ?>
                                  <option value="Active">Active</option>
                                    <?php } ?>
                                </select>
                            </div>
                          </div>
                          <?php
                          $i++;
                        }
                      }
                      else{
                          echo "No users added !!";
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins --
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts --
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>-->
  <script>
  $(document).ready(function(){
    $('select.status').on('change', function () {
      var decision = $(this).val();
      var id = $('div.myid').html();
      alert('Status changed to '+decision);
      $.ajax({
        type: "POST",
        url: "user-status.php",
        data: {decision:decision, id:id},
        success: function(msg){
          $('#autosavenotify').text(msg);

        }
      })
    });
  });
  </script>

</body>

</html>
