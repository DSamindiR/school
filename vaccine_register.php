<?php include_once('db/conn.php'); ?>
<?php include_once('header.php');  ?>



<?php 
/*================================================Sport Register==================================*/
if (isset($_POST['add_vaccine'])) 
{

            $vaccine_name=mysqli_real_escape_string($conn, $_POST['vaccine_name']);

            $sql_select2="SELECT * FROM vaccsination WHERE vaccinName='$vaccine_name' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user=mysqli_fetch_array($result2);

            if ($user)
            {
                 if ($user['vaccinName']===$vaccine_name)
                 {
                    array_push($error, "<br>Vaccine already exists");
                 }
            }

            if (count($error)==0)
            {
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

                $sql="INSERT INTO vaccsination(vaccinName,delete_status,status) VALUES('$vaccine_name',1,0)";
                if (mysqli_query($conn,$sql)) {
                    ?><script type="text/javascript">alert("Vaccine Registered");</script><?php
                }else{
                    ?><script type="text/javascript">alert("Vaccine Register error");</script><?php
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

         $sql="UPDATE vaccsination SET delete_status = 0 WHERE idvaccsination='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('vaccine_register.php','_self')</script>";
        }
    }

/*================================================End delete sport ==================================*/



/*================================================Update Sport ==================================*/
  /*sports     idSports | SportName | TeacherInCharge | delete_status | status  */

        if (isset($_POST['update_vaccine'])) 
        {

            $hidden_vaccine_id=mysqli_real_escape_string($conn, $_POST['hidden_vaccine_id']);
            $vaccine_name=mysqli_real_escape_string($conn, $_POST['vaccine_name']);
           

            if (count($error)==0)
            {
               
                        $update_subject = "UPDATE vaccsination SET vaccinName='$vaccine_name' WHERE idvaccsination='$hidden_vaccine_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);     

            }
            else
            {
                 ?><script type="text/javascript">alert("Vaccine Update error 1");</script><?php
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
                    <h5 class="modal-title text-white">Add New Vaccine</h5>
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
                    

                           <form action="vaccine_register.php" class="signup-form" id="mainForm" method="post" enctype="multipart/form-data">

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Vaccine Name" name="vaccine_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                    </div>

                                    
                                    <button type="submit" class="btn btn-success float-right" name="add_vaccine">ADD</button>
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
    <div class="modal fade" id="updatevaccine" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Update Vaccine</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="vaccine_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="vaccine_id">vaccine id:</label>
                  <input type="text" class="form-control" placeholder="Enter vaccine id" name="vaccine_id" id="vaccine_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>

                <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter vaccine id" name="hidden_vaccine_id" id="hidden_vaccine_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="subject_name">vaccine Name:</label>
                  <input type="text" class="form-control" placeholder="Enter vaccine Name" name="vaccine_name" id="vaccine_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>


                    <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Sport'); "name="update_vaccine">UPDATE VACCINE DETAILS</button>
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
              New Vaccine
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
                      
                          <th>Vaccine id</th>
                          <th>Vaccine Name</th>
                          <th>Action</th>
                      </tr>
                    </thead>

                      <?php 
                                
                          $get_subject = "SELECT * FROM vaccsination WHERE delete_status=1 ORDER BY idvaccsination DESC";
                                    
                          $run_rpro = mysqli_query($conn,$get_subject);
              
                          while($row_rpro=mysqli_fetch_array($run_rpro))
                          {
                           
                              $idVaccine=$row_rpro['idvaccsination'];
                              $VaccineName=$row_rpro['vaccinName'];

                               

                      ?>


                    <tbody>
                      <tr>

                          <td><?php echo $idVaccine; ?></td>
                          <td><?php echo $VaccineName; ?></td>

                          <td>
                            <div class="dropdown">
                              <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item vaccine1" href="vaccine_register.php" data-id="<?php echo $idVaccine; ?>" data-toggle="modal" data-target="#updatevaccine"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="vaccine_register.php?delete_id=<?php echo $idVaccine; ?>"  onclick="return confirm('Do You Want To Delete Sport');"><i class="fa fa-trash"></i> Delete</a>
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


    $('.vaccine1').click(function(){

        var sport_id1=$(this).data('id');

          $.ajax({

                url:'vaccine_update_ajax.php',

                type:'post',

                data:{id1:sport_id1},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#vaccine_id').val(d[1]);
                            $('#hidden_vaccine_id').val(d[1]);
                            $('#vaccine_name').val(d[2]);
                           
                    }

            }
          });
    });



});
</script>