<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>


<?php 
/*================================================Teacher Register==================================*/
if (isset($_POST['register_scholarship'])) 
{

            $month=mysqli_real_escape_string($conn, $_POST['month']);
            $amount=mysqli_real_escape_string($conn, $_POST['amount']);
            $student_id=mysqli_real_escape_string($conn, $_POST['student']);
            $discription=mysqli_real_escape_string($conn, $_POST['discription']);

             $get_student = "SELECT * FROM student WHERE idStudent='$student_id' LIMIT 1";     
             $res = mysqli_query($conn,$get_student);

             if($result=mysqli_fetch_array($res)){
                $Student_AdmissionNumber=$result['AdmissionNumber'];
             }


            if (count($error)==0)
            {
 /*scholarship idScholarship Month amount  delete_status Student_idStudent Student_AdmissionNumber */

                $sql12="INSERT INTO scholarship(Month,amount,discription ,delete_status,Student_idStudent, Student_AdmissionNumber) VALUES('$month','$amount','$discription',1,'$student_id','$Student_AdmissionNumber')";
                if (mysqli_query($conn,$sql12)) {
                  //header("location: scolership_registration.php");
                 
                    ?><script type="text/javascript">alert("Scholarship Registerd");</script><?php
                     echo "<script>window.open('scholarship_registration.php','_self')</script>";
                     exit();
              
                }else{
                    ?><script type="text/javascript">alert("Scholarship Register error");</script><?php

                }

            }else{
             ?><script type="text/javascript">alert("Some Field allready exit");</script><?php
            }
}
/*================================================end Teacher Register==================================*/












/*================================================delete Teacher ==================================*/
    if (isset($_GET['delete_id'])) 
    {
        $id=mysqli_real_escape_string($conn,$_GET['delete_id']);
 /*scholarship idScholarship Month amount  delete_status Student_idStudent Student_AdmissionNumber */
         $sql="UPDATE scholarship SET delete_status = 0 WHERE idScholarship='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('scholarship_registration.php','_self')</script>";
            exit();
        }
    }

/*================================================end delete Teacher ==================================*/











