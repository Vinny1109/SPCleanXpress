<?php
 $title='Confirmation Order';
   include('header.php');
   
   include('_secure.php');
   include('include/db.php');
    include('include/function.php');?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php  include('nav.php');?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Order Status</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-cutlery"></i> Order Status </div>
        <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
             <div class="form-group col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>SR#</th>
                          <th>Order Number </th>
                          <th>Name</th>
                          <th>Phone number </th>
                          <th>Total Item</th>
                          <th>Price</th>
                          <th>Status</th>
                        </tr>
                      </thead>
          <?php   $Get_Order_dtail=get_order_status_Count(); 
                $count=0;
             if($Get_Order_dtail->num_rows>0)
                {
                  
                 while($row=$Get_Order_dtail->fetch_object())
                    { $count++;
                   
                ?>
             <tr>
                  <th><?php echo $count; ?></th>
                  <td> <?php echo $row->Order_Code?></td>
                  <td><?php echo $row->User_Name; ?></td>
                  <td><?php echo $row->Phone_No; ?></td>
                  <td><?php echo $row->Total_Item; ?></td>  
                  <td><?php echo $row->Total_Price; ?></td>                  
                  <td><?php 
                   if($row->Delivery_status=='Deliver'){ ?>
                       <img src="images/deliver.png" width="100px"> 
                     <?php }else{
                      echo 'Waiting';
                     } ?>


                </td>
                </tr>

             <?php  }
                }?>
                      
                      <tbody>
                      </tbody>
                    </table>

                </div>  
              </div>
              
              
        </div>
       </form> 
        </div>
        
     
    </div>
  
<br>
     <?php include('footer.php');?>
  </div>
</body>

</html>
