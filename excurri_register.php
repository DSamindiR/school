<?php include_once('db/conn.php'); ?>
<?php include_once('header.php');  ?>



<?php 
/*================================================Activity Register==================================*/
if (isset($_POST['register_excurri'])) 
{

            $excurri_name=mysqli_real_escape_string($conn, $_POST['excurri_name']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);

            $sql_select2="SELECT * FROM extracurricularactivities WHERE CurricularName='$excurri_name' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user=mysqli_fetch_array($result2);

            if ($user)
            {
                 if ($user['CurricularName']===$excurri_name)
                 {
                    array_push($error, "<br>Activity already exists");
                 }
            }

            if (count($error)==0)
            {
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

                $sql="INSERT INTO extracurricularactivities(CurricularName,TeacherInCharge,delete_status,status) VALUES('$excurri_name','$teacher_incharge',1,0)";
                if (mysqli_query($conn,$sql)) {
                    ?><script type="text/javascript">alert("Activity Registerd");</script><?php
                }else{
                    ?><script type="text/javascript">alert("Activity Register error");</script><?php
                }

            }else{
             ?><script type="text/javascript">alert("Some Field allready exit");</script><?php
            }
}
/*================================================End Activity Register==================================*/



/*================================================Delete Activity ==================================*/
    if (isset($_GET['delete_id'])) 
    {
        $id=mysqli_real_escape_string($conn,$_GET['delete_id']);
  /*sports     idSports  SportName TeacherInCharge delete_status status  */

         $sql="UPDATE extracurricularactivities SET delete_status = 0 WHERE idActivities='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('excurri_register.php','_self')</script>";
        }
    }

/*================================================End delete sport ==================================*/



/*================================================Update Activity ==================================*/
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

        if (isset($_POST['update_excurri'])) 
        {

            $hidden_excurri_id=mysqli_real_escape_string($conn, $_POST['hidden_excurri_id']);
            $excurri_name=mysqli_real_escape_string($conn, $_POST['excurri_name']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);


            if (count($error)==0)
            {
               
                        $update_subject = "UPDATE extracurricularactivities SET CurricularName='$excurri_name',TeacherInCharge='$teacher_incharge' WHERE idActivities
                        ='$hidden_excurri_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);     

            }
            else
            {
                 ?><script type="text/javascript">alert("Activity Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Activity ==================================*/ -->








<!-- =====================================The insert Activity Modal ========================================-->
    <div class="modal fade" id="regexcurri" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Add New Ex-Curricular Activity</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                        <?php 

                            if (isset($error)&&!empty($error) ) {
                                ?><div class="alert alert-danger"><?php
                                include_once('db/error.php');
                                ?></div><?php
                            }
                           ?>
                    

                           <form action="excurri_register.php" class="signup-form" id="mainForm" method="post" enctype="multipart/form-data">

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Activity Name" name="excurri_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tic">Select Teacher In Charge</label>
                                        <select  name="teacher_incharge" class="form-control sl2" required>
                                            <option selected disabled> Select Activity Head</option>
                                                <?php
                                                    
                                                    $get_cat = "SELECT * FROM teacher";
                                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                                            
                                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                        $idTeacher = $row_cat['idTeacher'];
                                                        $Name = $row_cat['Name'];
                                                                                                    
                                                        echo " <option value='$idTeacher'> $Name </option>";
                                                } 
                                                ?> 
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right" name="register_excurri">ADD</button>
                            </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
                    
                </div>

            </div>
        </div>
    </div>
        
<!-- =================================End insert Activity modal ========================================-->


                    


<!-- =====================================The update Activity modal ========================================-->
    <div class="modal fade" id="updateexcurri" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Update Activity</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="excurri_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="excurri_id">Activity id:</label>
                  <input type="text" class="form-control" placeholder="Enter Activity id" name="excurri_id" id="excurri_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Activity id" name="hidden_excurri_id" id="hidden_excurri_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="subject_name">Activity Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Activity Name" name="excurri_name" id="excurri_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="subject_head"></label>
                    <select  name="teacher_incharge"  class="form-control" id="teacher_incharge" required>
                        <option selected disabled> Select Teacher Incharge</option>
                    
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

                    <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Activity'); "name="update_excurri">UPDATE ACTIVITY DETAILS</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-dismiss="modal">CANCEL</button>
          
        </div>
        
      </div>
    </div>
  </div>
<!-- =================================End update Activity modal ========================================-->








<div class="col-sm-12">
<div class="form-group">

      <div class="row">
        <div class="col-lg-10">
          <div class="statistic d-flex align-items-center bg-white has-shadow">
            <br>
            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#regexcurri">
              New Ex-Curricular Activity
            </button>
            <br>
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
                      
                          <th>Ex-Curr id</th>
                          <th>Activity Name</th>
                          <th>Teacher Incharge</th>
                          <th>Action</th>
                      </tr>
                    </thead>

                      <?php 
                                
                          $get_subject = "SELECT * FROM extracurricularactivities WHERE delete_status=1 ORDER BY idActivities DESC";
                                    
                          $run_rpro = mysqli_query($conn,$get_subject);
              
                          while($row_rpro=mysqli_fetch_array($run_rpro))
                          {
                            /* idSports  SportName TeacherInCharge delete_status status   */
                              $idexcurri=$row_rpro['idActivities'];
                              $excurriName=$row_rpro['CurricularName'];
                              $TeacherInCharge=$row_rpro['TeacherInCharge'];

                               $get_teacher = "SELECT * FROM teacher WHERE idTeacher='$TeacherInCharge' LIMIT 1";     
                               $res = mysqli_query($conn,$get_teacher);

                               if($result=mysqli_fetch_array($res)){
                                  $teacher_name=$result['Name'];
                               }

                      ?>


                    <tbody>
                      <tr>

                          <td><?php echo $idexcurri; ?></td>
                          <td><?php echo $excurriName; ?></td>
                          <td><?php echo $teacher_name; ?></td>

                          <td>
                            <div class="dropdown">
                              <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item excurri1" href="excurri_register.php" data-id="<?php echo $idexcurri; ?>" data-toggle="modal" data-target="#updateexcurri"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="excurri_register.php?delete_id=<?php echo $idexcurri; ?>"  onclick="return confirm('Do You Want To Delete Activity');"><i class="fa fa-trash"></i> Delete</a>
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
</div>
</div>



<?php include_once('footer.php'); ?>



<script type="text/javascript">
    $(document).ready(function() {
      console.log(0)
      $('#example').DataTable();
      // console.log(1)
      // $('#mainForm').parsley();
      // console.log(2)
      // $('.sl2').select2();
      // console.log(3)


    $('.excurri1').click(function(){

        var sport_id1=$(this).data('id');

          $.ajax({

                url:'excurri_update_ajax.php',

                type:'post',

                data:{id1:sport_id1},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#excurri_id').val(d[1]);
                            $('#hidden_excurri_id').val(d[1]);
                            $('#excurri_name').val(d[2]);
                            $('#teacher_incharge').val(d[3]);
                    }

            }
          });
    });



});
</script>