/*================================================update Activity ==================================*/
/*scholarship idScholarship Month amount  delete_status Student_idStudent Student_AdmissionNumber */
 
        if (isset($_POST['update_scholarship'])) 
        {

            $month=mysqli_real_escape_string($conn, $_POST['month']);
            $amount=mysqli_real_escape_string($conn, $_POST['amount']);
            $discription=mysqli_real_escape_string($conn, $_POST['discription']);
            $Student=mysqli_real_escape_string($conn, $_POST['Student']);
            $hiddenen_scholarship_id=mysqli_real_escape_string($conn, $_POST['hiddenen_scholarship_id']);


            if (count($error)==0)
             {
               
                        $update_subject = "UPDATE scholarship SET Month='$month',amount='$amount',discription='$discription',Student_idStudent='$Student' WHERE idScholarship='$hiddenen_scholarship_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);
                          echo "<script>window.open('scholarship_registration.php','_self')</script>";
                          exit();

            }
            else
            {
                 ?><script type="text/javascript">alert("Scholarship Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Activity ==================================*/ -->














<!-- =====================================The insert Subject modal ========================================-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
            <h4 class="modal-title text-white">Scholarship Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <?php 

                if (isset($error)&&!empty($error) ) {
                    ?><div class="alert alert-danger"><?php
                    include_once('db/error.php');
                    ?></div><?php
                }
               ?>
              <form action="scholarship_registration.php" id="mainForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="month">Month :</label>
                  <input type="date" class="form-control" placeholder="Month" name="month" required>
                </div>
                <div class="form-group">
                  <label for="month">Amount :</label>
                  <input type="Number" class="form-control" placeholder="Amount" name="amount" required data-parsley-pattern="^[0-9.]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="medium" >Student :</label>
                    <select  name="student" class="form-control sl2" required>
                        <option selected disabled> Select Student</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM student";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $idStudent = $row_cat['idStudent'];
                                        $AdmissionNumber = $row_cat['AdmissionNumber'];
                                                                            
                                        echo " <option value='$idStudent'> $AdmissionNumber </option>";
                                    } ?>           
                     </select>
                </div>
                <div class="form-group">
                  <label for="comment">Discription:</label>
                  <textarea class="form-control" rows="4" name="discription" placeholder="Enter Discription" required></textarea>
                </div>
                 <button type="submit" class="btn btn-success float-right" name="register_scholarship">Add Scholarship</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- =================================End insert Subject modal ========================================-->









<!-- =====================================The update Subject modal ========================================-->
  <div class="modal fade" id="update_modal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
            <h4 class="modal-title text-white">Update Scholarship Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="scholarship_registration.php" id="mainForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="scholarship_id">Scholarship id:</label>
                  <input type="text" class="form-control" name="scholarship_id" id="scholarship_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>
                <div class="form-group">
                  <input type="hidden" class="form-control" name="hiddenen_scholarship_id" id="hiddenen_scholarship_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="admission_no">Student Admission No:</label>
                  <input type="text" class="form-control" placeholder="Enter Admission No" name="admission_no" id="admission_no" required data-parsley-pattern="^[a-zA-Z0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>
                <div class="form-group">
                  <label for="month">Month :</label>
                  <input type="date" class="form-control" placeholder="Month" name="month" id="month" required>
                </div>
                <div class="form-group">
                  <label for="month">Amount :</label>
                  <input type="Number" class="form-control" placeholder="Amount" name="amount" id="amount" required data-parsley-pattern="^[0-9.]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="medium" >Student :</label>
                    <select  name="Student" id="Student" class="form-control" required>
                        <option selected disabled> Select Student</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM student";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $idStudent = $row_cat['idStudent'];
                                        $AdmissionNumber = $row_cat['AdmissionNumber'];
                                                                            
                                        echo " <option value='$idStudent'> $AdmissionNumber </option>";
                                    } ?>           
                     </select>
                </div>
                <div class="form-group">
                  <label for="comment">Discription:</label>
                  <textarea class="form-control" rows="4" name="discription" id="discription" placeholder="Enter Discription" required></textarea>
                </div>
                 <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Scholarship'); "name="update_scholarship">Update Scholarship</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- =================================End update Subject modal ========================================-->








  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
          New Scholarship
        </button>
      </div>
    </div>
  </div>








<br>
<form action="scholarship_registration.php" method="post">
  <div class="row">
    <div class="col-lg-12">
        <div class="statistic d-flex align-items-center bg-white has-shadow">  


    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <div class="input-group-text bg-success">
          <input type="checkbox" name="c_in">
        </div>
      </div>
      <input type="date" name="in_date" class="form-control" placeholder="Some text">
    </div>&nbsp;&nbsp;
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <div class="input-group-text bg-success">
          <input type="checkbox" name="c_out">
        </div>
      </div>
      <input type="date" name="out_date" class="form-control" placeholder="Some text">
    </div>&nbsp;&nbsp;
    <div class="input-group mb-3">
       <div class="input-group-prepend">
                    <div class="input-group-text bg-success">
                      <input type="checkbox" name="std">
                    </div>
               </div>
               <select  name="search_std" class="form-control" required>
                        <option selected disabled>Select Admission No</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM student";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $AdmissionNumber = $row_cat['AdmissionNumber'];
                                                                            
                                        echo " <option value='$AdmissionNumber'> $AdmissionNumber </option>";
                                    } ?>           
                </select>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow float-right">
        <button type="submit" class="btn btn-success" name="search_scholer">
          Search Scholarship Details
      </button>
      </div>
    </div>
  </div>
</form>
<br>





<?php 

