<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>


<?php 
/*================================================Teacher Register==================================*/
if (isset($_POST['register_inquary'])) 
{

            $panel_head=mysqli_real_escape_string($conn, $_POST['panel_head']);
            $student_id=mysqli_real_escape_string($conn, $_POST['student_id']);
            $reason=mysqli_real_escape_string($conn, $_POST['reason']);

             $get_student = "SELECT * FROM student WHERE idStudent='$student_id' LIMIT 1";     
             $res = mysqli_query($conn,$get_student);

             if($result=mysqli_fetch_array($res)){
                $Student_AdmissionNumber=$result['AdmissionNumber'];
             }

            if (count($error)==0)
            {
        /*  idInquiary  Description PanelHead delete_status status  Student_idStudent Student_AdmissionNumber 
*/

                $sql12="INSERT INTO inquiary(Description,PanelHead,delete_status,status ,Student_idStudent, Student_AdmissionNumber) VALUES('$reason','$panel_head',1,0,'$student_id','$Student_AdmissionNumber')";
                if (mysqli_query($conn,$sql12)) {
                    ?><script type="text/javascript">alert("Done");</script><?php
                    echo "<script>window.open('inquiry_register.php','_self')</script>";
                    exit();
                }else{
                    ?><script type="text/javascript">alert("Inquiry Register error");</script><?php
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
         /*  idInquiary  Description PanelHead delete_status status  Student_idStudent Student_AdmissionNumber 
*/

         $sql="UPDATE inquiary SET delete_status = 0 WHERE idInquiary='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('inquiry_register.php','_self')</script>";
            exit();
        }
    }

/*================================================end delete Teacher ==================================*/











/*================================================update Activity ==================================*/
        /*  idInquiary  Description PanelHead delete_status status  Student_idStudent Student_AdmissionNumber 
*/

 
        if (isset($_POST['update_inquary'])) 
        {

            $hiddenen_inquary_id=mysqli_real_escape_string($conn, $_POST['hiddenen_inquary_id']);
            $reson=mysqli_real_escape_string($conn, $_POST['reson']);
            $pannel_head=mysqli_real_escape_string($conn, $_POST['pannel_head']);


            if (count($error)==0)
             {
               
                        $update_subject = "UPDATE inquiary SET Description='$reson',PanelHead='$pannel_head' WHERE idInquiary='$hiddenen_inquary_id' LIMIT 1";
                          mysqli_query($conn,$update_subject); 
                          echo "<script>window.open('inquiry_register.php','_self')</script>";
                          exit();

            }
            else
            {
                 ?><script type="text/javascript">alert("Inquary Update error 1");</script><?php
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
            <h5 class="modal-title text-white">New Inquiry</h5>
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
              <form action="inquiry_register.php" id="mainForm" method="post" enctype="multipart/form-data">
             
                <div class="form-group">
                  <label for="medium" >Pannel Head:</label>
                    <select  name="panel_head" class="form-control sl2" required>
                        <option selected disabled> Select Panel Head</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM teacher";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $idTeacher = $row_cat['idTeacher'];
                                        $Name = $row_cat['Name'];
                                                                            
                                        echo " <option value='$idTeacher'> $Name </option>";
                                    } ?>           
                     </select>
                </div>
                <div class="form-group">
                  <label for="medium" >Student :</label>
                    <select  name="student_id" class="form-control sl2" required>
                        <option selected disabled> Admisson Number</option>
                    
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
                  <label for="comment">Reason:</label>
                  <textarea class="form-control" rows="4" name="reason" placeholder="Enter Reson" required></textarea>
                </div>

                 <button type="submit" class="btn btn-success float-right" name="register_inquary">Add Inquiry</button>
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
            <h5 class="modal-title text-white">Update Inquiry</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="inquiry_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inquary_id">Inquiry id:</label>
                  <input type="text" class="form-control" name="inquary_id" id="inquary_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>
                <div class="form-group">
                  <input type="hidden" class="form-control" name="hiddenen_inquary_id" id="hiddenen_inquary_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="admission_no">Student Admission No:</label>
                  <input type="text" class="form-control" placeholder="Enter Admission No" name="admission_no" id="admission_no" required data-parsley-pattern="^[a-zA-Z0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>
                <div class="form-group">
                  <label for="medium" >Pannel Head:</label>
                    <select  name="pannel_head" id="pannel_head" class="form-control" required>
                        <option selected disabled> Select Activity Head</option>
                    
                              <?php
                                            
                                    $get_cat1 = "SELECT * FROM teacher";
                                    $run_cat1 = mysqli_query($conn, $get_cat1);
                                                                    
                                    while ($row_cat1=mysqli_fetch_array($run_cat1)) {
                                        $idTeacher1 = $row_cat1['idTeacher'];
                                        $Name = $row_cat1['Name'];
                                                                            
                                        echo " <option value='$idTeacher1'> $Name </option>";
                                    } ?>           
                     </select>
                </div>
                <div class="form-group">
                  <label for="medium" >Student :</label>
                    <select  name="student_id" id="student_id" class="form-control" required disabled>
                        <option selected disabled> Select Activity Head</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM student";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $idStudent = $row_cat['idStudent'];
                                        $name = $row_cat['name'];
                                                                            
                                        echo " <option value='$idStudent'> $name </option>";
                                    } ?>           
                     </select>
                </div>

                <div class="form-group">
                  <label for="comment">Reson:</label>
                  <textarea class="form-control" rows="4" id="reson" name="reson" placeholder="Enter Reson" required></textarea>
                </div>

                 <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Inquary'); "name="update_inquary">Update Sport Details</button>
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
          New Inquiry
        </button>
      </div>
    </div>
  </div>
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <table id="example" class="display" style="width:100%">
              <thead>
                  <tr>
                  
                      <th>inquary id</th>
                      <th>Discription</th>
                      <th>PanelHead</th>
                      <th>Student Name</th>
                      <th>Student Admission Number</th>
                      <th>Action</th>
                  </tr>
              </thead>

                  <?php 
                            
                      $get_subject = "SELECT * FROM inquiary WHERE delete_status=1 ORDER BY idInquiary DESC";
                                
                      $run_rpro = mysqli_query($conn,$get_subject);
          
                      while($row_rpro=mysqli_fetch_array($run_rpro))
                      {
                  /*inquiary  idInquiary Description PanelHead delete_status status  Student_idStudent Student_AdmissionNumber */
                          $idInquiary=$row_rpro['idInquiary'];
                          $Description=$row_rpro['Description'];
                          $PanelHead=$row_rpro['PanelHead'];
                          $Student_idStudent=$row_rpro['Student_idStudent'];
                          $Student_AdmissionNumber=$row_rpro['Student_AdmissionNumber'];

                           $get_teacher = "SELECT * FROM student WHERE idStudent='$Student_idStudent' LIMIT 1";     
                           $res = mysqli_query($conn,$get_teacher);

                           if($result=mysqli_fetch_array($res)){
                              $student_name=$result['name'];
                           }

                           $get_teacher = "SELECT * FROM teacher WHERE idTeacher='$PanelHead' LIMIT 1";     
                           $res = mysqli_query($conn,$get_teacher);

                           if($result=mysqli_fetch_array($res)){
                              $teacher_name=$result['Name'];
                           }

                  ?>

              <tbody>
                  <tr>
                      <td><?php echo $idInquiary; ?></td>
                      <td><?php echo $Description; ?></td>
                      <td><?php echo $teacher_name; ?></td>
                      <td><?php echo $student_name; ?></td>
                      <td><?php echo $Student_AdmissionNumber; ?></td>

                  <td>
                    <div class="dropdown">
                      <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item inquiary_id" href="inquiry_register.php" data-id="<?php echo $idInquiary; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a>

                            <a class="dropdown-item" href="inquiry_register.php?delete_id=<?php echo $idInquiary; ?>"  onclick="return confirm('Do You Want To Delete Inquary');"><i class="fa fa-trash"></i> Delete</a>
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

    
<?php include_once('footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
      $('#mainForm').parsley();
      $('.sl2').select2();



    $('.inquiary_id').click(function(){

        var inquiary=$(this).data('id');
        
          $.ajax({

                url:'inquiry_update_ajax.php',

                type:'post',

                data:{id1:inquiary},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#inquary_id').val(d[1]);
                            $('#hiddenen_inquary_id').val(d[1]);
                            $('#reson').val(d[2]);
                            $('#pannel_head').val(d[3]);
                            $('#student_id').val(d[4]);
                            $('#admission_no').val(d[5]);
                    }

            }
          });
    });



});
</script>