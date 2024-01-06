<?php

 $title='Dashboard';
   include('header.php');
   include('_secure.php');
   include('include/db.php');
    include('include/function.php');
     if(isset($_POST['Change']))
{
  
    $USER_ID=$_SESSION['User_id'];
   $Password=$_POST['Password'];
  
    $sel="UPDATE User_Login SET Password='".$Password."' where ID='".$USER_ID."'";
    $stmt = $db->prepare($sel);
    $stmt->bind_param(':password', $Password);
    $stmt->bind_param(':user_id', $USER_ID); 
    $info=$stmt->execute();

     
   if($info){
   include('SMS/Change_password.php');
   }
};?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php  include('nav.php');?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Change Phone Number</li>
      </ol>
      <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Change phone number</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Change  your phone number?</h4>
          
        </div>
        <form action="" method="POST">
          <div class="form-group">
            <input class="form-control"  type="text" name="Password"  placeholder="Enter New Password">
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="Change Password" name="Change">
         
        </form>
        
      </div>
    </div>
  </div>
      
    </div>
     <?php include('footer.php');?>
  </div>
</body>

</html>