if (isset($_POST['search_scholer']) && (isset($_POST['c_in']) && isset($_POST['in_date']))  || (isset($_POST['c_out']) && isset($_POST['out_date'])) || (isset($_POST['std']) && isset($_POST['search_std']))) {
 ?>


    <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <table id="example" class="display" style="width:100%">
              <thead>
                  <tr>
                  
                      <th>Scholarship Id</th>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Discription</th>
                      <th>Student Name</th>
                      <th>Student Admission Number</th>
                      <th>Action</th>
                  </tr>
              </thead>

                  <?php 

                      $a="";

                      if ((isset($_POST['c_in']) && isset($_POST['in_date'])) && (isset($_POST['c_out']) && isset($_POST['out_date']))) {

                       $in_date=mysqli_real_escape_string($conn, $_POST['in_date']);
                       $out_date=mysqli_real_escape_string($conn, $_POST['out_date']);
                       $date1=" Month BETWEEN '$in_date' AND '$out_date' ";  
                       $a=$a.$date1;

                    }

                     if ((isset($_POST['std']) && isset($_POST['search_std'])) && ((isset($_POST['c_in']) && isset($_POST['in_date'])) && (isset($_POST['c_out']) && isset($_POST['out_date'])))) {

                       $search_std=mysqli_real_escape_string($conn, $_POST['search_std']);
                       $adminNo=" AND Student_AdmissionNumber='$search_std' ";  
                       $a=$a.$adminNo;

                    }elseif(isset($_POST['std']) && isset($_POST['search_std'])){

                       $search_std=mysqli_real_escape_string($conn, $_POST['search_std']);
                       $adminNo=" Student_AdmissionNumber='$search_std' ";  
                       $a=$a.$adminNo;
                    }


                  if (!empty($a)) {

                     $get_subject = "SELECT * FROM scholarship WHERE $a ORDER BY idScholarship DESC";
                     $run_rpro = mysqli_query($conn,$get_subject);

                     while($row_rpro=mysqli_fetch_array($run_rpro))
                      {
                          $idScholarship=$row_rpro['idScholarship'];
                          $Month=$row_rpro['Month'];
                          $amount=$row_rpro['amount'];
                          $discription=$row_rpro['discription'];
                          $Student_idStudent=$row_rpro['Student_idStudent'];
                          $Student_AdmissionNumber=$row_rpro['Student_AdmissionNumber'];

                           $get_teacher = "SELECT * FROM student WHERE idStudent='$Student_idStudent' LIMIT 1";     
                           $res = mysqli_query($conn,$get_teacher);

                           if($result=mysqli_fetch_array($res)){
                              $student_name=$result['name'];
                      }

                  ?>

              <tbody>
                  <tr>
                      <td><?php echo $idScholarship; ?></td>
                      <td><?php echo $Month; ?></td>
                      <td><?php echo $amount; ?></td>
                      <td><?php echo $discription; ?></td>
                      <td><?php echo $student_name; ?></td>
                      <td><?php echo $Student_AdmissionNumber; ?></td>

                  <td>
                    <div class="dropdown">
                      <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item scholarship_id1" href="scholarship_registration.php" data-id="<?php echo $idScholarship; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a>

                            <a class="dropdown-item" href="scholarship_registration.php?delete_id=<?php echo $idScholarship; ?>"  onclick="return confirm('Do You Want To Delete Inquary');"><i class="fa fa-trash"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                  </tr>

                </tbody>
              <?php }

              }else{
                ?><script type="text/javascript">alert('Plase Select Two Dates OR Admission No');</script><?php
              } 

              ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php   
}else{
?>

    <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <table id="example" class="display" style="width:100%">
              <thead>
                  <tr>
                  
                      <th>Scholarship Id</th>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Discription</th>
                      <th>Student Name</th>
                      <th>Student Admission Number</th>
                      <th>Action</th>
                  </tr>
              </thead>

                  <?php 

                    $today_date=date('Y-m-d');
                    echo $today_date;
                            
                      $get_subject = "SELECT * FROM scholarship WHERE delete_status=1 AND Month='$today_date' ORDER BY idScholarship DESC";
                                
                      $run_rpro = mysqli_query($conn,$get_subject);

                      while($row_rpro=mysqli_fetch_array($run_rpro))
                      {
                    /*scholarship idScholarship Month amount  delete_status Student_idStudent Student_AdmissionNumber */
                          $idScholarship=$row_rpro['idScholarship'];
                          $Month=$row_rpro['Month'];
                          $amount=$row_rpro['amount'];
                          $discription=$row_rpro['discription'];
                          $Student_idStudent=$row_rpro['Student_idStudent'];
                          $Student_AdmissionNumber=$row_rpro['Student_AdmissionNumber'];

                           $get_teacher = "SELECT * FROM student WHERE idStudent='$Student_idStudent' LIMIT 1";     
                           $res = mysqli_query($conn,$get_teacher);

                           if($result=mysqli_fetch_array($res)){
                              $student_name=$result['name'];
                           }

                  ?>

              <tbody>
                  <tr>
                      <td><?php echo $idScholarship; ?></td>
                      <td><?php echo $Month; ?></td>
                      <td><?php echo $amount; ?></td>
                      <td><?php echo $discription; ?></td>
                      <td><?php echo $student_name; ?></td>
                      <td><?php echo $Student_AdmissionNumber; ?></td>

                  <td>
                    <div class="dropdown">
                      <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item scholarship_id1" href="scholarship_registration.php" data-id="<?php echo $idScholarship; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a>

                            <a class="dropdown-item" href="scholarship_registration.php?delete_id=<?php echo $idScholarship; ?>"  onclick="return confirm('Do You Want To Delete Inquary');"><i class="fa fa-trash"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                  </tr>

                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
}
?>
  


    
<?php include_once('footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
      $('#mainForm').parsley();
      $('.sl2').select2();



    $('.scholarship_id1').click(function(){

        var scholarship=$(this).data('id');
        
          $.ajax({

                url:'scholarship_update_ajax.php',

                type:'post',

                data:{id1:scholarship},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#scholarship_id').val(d[1]);
                            $('#hiddenen_scholarship_id').val(d[1]);
                            $('#month').val(d[2]);
                            $('#amount').val(d[3]);
                            $('#discription').val(d[4]);
                            $('#Student').val(d[5]);
                            $('#admission_no').val(d[6]);
                    }

            }
          });
    });



});
</script>