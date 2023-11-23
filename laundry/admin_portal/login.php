<?php 
 $title='Login';
 // error_reporting(0);
  include('header.php');
include('include/db.php');
  include('include/function.php');
if(isset($_POST['login'])) 
{

   extract($_POST);
   $query="SELECT * from admin_login where Adm_Name=?";
   $stmt = $db->prepare($query);
   $stmt->bind_param("s",$A_NAME);
   $stmt->execute();
   $info = $stmt->get_result();
   $row=$info->fetch_assoc();
           if($info->num_rows>0) {
            if(password_verify($A_PASSWORD, $row['Adm_Password'])){
              $valid = true;
              session_start();
              $_SESSION['Admin_Portal'] = true;
              $_SESSION['ID'] = $row->ID;
              $_SESSION['Password'] = $row->Adm_Password;
              header("location:index.php");
            }else {
              $valid = false; 
            }
          }else {
            $valid = false; 
          }
  }
?>


<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Admin Login</div>
      <div class="card-body">
        <form action="" method="post"  >
          <?php if(isset($valid) && $valid == false) { ?>
                  
                         <div class="alert alert-warning alert-dismissible text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Invalid!</strong> Username or Password
                        </div>
                    
                    <?php } ?>
          <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input class="form-control" id="exampleInputEmail1" name="A_NAME" type="text" aria-describedby="emailHelp" placeholder="Enter User name" required="">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" required="" name="A_PASSWORD" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <button type="submit" name="login" class="btn btn-primary btn-block">
                  Sign in
                </button>
         
        </form>
        <div class="text-center">
          <br>
		  <p>Repost by <a href="https://stokcoding.com/" title="StokCoding.com" target="_blank">StokCoding.com</a></p>
          
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
