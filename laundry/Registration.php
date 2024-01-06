<?php include('include/Connection.php');

if(isset($_POST['submit'])){
    $usrname = htmlspecialchars(trim($_POST['usrname']));
    $password = htmlspecialchars($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $address = htmlspecialchars(trim($_POST['address']));
    $Contact_No = htmlspecialchars(trim($_POST['Contact_No']));

    // Validasi Username
    if (strlen($usrname) < 8) {
        $valid = 'InvalidUsername';
    }

    // Validasi Password
    elseif (!preg_match('/\d/', $password) || !preg_match('/[a-zA-Z]/', $password)) {
        $valid = 'InvalidPassword';
    }

    // Validasi Phone Number
    elseif (strlen($Contact_No) !== 12 || !is_numeric($Contact_No)) {
        $valid = 'InvalidPhoneNumber';
    }else{

      $query="SELECT * from user_registration where  User_Name=? and Contact_No=?";
      $stmt = $db->prepare($query);
      $stmt->bind_param("si",$usrname,$Contact_No);
      $stmt->execute();
      $info = $stmt->get_result();
      $row=$info->fetch_object();
          if($info->num_rows>0) 
          { 
            $valid = 'Already'; 
          }else{
            $query = "INSERT INTO user_registration(User_Name,password,Address,Contact_No) VALUES(?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param("sssi",$usrname,$hashedPassword,$address,$Contact_No);
            $success = $stmt->execute();

            $query1 = "insert into user_login(User_Name,password) VALUES(?,?)";
            $stmt = $db->prepare($query1);
            $stmt->bind_param("ss",$usrname,$hashedPassword);
            $stmt->execute();
             if($success){
              $valid = 'true';
             }else{
              $valid = 'false';
             }
    }
    // extract($_POST);
  }
    
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>CleanXpress ! Registration</title>
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
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <h4><span class="glyphicon glyphicon-user"></span> Registration</h4>
        </div>
        <?php if(isset($valid) && $valid == 'false') { ?>
        <div class="alert alert-danger">
          Invalid Username or Password
                </div>
                <?php };
                if(isset($valid) && $valid == 'true') { ?>
        <div class="alert alert-danger">
         Registration Sucessfully
                </div>
                <?php };
                if(isset($valid) && $valid == 'Already') { ?>
        <div class="alert alert-danger">
         This User Already Register
                </div>
                <?php } ?>       
        <div class="modal-body" style="padding:40px 50px;">
          <form  role="form" method="post" action=""> 
            <div class="form-group">
             <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control"
               id="usrname" required="" name="usrname" placeholder="Enter User Name">
            </div>

            <div class="form-group">
             <label for="psw"><span class="glyphicon glyphicon-user"></span> Password</label>
              <input type="password" class="form-control" name="password" required="" placeholder="Enter Password">
            </div>

             <div class="form-group">
             <label for="psw"><span class="glyphicon glyphicon-phone"></span>Phone no</label>
              <input type="Number" class="form-control" name="Contact_No" required="" placeholder="Enter Phone No">
            </div>

             <div class="form-group">
             <label for="psw"><span class="glyphicon glyphicon-home"></span> Address</label>
              <input type="text" class="form-control" name="address" required="" placeholder="Enter Address">
            </div>

            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
            <input type="submit" name="submit" class="form-control btn btn-success btn-block"  placeholder="Submit">
          </form>
        </div>
        <div class="modal-footer">
          <p><a href="index.php">Main website</a></p>
          <p>Already Register <a href="Login.php ">Login</a></p>
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
