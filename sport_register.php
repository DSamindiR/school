<?php include_once('db/conn.php'); ?>
<?php include_once('header.php');  ?>



<?php 
/*================================================Sport Register==================================*/
if (isset($_POST['register_sport'])) 
{

            $sport_name=mysqli_real_escape_string($conn, $_POST['sport_name']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);

            $sql_select2="SELECT * FROM sports WHERE SportName='$sport_name' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user=mysqli_fetch_array($result2);

            if ($user)
            {
                 if ($user['SportName']===$sport_name)
                 {
                    array_push($error, "<br>Sport already exists");
                 }
            }

            if (count($error)==0)
            {
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

                $sql="INSERT INTO sports(SportName,TeacherInCharge,delete_status,status) VALUES('$sport_name','$teacher_incharge',1,0)";
                if (mysqli_query($conn,$sql)) {
                    ?><script type="text/javascript">alert("Sport Registerd");</script><?php
                }else{
                    ?><script type="text/javascript">alert("Sport Register error");</script><?php
                }

            }else{
             ?><script type="text/javascript">alert("Some Field allready exit");</script><?php
            }
}
/*================================================End Sport Register==================================*/



/*================================================Delete Sport ==================================*/
    if (isset($_GET['delete_id'])) 
    {
        $id=mysqli_real_escape_string($conn,$_GET['delete_id']);
  /*sports     idSports  SportName TeacherInCharge delete_status status  */

         $sql="UPDATE sports SET delete_status = 0 WHERE idSports='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('sport_register.php','_self')</script>";
        }
    }

/*================================================End delete sport ==================================*/



/*================================================Update Sport ==================================*/
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

        if (isset($_POST['update_sport'])) 
        {

            $hidden_sport_id=mysqli_real_escape_string($conn, $_POST['hidden_sport_id']);
            $sport_name=mysqli_real_escape_string($conn, $_POST['sport_name']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);


            if (count($error)==0)
            {
               
                        $update_subject = "UPDATE sports SET SportName='$sport_name',TeacherInCharge='$teacher_incharge' WHERE idSports='$hidden_sport_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);     

            }
            else
            {
                 ?><script type="text/javascript">alert("Sport Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Activity ==================================*/ -->








<!-- =====================================The insert Sport Modal ========================================-->
    <div class="modal fade" id="regspo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Add New Sport</h5>
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
                    

                           <form action="sport_register.php" class="signup-form" id="mainForm" method="post" enctype="multipart/form-data">

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Sport's Name" name="sport_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
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
                                    <button type="submit" class="btn btn-success float-right" name="register_sport">ADD</button>
                            </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
                    
                </div>

            </div>
        </div>
    </div>
        
<!-- =================================End insert Sport modal ========================================-->


                    


<!-- =====================================The update Sport modal ========================================-->
    <div class="modal fade" id="updatespo" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Update Sport</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="sport_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="sport_id">Sport id:</label>
                  <input type="text" class="form-control" placeholder="Enter Sport id" name="sport_id" id="sport_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Sport id" name="hidden_sport_id" id="hidden_sport_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="subject_name">Sport Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Sport Name" name="sport_name" id="sport_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
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

                    <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Sport'); "name="update_sport">UPDATE SPORT DETAILS</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-dismiss="modal">CANCEL</button>
          
        </div>
        
      </div>
    </div>
  </div>
<!-- =================================End update Subject modal ========================================-->








<div class="col-sm-12">
<div class="form-group">

      <div class="row">
        <div class="col-lg-10">
          <div class="statistic d-flex align-items-center bg-white has-shadow">
            <br>
            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#regspo">
              New Sport
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
                      
                          <th>Sport id</th>
                          <th>Sport Name</th>
                          <th>Teacher Incharge</th>
                          <th>Action</th>
                      </tr>
                    </thead>

                      <?php 
                                
                          $get_subject = "SELECT * FROM sports WHERE delete_status=1 ORDER BY idSports DESC";
                                    
                          $run_rpro = mysqli_query($conn,$get_subject);
              
                          while($row_rpro=mysqli_fetch_array($run_rpro))
                          {
                            /* idSports  SportName TeacherInCharge delete_status status   */
                              $idSports=$row_rpro['idSports'];
                              $SportName=$row_rpro['SportName'];
                              $TeacherInCharge=$row_rpro['TeacherInCharge'];

                               $get_teacher = "SELECT * FROM teacher WHERE idTeacher='$TeacherInCharge' LIMIT 1";     
                               $res = mysqli_query($conn,$get_teacher);

                               if($result=mysqli_fetch_array($res)){
                                  $teacher_name=$result['Name'];
                               }

                      ?>


                    <tbody>
                      <tr>

                          <td><?php echo $idSports; ?></td>
                          <td><?php echo $SportName; ?></td>
                          <td><?php echo $teacher_name; ?></td>

                          <td>
                            <div class="dropdown">
                              <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item sport1" href="sport_register.php" data-id="<?php echo $idSports; ?>" data-toggle="modal" data-target="#updatespo"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="sport_register.php?delete_id=<?php echo $idSports; ?>"  onclick="return confirm('Do You Want To Delete Sport');"><i class="fa fa-trash"></i> Delete</a>
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
      // console.log(0)
      $('#example').DataTable();
      // console.log(1)
      $('#mainForm').parsley();
      // console.log(2)
      $('.sl2').select2();
      // console.log(3)


    $('.sport1').click(function(){

        var sport_id1=$(this).data('id');

          $.ajax({

                url:'sport_update_ajax.php',

                type:'post',

                data:{id1:sport_id1},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#sport_id').val(d[1]);
                            $('#hidden_sport_id').val(d[1]);
                            $('#sport_name').val(d[2]);
                            $('#teacher_incharge').val(d[3]);
                    }

            }
          });
    });



});
</script>