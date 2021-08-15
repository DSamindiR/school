<?php include_once('db/conn.php'); ?>
<?php include_once('header.php');  ?>



<?php 
/*================================================Activity Register==================================*/
if (isset($_POST['register_class'])) 
{

            $class_name=mysqli_real_escape_string($conn, $_POST['class_name']);
            $no_students=mysqli_real_escape_string($conn, $_POST['no_students']);
            $setion=mysqli_real_escape_string($conn, $_POST['section']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);

            $sql_select2="SELECT * FROM class WHERE Name='$class_name' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user=mysqli_fetch_array($result2);

            if ($user)
            {
                 if ($user['Name']===$class_name)
                 {
                    array_push($error, "<br>Class already exists");
                 }
            }

            if (count($error)==0)
            {
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

                $sql="INSERT INTO class(Name,NoOfStudents,section_idSection,Teacher_idTeacher,delete_status,status) VALUES('$class_name','$no_students','$setion','$teacher_incharge',1,0)";
                if (mysqli_query($conn,$sql)) {
                    ?><script type="text/javascript">alert("Class Registerd");</script><?php
                }else{
                    ?><script type="text/javascript">alert("Class Register error");</script><?php
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

         $sql="UPDATE class SET delete_status = 0 WHERE idClass='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('class_register.php','_self')</script>";
        }
    }

/*================================================End delete sport ==================================*/



/*================================================Update Activity ==================================*/
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

        if (isset($_POST['update_class'])) 
        {

            $hidden_class_id=mysqli_real_escape_string($conn, $_POST['hidden_class_id']);
            $class_name=mysqli_real_escape_string($conn, $_POST['class_name']);
            $no_students=mysqli_real_escape_string($conn, $_POST['no_students']);
            $section_id=mysqli_real_escape_string($conn, $_POST['section']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);


            if (count($error)==0)
            {
               
                        $update_subject = "UPDATE class SET Name='$class_name', NoOfStudents='$no_students', section_idSection='$section_id', Teacher_idTeacher='$teacher_incharge' WHERE idClass
                        ='$hidden_class_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);     

            }
            else
            {
                 ?><script type="text/javascript">alert("Class Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Activity ==================================*/ -->








<!-- =====================================The insert Activity Modal ========================================-->
    <div class="modal fade" id="regclass" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Add New Class</h5>
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
                    

                           <form action="class_register.php" class="signup-form" id="mainForm" method="post" enctype="multipart/form-data">

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Class Name" name="class_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="No of Students" name="no_students" required data-parsley-pattern="^[0-9a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                    </div>


                                    <div class="form-group">
                                        <label for="section">Select Section</label>
                                            <select  name="section"  class="form-control s12" required>
                                                <option selected disabled> Select Section</option>
                                            
                                                      <?php
                                                                    
                                                            $get_cat = "SELECT * FROM section";
                                                            $run_cat = mysqli_query($conn, $get_cat);
                                                                                            
                                                            while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                                $idsection = $row_cat['idSection'];
                                                                $Name = $row_cat['sectionName'];
                                                                                                    
                                                                echo " <option value='$idsection'> $Name </option>";
                                                            } ?>           
                                            </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tic">Select Class Teacher</label>
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
                                    <button type="submit" class="btn btn-success float-right" name="register_class">ADD</button>
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
    <div class="modal fade" id="updateclass" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Update Class</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="class_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="class_id">Class id:</label>
                  <input type="text" class="form-control" placeholder="Enter Class id" name="class_id" id="class_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Class id" name="hidden_class_id" id="hidden_class_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="class_name">Class Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Class Name" name="class_name" id="class_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="no_students">No Of Students:</label>
                  <input type="text" class="form-control" placeholder="Enter no of students" name="no_students" id="no_students" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>



                <div class="form-group">
                  <label for="section"></label>
                    <select  name="section"  class="form-control" id="section" required>
                        <option selected disabled> Select Section</option>
                    
                            <?php
                                                                    
                                $get_cat = "SELECT * FROM section";
                                $run_cat = mysqli_query($conn, $get_cat);
                                                                                            
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $idsection = $row_cat['idSection'];
                                        $Name = $row_cat['sectionName'];
                                                                                                    
                                    echo " <option value='$idsection'> $Name </option>";
                                    } ?>           
                    </select>
                </div>



                <div class="form-group">
                  <label for="subject_head"></label>
                    <select  name="teacher_incharge"  class="form-control" id="teacher_incharge" required>
                        <option selected disabled> Select Class Teacher</option>
                    
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

                    <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Class'); "name="update_class">UPDATE CLASS DETAILS</button>
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
            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#regclass">
              New Class
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
                      
                          <th>Class id</th>
                          <th>Class Name</th>
                          <th>No of Students</th>
                          <th>Section</th>
                          <th>Class Teacher</th>
                          <th>Action</th>
                      </tr>
                    </thead>

                      <?php 
                                
                          $get_subject = "SELECT * FROM class WHERE delete_status=1 ORDER BY idClass DESC";
                                    
                          $run_rpro = mysqli_query($conn,$get_subject);
              
                          while($row_rpro=mysqli_fetch_array($run_rpro))
                          {
                            /* idSports  SportName TeacherInCharge delete_status status   */
                              $idclass=$row_rpro['idClass'];
                              $className=$row_rpro['Name'];
                              $NoStudents=$row_rpro['NoOfStudents'];
                              $idSec=$row_rpro['section_idSection'];
                              $classTeacher=$row_rpro['Teacher_idTeacher'];

                               $get_teacher = "SELECT * FROM teacher WHERE idTeacher='$classTeacher' LIMIT 1";     
                               $res = mysqli_query($conn,$get_teacher);

                               if($result=mysqli_fetch_array($res)){
                                  $teacher_name=$result['Name'];
                                }

                               $get_section = "SELECT * FROM section WHERE idSection='$idSec' LIMIT 1";     
                               $res = mysqli_query($conn,$get_section);

                               if($result=mysqli_fetch_array($res)){
                                  $section_name=$result['sectionName'];
                               }

                      ?>


                    <tbody>
                      <tr>

                          <td><?php echo $idclass; ?></td>
                          <td><?php echo $className; ?></td>
                          <td><?php echo $NoStudents; ?></td>
                          <td><?php echo $section_name; ?></td>
                          <td><?php echo $teacher_name; ?></td>

                          <td>
                            <div class="dropdown">
                              <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item class1" href="class_register.php" data-id="<?php echo $idclass; ?>" data-toggle="modal" data-target="#updateclass"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="class_register.php?delete_id=<?php echo $idclass; ?>"  onclick="return confirm('Do You Want To Delete Class');"><i class="fa fa-trash"></i> Delete</a>
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
      
      // $('.sl2').select2();
      // console.log(3)


    $('.class1').click(function(){
// console.log(2)
        var sport_id1=$(this).data('id');

          $.ajax({

                url:'class_update_ajax.php',

                type:'post',

                data:{id1:sport_id1},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#class_id').val(d[1]);
                            $('#hidden_class_id').val(d[1]);
                            $('#class_name').val(d[2]);
                            $('#no_students').val(d[3]);
                            $('#section_id').val(d[4]);
                            $('#class_Teacher').val(d[5]);
                }

            }
          });
    });



});
</script>