<?php
ob_start();
include 'includes/head.php';
include 'includes/header.php';
include 'includes/sidebar.php';


if (isset($_GET['id'])){
  $id=$_GET['id'];
  if(!empty($id)){
    if(delete_record('counselor',$id)){
      header("location:show_councelor.php");
    }
  }
}

 ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <?php include 'includes/breadcrumb.php'; ?>
    <!-- Main content -->
    <section class="content">
      
      <!-- Main row -->
      <div class="row">
       <div class="box">
            <div class="box-header">
              <h3 class="box-title">Counselor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Skype Id</th>
                            <th>Qualification</th>
                            <th>Phone No.</th>
                            <th>Status</th>
                            <th>Rating(%)</th>
                            <th>Action</th>
                            
                          </tr>
                        </thead>
                        <?php
                $sql = "SELECT * FROM `counselor` ORDER BY `id` DESC";
                $result = mysqli_query($con,$sql);
                if($result){
                  if(mysqli_num_rows($result)>0){

                        $srno = 1;
                          while($row = mysqli_fetch_assoc($result)){
                            ?>
                               <tbody>
                                <tr>
                                  <td><?php echo $srno; ?></td>
                                  <td><?php echo $row['name']; ?></td>
                                  <td><?php echo $row['email']; ?></td>
                                  <td> <?php echo $row['skype_id'] ?></td>
                                  <td> <?php echo $row['qualification'] ?></td>
                                  <td> <?php echo $row['phone_number'] ?></td>
                                  <td> <?php echo getStatus($row['status']) ?></td>
                                  <td>
                                    <?php 
                                      $rating  = $row['average_rating'];
                                      $total = ($rating/5)*100;
                                    ?>
                                     <div class="text-center">
                                        <input type="text" class="knob" value="<?php echo $total; ?>" data-width="50" data-height="50" data-fgColor="#f56954">
                                        </div>
                                  </td>
                                  <td>
                                    <a class="btn btn-danger" onclick="confDel(<?php echo $row['id'];?>);" href="javascript:;">Delete</a>
                                  </td>
                                 
                                </tr>
                                
                                
                               
                               
                               
                               
                                </tbody>
                                
                            <?php
                            $srno++;
                          }

                         ?>
                      </table>
                    <?php

                }else{
                  echo "No Recorde found";
                }
              }
               ?>
             
                
               
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'includes/footer.php'; ?>
<!-- Bootstrap 3.3.7 -->

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
  <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  function confDel(id){
    var conf=confirm("are you sure to delete this?");
    if(conf){
      window.location.href="show_students.php?id="+id;

    }
  }
</script>