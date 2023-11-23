<?php 
include('include/Connection.php');
if(isset($_POST['login'])) 
{
   extract($_POST);
   $query="SELECT * from user_login where User_Name=?";
   $stmt = $db->prepare($query);
   $stmt->bind_param("s",$username);
   $stmt->execute();
   $info = $stmt->get_result();
   $row=$info->fetch_assoc();
          if($info->num_rows>0) {
            if(password_verify($psw, $row['Password'])){
              $valid = true;
              session_start();
              $_SESSION['USER_Portal'] = true;
              $_SESSION['User_id'] = $row->ID;
              $_SESSION['User_NAME'] = $row->User_Name;
              $_SESSION['Password'] = $row->Password;
              header("location:User/index.php");
            }
            else {
              $valid = false;
            }
          } else {
            $valid = false; 
          }
        }
?>

<!DOCTYPE html>
<html>
<head>
  <title>CleanXpress ! Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
</head>
<body>

<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <?php if(isset($valid) && $valid == false) { ?>
        <div class="alert alert-danger">
          Invalid Username or Password
                </div>
                <?php } ?>
          <form  role="form" method="post" action=""> 
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" name="username" required="" placeholder="Enter Username">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" name="psw"  required="" placeholder="Enter Password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" name="login" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <p>Not a member? <a href="Registration.php">New Registration</a></p>
        </div>
      </div>
      
    </div>
  </div> 
</div>
 


<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });

    $('#myModal').modal({
    backdrop: 'static',   // This disable for click outside event
    keyboard: true        // This for keyboard event
})
</script>
</body>
</html>
