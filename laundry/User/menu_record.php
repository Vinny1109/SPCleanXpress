<?php
 $title='Dashboard';
   include('header.php');
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
        <li class="breadcrumb-item active">All Menu Record</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> All Menu Record</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>SR#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>Delete</th>
                  <th>Update</th>
                </tr>
              </thead>
              
              <tbody>
                <?php $Show=Menu_record();
                $count='0';
                 while ($row=$Show->fetch_object()) {
                   $count++;
                ?>
                <tr>
                  <th><?php echo $count; ?></th>
                  <td><img src="Images/<?php echo $row->Pix_upload; ?>" width='40px'></td>
                  <td><?php echo $row->Menu; ?></td>
                  <td><?php echo $row->menu_type; ?></td>
                  <td><?php echo $row->Price; ?></td>
                 
                  <td><a href="" class=" btn btn-primary">Delete</a></td>
                  <td><a href="" class=" btn btn-primary">Update</a></td>
                </tr>
                <?php  
                 };?>
                
               
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
     <?php include('footer.php');?>
  </div>
</body>

</html>
