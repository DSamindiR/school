<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>


<?php 
/*================================================Teacher Register==================================*/
if (isset($_POST['register_user'])) 
{


            $user_name=mysqli_real_escape_string($conn, $_POST['user_name']);
            $email1=mysqli_real_escape_string($conn, $_POST['email1']);
            $password=mysqli_real_escape_string($conn, $_POST['password']);
            $previlages=mysqli_real_escape_string($conn, $_POST['previlages']);
            $ex_previlages=mysqli_real_escape_string($conn, $_POST['ex_previlages']);
            $first_name=mysqli_real_escape_string($conn, $_POST['first_name']);
            $last_name=mysqli_real_escape_string($conn, $_POST['last_name']);
           


            $epw=sha1($password);

            /*iduser  userName  password  email extra_previlages  previlages_idpre*/
            $sql_select="SELECT * FROM user WHERE userName='$user_name' OR email='$email1' LIMIT 1";
            $result=mysqli_query($conn, $sql_select);
            $user=mysqli_fetch_array($result);

            if ($user)
            {
                 if ($user['userName']===$user_name)
                 {
                    array_push($error, "<br>Username already exists");
                }
                if ($user['email']===$email1) 
                {
                    array_push($error, "<br>Email already exists");
                }
                
            }


            if (count($error)==0)
            {
  /*
iduser,userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name,img,address,nic,telephone,DOB
*/
                   if (isset($user_img)) 
                   {
                      move_uploaded_file($temp_img1, "img/$user_img");

                      $sql="INSERT INTO user(userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name) VALUES('$user_name','$epw','$email1','$ex_previlages','$previlages',1,0,'$first_name','$last_name')";

                        if(mysqli_query($conn,$sql))
                        {
                            ?><script type="text/javascript">alert("User Registerd");</script><?php
                        }
                        else
                        {
                          ?><script type="text/javascript">alert("User Register error");</script><?php
                        }

                   }
                   else
                   {
                       $sql="INSERT INTO user(userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name) VALUES('$user_name','$epw','$email1','$ex_previlages','$previlages',1,0,'$first_name','$last_name')";
                    

                        if(mysqli_query($conn,$sql))
                        {
                            ?><script type="text/javascript">alert("User Registerd");</script><?php
                        }
                        else
                        {
                          ?><script type="text/javascript">alert("User Register error");</script><?php
                        }
                   }

        }
        else
        {
               ?><script type="text/javascript">alert("Some Fields already exit");</script><?php
        }
}
/*================================================end Teacher Register==================================*/








/*================================================delete Teacher ==================================*/
    if (isset($_GET['delete_id'])) 
    {
        $id=mysqli_real_escape_string($conn,$_GET['delete_id']);

         /*
iduser,userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name,img,address,nic,telephone,DOB
*/

         $sql="UPDATE user SET delete_status = 0 WHERE iduser='$id'";

        if (mysqli_query($conn,$sql))
        {
           echo "<script>window.open('user_register.php','_self')</script>";
        }
    }

/*================================================end delete Teacher ==================================*/










