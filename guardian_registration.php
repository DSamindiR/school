<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>


<?php 
/*================================================section Register==================================*/
if (isset($_POST['guardian_register'])) 
{

            $guardian_name=mysqli_real_escape_string($conn, $_POST['guardian_name']);
            $guardian_nic=mysqli_real_escape_string($conn, $_POST['guardian_nic']);
            $guardian_mobile=mysqli_real_escape_string($conn, $_POST['guardian_mobile']);
            $guardian_address=mysqli_real_escape_string($conn, $_POST['guardian_address']);
            $guardian_occupation=mysqli_real_escape_string($conn, $_POST['guardian_occupation']);
            

            $sql_select2="SELECT * FROM guardian WHERE NIC='$guardian_nic' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user=mysqli_fetch_array($result2);

            if ($user)
            {
                 if ($user['NIC']===$guardian_nic)
                 {
                    array_push($error, "<br>NIC already exit");
                 }
            }

            if (count($error)==0)
            {
/*guardian  idGuardian  Name  NIC Tp  Address delete_status status  occupatin relationship_with_student  */

                $sql="INSERT INTO guardian(Name,NIC,Tp,Address,delete_status,status,occupatin) VALUES('$guardian_name','$guardian_nic','$guardian_mobile','$guardian_address',1,0,'$guardian_occupation','$relaion')";
                if (mysqli_query($conn,$sql)) {
                    ?><script type="text/javascript">alert("Guardian Registerd");</script><?php
                }else{
                    ?><script type="text/javascript">alert("Guardian Register error");</script><?php
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
/*guardian  idGuardian  Name  NIC Tp  Address delete_status status  occupatin relationship_with_student  */

         $sql="UPDATE guardian SET delete_status = 0 WHERE idGuardian='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('guardian_registration.php','_self')</script>";
        }
    }

/*================================================end delete Teacher ==================================*/









/*================================================update Activity ==================================*/
/*guardian  idGuardian  Name  NIC Tp  Address delete_status status  occupatin relationship_with_student  */
        if (isset($_POST['update_guardian'])) 
        {

            $hidden_guardian_id=mysqli_real_escape_string($conn, $_POST['hidden_guardian_id']);
            $guardian_name=mysqli_real_escape_string($conn, $_POST['guardian_name']);
            $guardian_nic=mysqli_real_escape_string($conn, $_POST['guardian_nic']);
            $guardian_mobile=mysqli_real_escape_string($conn, $_POST['guardian_mobile']);
            $guardian_address=mysqli_real_escape_string($conn, $_POST['guardian_address']);
            $guardian_occupation=mysqli_real_escape_string($conn, $_POST['guardian_occupation']);
            


            if (count($error)==0)
            {
               
                        $update_subject = "UPDATE guardian SET Name='$guardian_name',NIC='$guardian_nic',Tp='$guardian_mobile',Address='$guardian_address',occupatin='$guardian_occupation' WHERE idGuardian='$hidden_guardian_id' LIMIT 1";
                          mysqli_query($conn,$update_subject);     

            }
            else
            {
                 ?><script type="text/javascript">alert("Guardian Update error 1");</script><?php
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
          <h5 class="modal-title text-white">Guardian Information</h5>
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
              <form action="guardian_registration.php" id="mainForm" method="post" enctype="multipart/form-data">
               
                <div class="form-group">
                  <label for="guardian_name">Guardian Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian Name" name="guardian_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="nic">NIC:</label>
                  <input type="text" class="form-control" placeholder="Enter NIC" name="guardian_nic" required data-parsley-pattern="^[0-9Vv]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="nic">Mobile:</label>
                  <input type="text" class="form-control" placeholder="Enter Mobile" name="guardian_mobile" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="guardian_address">Guardian Address:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian Address" name="guardian_address" required data-parsley-pattern="^[a-zA-Z0-9,. ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="guardian_Occupation">Guardian Occupation:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian Occupation" name="guardian_occupation" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>
                
                 <button type="submit" class="btn btn-success float-right" name="guardian_register">Register</button>
              </form>

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
          <h5 class="modal-title text-white">Update Guardian Information</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              <form action="guardian_registration.php" id="mainForm" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="section_id">Guardian id:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian id" name="guardian_id" id="guardian_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" disabled />
                </div>
                <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Guardian id" name="hidden_guardian_id" id="hidden_guardian_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>
               <div class="form-group">
                  <label for="guardian_name">Guardian Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian Name" name="guardian_name" id="guardian_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="nic">NIC:</label>
                  <input type="text" class="form-control" placeholder="Enter NIC" name="guardian_nic" id="guardian_nic" required data-parsley-pattern="^[0-9Vv]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="nic">Mobile:</label>
                  <input type="text" class="form-control" placeholder="Enter Mobile" name="guardian_mobile" id="guardian_mobile" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="guardian_address">Guardian Address:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian Address" name="guardian_address" id="guardian_address" required data-parsley-pattern="^[a-zA-Z0-9,. ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="guardian_Occupation">Guardian Occupation:</label>
                  <input type="text" class="form-control" placeholder="Enter Guardian Occupation" name="guardian_occupation" id="guardian_occupation" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div>
                

                 <button type="submit" class="btn btn-success float-right" onclick="return confirm('Do You Want To Update Guardian'); "name="update_guardian">Update Guardian Details</button>
              </form>

        </div>

        
      </div>
    </div>
  </div>
<!-- =================================End update Subject modal ========================================-->








<div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
          Register New Guardian
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
                              
                                  <th>Guardian id</th>
                                  <th>Guardian Name</th>
                                  <th>NIC</th>
                                  <th>Mobile</th>
                                  <th>Address</th>
                                  <th>Occupation</th>
                                  <th>Action</th>
                              </tr>
                          </thead>

                              <?php 
                                        
                                  $get_subject = "SELECT * FROM guardian WHERE delete_status=1 ORDER BY idGuardian DESC";
                                            
                                  $run_rpro = mysqli_query($conn,$get_subject);
                      
                                  while($row_rpro=mysqli_fetch_array($run_rpro))
                                  {
                              /*guardian  idGuardian  Name  NIC Tp  Address delete_status status  occupatin relationship_with_student  */
                                      $idGuardian=$row_rpro['idGuardian'];
                                      $Name=$row_rpro['Name'];
                                      $NIC=$row_rpro['NIC'];
                                      $Tp=$row_rpro['Tp'];
                                      $Address=$row_rpro['Address'];
                                      $occupatin=$row_rpro['occupatin'];
                                      

                              ?>

                          <tbody>
                              <tr>
                                  <td><?php echo $idGuardian; ?></td>
                                  <td><?php echo $Name; ?></td>
                                  <td><?php echo $NIC; ?></td>
                                  <td><?php echo $Tp; ?></td>
                                  <td><?php echo $Address; ?></td>
                                  <td><?php echo $occupatin; ?></td>
                                  

                              <td>
                                <div class="dropdown">
                                  <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item guardian" href="guardian_registration.php" data-id="<?php echo $idGuardian; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a>

                                        <a class="dropdown-item" href="guardian_registration.php?delete_id=<?php echo $idGuardian; ?>"  onclick="return confirm('Do You Want To Delete Guardian');"><i class="fa fa-trash"></i> Delete</a>
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


    $('.guardian').click(function(){

        var guardian_id1=$(this).data('id');
        
          $.ajax({

                url:'guardian_upadate_ajax.php',

                type:'post',

                data:{id1:guardian_id1},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#guardian_id').val(d[1]);
                            $('#hidden_guardian_id').val(d[1]);
                            $('#guardian_name').val(d[2]);
                            $('#guardian_nic').val(d[3]);
                            $('#guardian_mobile').val(d[4]);
                            $('#guardian_address').val(d[5]);
                            $('#guardian_occupation').val(d[6]);
                            $('#relaion').val(d[7]);
                    }

            }
          });
    });



});
</script>