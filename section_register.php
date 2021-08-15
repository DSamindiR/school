<?php include_once('db/conn.php'); ?>
<?php include_once('header.php');  ?>



<?php 
/*================================================Activity Register==================================*/
    if (isset($_POST['register_sec'])) 
    {

            $sec_name=mysqli_real_escape_string($conn, $_POST['sec_name']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['teacher_incharge']);

            $sql_select2="SELECT * FROM section WHERE sectionName='$sec_name' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user=mysqli_fetch_array($result2);

            if ($user)
            {
                 if ($user['sectionName']===$sec_name)
                 {
                    array_push($error, "<br>Section already exists");
                 }
            }

            if (count($error)==0)
            {
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

                $sql="INSERT INTO section(sectionName,SectionHead,delete_status,status) VALUES('$sec_name','$teacher_incharge',1,0)";
                if (mysqli_query($conn,$sql)) {
                    ?><script type="text/javascript">alert("Section Registerd");</script><?php
                }else{
                    ?><script type="text/javascript">alert("Section Register error");</script><?php
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

         $sql="UPDATE section SET delete_status = 0 WHERE idSection ='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('section_register.php','_self')</script>";
        }
    }

/*================================================End delete sport ==================================*/



/*================================================Update Activity ==================================*/
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

        if (isset($_POST['update_sec'])) 
        {

            $hidden_sec_id=mysqli_real_escape_string($conn, $_POST['hidden_sec_id']);
            $sec_name=mysqli_real_escape_string($conn, $_POST['sec_name']);
            $teacher_incharge=mysqli_real_escape_string($conn, $_POST['sec_head']);


            if (count($error)==0)
            {
               
                        $update_subject = "UPDATE section SET sectionName='$sec_name', SectionHead ='$teacher_incharge' WHERE idSection
                        ='$hidden_sec_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);     

            }
            else
            {
                 ?><script type="text/javascript">alert("Section Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Activity ==================================*/ -->








<!-- =====================================The insert Activity Modal ========================================-->
    <div class="modal fade" id="regsec" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Add New Section</h5>
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
                    

                           <form action="section_register.php" class="signup-form" id="mainForm" method="post" enctype="multipart/form-data">

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Section Name" name="sec_name" required data-parsley-pattern="^[0-9a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="tic">Select Head of Section</label>
                                        <select  name="teacher_incharge" class="form-control sl2" required>
                                            <option selected disabled> Select Head of Section</option>
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
                                    <button type="submit" class="btn btn-success float-right" name="register_sec">ADD</button>
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
    <div class="modal fade" id="updatesec" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Update Section</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="section_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="sec_id">Section id:</label>
                  <input type="text" class="form-control" placeholder="Enter Section id" name="sec_id" id="sec_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Section id" name="hidden_sec_id" id="hidden_sec_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="sec_name">Section Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Section Name" name="sec_name" id="sec_name" required data-parsley-pattern="^[0-9a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>



                <div class="form-group">
                  <label for="subject_head"></label>
                    <select  name="sec_head"  class="form-control" id="sec_head" required>
                        <option selected disabled> Select Head of Section </option>
                    
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

                    <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Class'); "name="update_sec">UPDATE CLASS DETAILS</button>
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
            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#regsec">
              New Section
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
                      
                          <th>Section id</th>
                          <th>Section Name</th>
                          <th>Head of Section</th>
                          <th>Action</th>
                          
                      </tr>
                    </thead>

                      <?php 
                                
                          $get_subject = "SELECT * FROM section WHERE delete_status=1 ORDER BY idSection DESC";
                                    
                          $run_rpro = mysqli_query($conn,$get_subject);
              
                          while($row_rpro=mysqli_fetch_array($run_rpro))
                          {
                            /* idSports  SportName TeacherInCharge delete_status status   */
                              $idsec=$row_rpro['idSection'];
                              $secName=$row_rpro['sectionName'];
                              $secHead=$row_rpro['SectionHead'];
                              

                               $get_teacher = "SELECT * FROM teacher WHERE idTeacher='$secHead' LIMIT 1";     
                               $res = mysqli_query($conn,$get_teacher);

                               if($result=mysqli_fetch_array($res)){
                                  $teacher_name=$result['Name'];
                                }

                          
                      ?>


                    <tbody>
                      <tr>

                          <td><?php echo $idsec; ?></td>
                          <td><?php echo $secName; ?></td>
                          <td><?php echo $teacher_name; ?></td>

                          <td>
                            <div class="dropdown">
                              <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item section1" href="section_register.php" data-id="<?php echo $idsec; ?>" data-toggle="modal" data-target="#updatesec"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="section_register.php?delete_id=<?php echo $idsec; ?>"  onclick="return confirm('Do You Want To Delete Section');"><i class="fa fa-trash"></i> Delete</a>
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
      // $('#mainForm').parsley();
      // console.log(2)      
      // $('.sl2').select2();
      // console.log(3)


    $('.section1').click(function(){

        var sport_id1=$(this).data('id');

          $.ajax({

                url:'section_update_ajax.php',

                type:'post',

                data:{id1:sport_id1},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#sec_id').val(d[1]);
                            $('#hidden_sec_id').val(d[1]);
                            $('#sec_name').val(d[2]);
                            $('#sec_head').val(d[3]);
                    
                }

            }
          });
    });



});
</script>