/*================================================update Teacher ==================================*/

        if (isset($_POST['update_user'])) 
        {


            $hidden_user_id=mysqli_real_escape_string($conn, $_POST['hidden_user_id']);
            $first_name=mysqli_real_escape_string($conn, $_POST['first_name']);
            $last_name=mysqli_real_escape_string($conn, $_POST['last_name']);
            $email1=mysqli_real_escape_string($conn, $_POST['email1']);
            $previlages=mysqli_real_escape_string($conn, $_POST['previlages']);
            $ex_previlages=mysqli_real_escape_string($conn, $_POST['ex_previlages']);


            if (count($error)==0)
            {
                   /*

iduser,first_name,last_name,email,userName,password,extra_previlages,previlages_idprevilages,delete_status,status

*/
                  /* if (!empty($user_img)) 
                   {
                     */
                      /*  move_uploaded_file($temp_img1, "img/$user_img");*/
                        $update_teacher = "UPDATE user SET first_name='$first_name',last_name='$last_name', email='$email1',extra_previlages='$ex_previlages',previlages_idprevilages='$previlages' WHERE iduser='$hidden_user_id' LIMIT 1";
                          mysqli_query($conn,$update_teacher);     

                   /*}
                   else 
                   {
                         $update_teacher = "UPDATE user SET email='$email1',extra_previlages='$ex_previlages',previlages_idprevilages='$previlages',first_name='$first_name',last_name='$last_name',address='$address',nic='$nic',telephone='$wno',DOB='$dob' WHERE iduser='$hidden_user_id' LIMIT 1";
                          mysqli_query($conn,$update_teacher);     
                   }
*/
            }
            else
            {
                 ?><script type="text/javascript">alert("User Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Teacher ==================================*/ -->














<!-- =====================================The insert teacher modal ========================================-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title text-white">User Registration Form</h4>
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
              <form action="user_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                <h3 class="text-success">Login Information</h3>
                <div class="form-group">
                  <label for="first_name">First Name:</label>
                  <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="first_name">Last Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="user_name">User Name:</label>
                  <input type="text" class="form-control" placeholder="Enter User Name" name="user_name" required data-parsley-pattern="^[a-zA-Z0-9 ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" placeholder="Enter Email" name="email1" required data-parsley-type="email" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="pw" placeholder="Enter Password" name="password" required data-parsley-length=[8,16] data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="confirm_password">Confirm Password:</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required data-parsley-equalto="#pw" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="user_type">User Type:</label>&nbsp
                  <img src="img/1.png" id="loader">
                  <div id="load">
                    <select class="form-control" name="previlages" required>
                     <option selected disabled> Select</option>
                      <option value="1">Admin</option>
                      <option value="2">Modaretor</option>
                      <option value="3">Teacher</option>
                      <option value="4">Student</option>
                    </select>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="exp">Extra User Permissions:</label>
                  <input type="text" class="form-control" placeholder="Enter Extra User Permissions" name="ex_previlages" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup"/>
                </div>            
                 <button type="submit" class="btn btn-success float-right" name="register_user">Register</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- =================================End insert teacher modal ========================================-->












<!-- ================================= update teacher modal ========================================-->

  <div class="modal fade" id="update_modal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title text-white">User update Form</h4>
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
              <form action="user_register.php" id="mainForm" method="post" enctype="multipart/form-data">
                <h3 class="text-success">Login Information</h3>
                <div class="form-group">
                  <label for="name">User id:</label>
                  <input type="text" id="user_id" name="user_id" class="form-control" placeholder="Enter User Id" required disabled />
                </div>
                 <div class="form-group">
                  <input type="hidden" id="hidden_user_id" name="hidden_user_id" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="first_name">First Name:</label>
                  <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" id="first_name" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="first_name">Last Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" placeholder="Enter Email" name="email1" id="email1" required data-parsley-type="email" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="user_type">User Type:</label>&nbsp
                    <select class="form-control" name="previlages" id="previlages" required>
                     <option selected disabled> Select</option>
                      <option value="1">Admin</option>
                      <option value="2">Modaretor</option>
                      <option value="3">Teacher</option>
                      <option value="4">Student</option>
                    </select>
                </div>
                 <div class="form-group">
                  <label for="exp">Extra User Permissions:</label>
                  <input type="text" class="form-control" placeholder="Enter Extra User Permissions" name="ex_previlages" id="ex_previlages" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup"/>
                </div> 
              <!--   <div class="form-group">                      
                      <label class="col-md-3 control-label"> Approvement</label>                       
                      <div class="col-md-6">        
                                   <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-success ">
                                        <input type="radio" id="approve1" name="options" value="1" autocomplete="off" required> 
                                        Approve
                                        </label>

                                        <label class="btn btn-outline-danger">
                                        <input type="radio" id="approve1" name="options" value="0" autocomplete="off" required> UnApprove
                                        </label>
                                    </div>
                      </div>                   
                   </div>  -->
                 <button type="submit" class="btn btn-success float-right" name="update_user"  onclick="return confirm('Do You Want To Update Teacher');">Update Teacher Details</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- ================================= end update teacher modal ========================================-->











<!-- ================================= view teacher details modal ========================================-->
<div class="modal fade" id="view_user_details">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">All User Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="user_view">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- ================================= end view teacher details modal ====================================-->







  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        Add New User
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
                      <th>View Details</th>
                      <th>User Id</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>User Name</th>
                      <th>User type</th>
                     <!--  <th>Active</th> -->
                      <th>Action</th>
                  </tr>
              </thead>

                  <?php 
                            
  /*
iduser,userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name,img,address,nic,telephone,DOB
*/
         

                      $get_teacher = "SELECT * FROM user WHERE delete_status=1 ORDER BY iduser DESC";
                                
                      $run_rpro = mysqli_query($conn,$get_teacher);
          
                      while($row_rpro=mysqli_fetch_array($run_rpro))
                      {
                          $iduser=$row_rpro['iduser'];
                          $first_name=$row_rpro['first_name'];
                          $last_name=$row_rpro['last_name'];
                          $email=$row_rpro['email'];
                          $userName=$row_rpro['userName'];
                          /*$status=$row_rpro['status'];*/
                          $previlages_idprevilages=$row_rpro['previlages_idprevilages'];

/*                          if ($status==1) {
                              $st="Active";
                          }else{
                               $st="Inactive";
                          }
*/

                          if ($previlages_idprevilages==1) {
                              $user_type="Admin";
                          }elseif ($previlages_idprevilages==2) {
                              $user_type="Modaretor";
                          }elseif ($previlages_idprevilages==3) {
                              $user_type="Teacher";
                          }else{
                            $user_type="Student";
                          }

                  ?>

              <tbody>
                  <tr>
                      <td>
                        <a class="btn btn-success uview" data-toggle="modal" data-target="#view_user_details" data-idview="<?php echo $iduser; ?>">View</a>
                      </td>
                      <td><?php echo $iduser; ?></td>
                      <td><?php echo $first_name; ?></td>
                      <td><?php echo $last_name; ?></td>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $userName; ?></td>
                      <td><?php echo $user_type; ?></td>
                      <!-- <td><?php echo $st; ?></td> -->

                  <td>
                    <div class="dropdown">
                      <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item user_up" href="user_register.php" data-id="<?php echo $iduser; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a>

                            <a class="dropdown-item" href="user_register.php?delete_id=<?php echo $iduser; ?>"  onclick="return confirm('Do You Want To Delete User');"><i class="fa fa-trash"></i> Delete</a>
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

      $('#loader').click(function(){
          $('#load').load(" #load");
     });




    $('.user_up').click(function(){

           var userid=$(this).data('id');
        
          $.ajax({

                url:'user_details_update_ajax.php',

                type:'post',

                data:{id1:userid},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                        $('#user_id').val(d[1]);
                        $('#hidden_user_id').val(d[1]);
                        $('#first_name').val(d[2]);
                        $('#last_name').val(d[3]);
                        $('#email1').val(d[4]);
                        $('#previlages').val(d[5]);
                        $('#ex_previlages').val(d[6]);
                      /*  $('#approve1').val(d[12]);*/
                    }

            }
          });
    });


     $('.uview').click(function(){

        var idview=$(this).data('idview');
        
          $.ajax({

                url:'user_details_view_ajax.php',

                type:'post',

                data:{id1:idview},

                cache: false,

                success:function(response){

                  $('#user_view').html(response);

            }
          });
    });

});
</script>