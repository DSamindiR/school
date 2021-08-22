<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>


<?php 
/*================================================Teacher Register==================================*/
if (isset($_POST['register_teacher'])) 
{

            $user_name=mysqli_real_escape_string($conn, $_POST['user_name']);
            $email1=mysqli_real_escape_string($conn, $_POST['email1']);
            $password=mysqli_real_escape_string($conn, $_POST['password']);
            $previlages=mysqli_real_escape_string($conn, $_POST['previlages']);
            $ex_previlages=mysqli_real_escape_string($conn, $_POST['ex_previlages']);

            $title=mysqli_real_escape_string($conn, $_POST['title']);
            $full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
            $gender=mysqli_real_escape_string($conn, $_POST['gender']);
            $civil=mysqli_real_escape_string($conn, $_POST['civil']);
            $nationality=mysqli_real_escape_string($conn, $_POST['nationality']);
            $tp=mysqli_real_escape_string($conn, $_POST['tp']);
            $wno=mysqli_real_escape_string($conn, $_POST['wno']);
            $address=mysqli_real_escape_string($conn, $_POST['address']);
            $nic=mysqli_real_escape_string($conn, $_POST['nic']);

            $first_appoiment_date=mysqli_real_escape_string($conn, $_POST['first_appoiment_date']);
            $appoiment_subject=mysqli_real_escape_string($conn, $_POST['appoiment_subject']);
            $medium=mysqli_real_escape_string($conn, $_POST['medium']);
            $sg=mysqli_real_escape_string($conn, $_POST['sg']);
            $eq=mysqli_real_escape_string($conn, $_POST['eq']);
            $pq=mysqli_real_escape_string($conn, $_POST['pq']);
            $appoiment_date=mysqli_real_escape_string($conn, $_POST['appoiment_date']);
            $wnop_number=mysqli_real_escape_string($conn, $_POST['wnop_number']);
            $paysheet=mysqli_real_escape_string($conn, $_POST['paysheet']);

            $user_img = $_FILES['p_image']['name'];
            $temp_img1 = $_FILES['p_image']['tmp_name'];

            $epw=sha1($password);

            /*iduser  userName  password  email extra_previlages  previlages_idpre*/
            $sql_select="SELECT * FROM user WHERE userName='$user_name' OR email='$email1' LIMIT 1";
            $result=mysqli_query($conn, $sql_select);
            $user=mysqli_fetch_array($result);

            $sql_select2="SELECT * FROM teacher WHERE NIC='$nic' LIMIT 1";
            $result2=mysqli_query($conn, $sql_select2);
            $user2=mysqli_fetch_array($result2);

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

            if ($user2)
            {
                 if ($user2['NIC']===$nic)
                 {
                    array_push($error, "<br>NIC already exists");
                }
            }

            if ($appoiment_date < $first_appoiment_date) 
            {
                  array_push($error, "<br>Invalied appoiment date");
            }


            if (count($error)==0)
            {

                /*iduser  first_name  last_name  email  userName  password  extra_previlages  previlages_idprevilages  delete_status  status*/

                $sql="INSERT INTO user(email,userName,password,extra_previlages,previlages_idprevilages,delete_status,status) VALUES('$email1','$user_name','$epw','$ex_previlages','$previlages',1,0)";

                if(mysqli_query($conn,$sql))
                {
                    $uid= mysqli_insert_id($conn);

                   /*idTeacher Title Name  Tp  WhatsappNumber  Address NIC Gender  ServiceGrade  educationalQualifications professionalQualifications AppoinmentDate  FirstAppoinmentDate AppoinmentSubject wnopNumber  image Medium  Nationality CivilStatus PaysheetNumber  user_iduser delete_status status  */
                   if (isset($user_img)) 
                   {
                      move_uploaded_file($temp_img1, "img/$user_img");

                      $sql_student="INSERT INTO teacher(Title,Name,Tp,WhatsappNumber,Address,NIC,Gender,ServiceGrade,  educationalQualifications,professionalQualifications,AppoinmentDate,FirstAppoinmentDate, AppoinmentSubject,wnopNumber,image,Medium,Nationality,CivilStatus,PaysheetNumber,user_iduser, delete_status,status)VALUES('$title','$full_name','$tp','$wno','$address','$nic','$gender','$sg','$eq','$pq','$appoiment_date','$first_appoiment_date','$appoiment_subject','$wnop_number','$user_img','$medium','$nationality','$civil','$paysheet','$uid',1,0)";

                        if(mysqli_query($conn,$sql_student))
                        {
                            ?><script type="text/javascript">alert("Teacher Registerd");</script><?php
                        }
                        else
                        {
                          ?><script type="text/javascript">alert("Teacher Register error");</script><?php
                        }

                   }
                   else
                   {

                    $sql_student="INSERT INTO teacher(Title,Name,Tp,WhatsappNumber,Address,NIC,Gender,ServiceGrade,  educationalQualifications,professionalQualifications,AppoinmentDate,FirstAppoinmentDate, AppoinmentSubject,wnopNumber,Medium,Nationality,CivilStatus,PaysheetNumber,user_iduser, delete_status,status) VALUES('$title','$full_name','$tp','$wno','$address','$nic','$gender','$sg','$eq','$pq','$appoiment_date','$first_appoiment_date','$appoiment_subject','$wnop_number','$medium','$nationality','$civil','$paysheet','$uid',1,0)";

                        if(mysqli_query($conn,$sql_student))
                        {
                            ?><script type="text/javascript">alert("Teacher Registerd");</script><?php
                        }
                        else
                        {
                          ?><script type="text/javascript">alert("Teacher Register error");</script><?php
                        }
                   }

            }
            else
            {
                 ?><script type="text/javascript">alert("Teacher Register error 1");</script><?php
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


         $get_teacher = "SELECT user_iduser FROM teacher WHERE idTeacher='$id' LIMIT 1";
          $run = mysqli_query($conn,$get_teacher);
          
              if($row_rpro=mysqli_fetch_array($run))
              {
                  $user_iduser=$row_rpro['user_iduser'];
              }

         $sql="UPDATE user SET delete_status = 0 WHERE iduser='$user_iduser'";

        if (mysqli_query($conn,$sql))
        {
           $sql="UPDATE teacher SET delete_status = 0 WHERE idTeacher='$id'";
           mysqli_query($conn,$sql);
           echo "<script>window.open('teacher_register.php','_self')</script>";
        }
    }

/*================================================end delete Teacher ==================================*/









/*================================================update Teacher ==================================*/

        if (isset($_POST['update_teacher'])) 
        {

            $hidden_teacher_id=mysqli_real_escape_string($conn, $_POST['hidden_teacher_id']);
            $title=mysqli_real_escape_string($conn, $_POST['title']);
            $full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
            $tp=mysqli_real_escape_string($conn, $_POST['tp']);
            $wno=mysqli_real_escape_string($conn, $_POST['wno']);
            $address=mysqli_real_escape_string($conn, $_POST['address']);
            $nic=mysqli_real_escape_string($conn, $_POST['nic']);
            $gender=mysqli_real_escape_string($conn, $_POST['gender']);
            $sg=mysqli_real_escape_string($conn, $_POST['sg']);
            $eq=mysqli_real_escape_string($conn, $_POST['eq']);
            $pq=mysqli_real_escape_string($conn, $_POST['pq']);
            $appoiment_date=mysqli_real_escape_string($conn, $_POST['appoiment_date']);
            $first_appoiment_date=mysqli_real_escape_string($conn, $_POST['first_appoiment_date']);
            $appoiment_subject=mysqli_real_escape_string($conn, $_POST['appoiment_subject']);
            $wnop_number=mysqli_real_escape_string($conn, $_POST['wnop_number']);
            $medium=mysqli_real_escape_string($conn, $_POST['medium']);
            $nationality=mysqli_real_escape_string($conn, $_POST['nationality']);
            $civil=mysqli_real_escape_string($conn, $_POST['civil']);
            $paysheet=mysqli_real_escape_string($conn, $_POST['paysheet']);


            if (isset($_POST['options'])) {
                  $options=mysqli_real_escape_string($conn, $_POST['options']);
            }


            $user_img = $_FILES['p_image']['name'];
            $temp_img1 = $_FILES['p_image']['tmp_name'];


            if ($appoiment_date < $first_appoiment_date) 
            {
                  array_push($error, "<br>Invalied appoiment date");
            }


            if (count($error)==0)
            {
                 /*idTeacher Title Name  Tp  WhatsappNumber  Address NIC Gender  ServiceGrade  educationalQualifications professionalQualifications AppoinmentDate  FirstAppoinmentDate AppoinmentSubject wnopNumber  image Medium  Nationality CivilStatus PaysheetNumber  user_iduser delete_status status  */
                   

                   if (!empty($user_img) && isset($options)) 
                   {
                     
                        move_uploaded_file($temp_img1, "img/$user_img");
                        $update_teacher = "UPDATE teacher SET Title='$title',Name='$full_name',Tp='$tp',WhatsappNumber='$wno',Address='$address',NIC='$nic',Gender='$gender',ServiceGrade='$sg',educationalQualifications='$eq',professionalQualifications='$pq',AppoinmentDate='$appoiment_date',FirstAppoinmentDate='$first_appoiment_date',AppoinmentSubject='$appoiment_subject',wnopNumber='$wnop_number',image='$user_img',Medium='$medium',Nationality='$nationality',CivilStatus='$civil',PaysheetNumber='$paysheet',status='$options' WHERE idTeacher='$hidden_teacher_id' LIMIT 1";
                          mysqli_query($conn,$update_teacher);  

                   }
                   elseif(empty($user_img) && isset($options)) 
                   {
                          $update_teacher = "UPDATE teacher SET Title='$title',Name='$full_name',Tp='$tp',WhatsappNumber='$wno',Address='$address',NIC='$nic',Gender='$gender',ServiceGrade='$sg',educationalQualifications='$eq',professionalQualifications='$pq',AppoinmentDate='$appoiment_date',FirstAppoinmentDate='$first_appoiment_date',AppoinmentSubject='$appoiment_subject',wnopNumber='$wnop_number',Medium='$medium',Nationality='$nationality',CivilStatus='$civil',PaysheetNumber='$paysheet',status='$options' WHERE idTeacher='$hidden_teacher_id' LIMIT 1";
                            mysqli_query($conn,$update_teacher);
                   }
                   elseif(!empty($user_img) && !isset($options)) 
                   {
                        move_uploaded_file($temp_img1, "img/$user_img");
                          $update_teacher = "UPDATE teacher SET Title='$title',Name='$full_name',Tp='$tp',WhatsappNumber='$wno',Address='$address',NIC='$nic',Gender='$gender',ServiceGrade='$sg',educationalQualifications='$eq',professionalQualifications='$pq',AppoinmentDate='$appoiment_date',FirstAppoinmentDate='$first_appoiment_date',AppoinmentSubject='$appoiment_subject',wnopNumber='$wnop_number',image='$user_img',Medium='$medium',Nationality='$nationality',CivilStatus='$civil',PaysheetNumber='$paysheet' WHERE idTeacher='$hidden_teacher_id' LIMIT 1";
                          mysqli_query($conn,$update_teacher);    

                   }
                   elseif(empty($user_img) && !isset($options)) 
                   {
                          $update_teacher = "UPDATE teacher SET Title='$title',Name='$full_name',Tp='$tp',WhatsappNumber='$wno',Address='$address',NIC='$nic',Gender='$gender',ServiceGrade='$sg',educationalQualifications='$eq',professionalQualifications='$pq',AppoinmentDate='$appoiment_date',FirstAppoinmentDate='$first_appoiment_date',AppoinmentSubject='$appoiment_subject',wnopNumber='$wnop_number',Medium='$medium',Nationality='$nationality',CivilStatus='$civil',PaysheetNumber='$paysheet' WHERE idTeacher='$hidden_teacher_id' LIMIT 1";
                          mysqli_query($conn,$update_teacher); 
                   }


                   

            }
            else
            {
                 ?><script type="text/javascript">alert("Teacher Update error 1");</script><?php
            }

        }
  
 ?>
<!-- /*================================================end update Teacher ==================================*/ -->














<!-- =====================================The insert teacher modal ========================================-->
  <div class="modal fade" id="regtr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-lg"   role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title text-white">Teacher Registration Form</h4>
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
              <form action="teacher_register.php" id="mainForm" method="post" enctype="multipart/form-data">

<!-- Login Information -->
                <h3 class="text-success">Login Information</h3>
                <div class="row clearfix">
                        <div class="col-sm-3">
                        </div>
                <div class="col-sm-6">

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="User Name" name="user_name" required data-parsley-pattern="^[a-zA-Z0-9 ]+$" data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email" name="email1" required data-parsley-type="email" data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" id="pw" placeholder="Password" name="password" required data-parsley-length=[8,16] data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required data-parsley-equalto="#pw" data-parsley-trigger="keyup"/>
                    </div>


                    <div class="form-group">
                      <label for="user_type">User Type:</label>
                        <select class="form-control" name="previlages" required>
                         <option selected disabled> Select</option>
                          <option value="1">Admin</option>
                          <option value="2">Modaretor</option>
                          <option value="3">Teacher</option>
                          <option value="4">Student</option>
                        </select>
                    </div>

                     <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter Extra User Permissions" name="ex_previlages" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup"/>
                    </div>

                </div>

                <div class="col-sm-3">
                        </div>
                </div>

                <br>

<!-- Genaral Information -->
                <h3 class="text-success">Personal Information</h3>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <select class="form-control" name="title" required>
                        <option selected disabled> Select</option>
                        <option value="Rev.">Rev.</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Miss.">Miss.</option>
                        <option value="Mrs.">Mrs.</option>
                      </select>
                    </div>
                  </div>


                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="form-line">
                      <input type="text" class="form-control" placeholder="Name with Intials"name="full_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                      </div>
                    </div>
                  </div>


            <div class="col-sm-12">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <select class="form-control" name="gender" required>
                        <option selected disabled> Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <select class="form-control" name="civil" required>
                        <option selected disabled> Civil Status</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Single">Single</option>
                      </select>
                    </div> 
                  </div>
            </div>


            <div class="col-sm-12">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="form-line">
                      <input type="text" class="form-control" placeholder="Nationality" name="nationality" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="National Identity Card Number" name="nic" required data-parsley-pattern="^[0-9Vv]+$" data-parsley-trigger="keyup"/>
                    </div>
                  </div>
            </div>


                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="form-line">
                      <input type="text" class="form-control" placeholder="Telephone Number" name="tp" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="form-line">
                      <label for="wno">Whatsapp No:</label>
                      <input type="text" class="form-control" placeholder="Telephone No (Whatsapp)" name="wno" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" placeholder="Postal Address" name="address" required data-parsley-pattern="^[a-zA-Z0-9 ,.]+$" data-parsley-trigger="keyup"/>
                    </div>
                  </div>


                    <div class="form-group">
                      <label for="image">Profile Image:</label>
                      <input type="file" class="form-control" placeholder="Profile Image" name="p_image">
                    </div>

                <br>

<!-- Professional Information -->
                <h3 class="text-success">Professional Information</h3>

                <div class="form-group col-sm-5">
                  <label for="ap_date">First Appoiment Date</label>
                  <input type="date" class="form-control" placeholder="First Appoiment Date" name="first_appoiment_date" required>
                </div>

                <div class="form-group col-sm-5">
                  <input type="text" class="form-control" placeholder="Appoiment Subject" name="appoiment_subject" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div> 

                <div class="form-group col-sm-5">
                  <select class="form-control" name="medium" required>
                   <option selected disabled> Medium</option>
                    <option value="Sinhala">Sinhala</option>
                    <option value="English">English</option>
                    <option value="Tamil">Tamil</option>
                    <option value="other">Other</option>
                  </select>
                </div>   

                <div class="form-group col-sm-5">
                  <select class="form-control" name="sg" required>
                   <option selected disabled> Service Grade</option>
                    <option value="3 - I">3 - I</option>
                    <option value="2 - II">2 - II</option>
                    <option value="2 - I">2 - I</option>
                    <option value="1">1</option>
                  </select>
                </div> 

                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Enter Education Qualification" name="eq" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Enter Prafessional Qualification" name="pq" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group col-sm-5">
                  <label for="ap_date">Appoiment Date in this school:</label>
                  <input type="date" class="form-control" placeholder="Enter Appoiment Date" name="appoiment_date" required>
                </div> 

                <div class="form-group col-sm-5">
                  <input type="text" class="form-control" placeholder="WNOP No" name="wnop_number" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group col-sm-5">
                  <input type="text" class="form-control" placeholder="Paysheet Number" name="paysheet" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>  

                 <button type="submit" class="btn btn-success float-right" name="register_teacher">REGISTER</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- =================================End insert teacher modal ========================================-->












<!-- ================================= update teacher modal ========================================-->

  <div class="modal fade" id="update_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title text-white">Teacher update Form</h4>
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
              <form action="teacher_register.php" id="mainForm" method="post" enctype="multipart/form-data">

<!-- Personal Information -->
                <h3 class="text-success">Personal Information</h3>

                <div class="form-group">
                  <label for="name">Teacher id:</label>
                  <input type="text" id="teacher_id1" name="idTeacher" class="form-control" placeholder="Enter teacher id" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup" disabled />
                </div>

                 <div class="form-group">
                  <input type="hidden" id="hidden_teacher_id1" name="hidden_teacher_id" class="form-control" placeholder="Enter Full Name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup" />
                </div>


                    <div class="form-group">
                      <label for="title">Title:</label>
                      <select class="form-control" name="title" id="teacher_title1" required>
                        <option selected disabled> Select</option>
                        <option value="Rev.">Rev.</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Miss.">Miss.</option>
                        <option value="Mrs.">Mrs.</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="name">Full Name:</label>
                      <input type="text" class="form-control" placeholder="Full Name" name="full_name" id="teacher_name1" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <select class="form-control" name="gender" id="teacher_gender1" required>
                        <option selected disabled> Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <select class="form-control" name="civil" id="teacher_civil1" required>
                        <option selected disabled> Civil Status</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Single">Single</option>
                      </select>
                    </div> 

                    <div class="form-group">
                      <label for="Nationality">Nationality:</label>
                      <input type="text" class="form-control" placeholder="Nationality" name="nationality" id="teacher_nationality1" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <label for="nic">NIC:</label>
                      <input type="text" class="form-control" placeholder="National Identity Card Number" name="nic" id="teacher_nic1" required data-parsley-pattern="^[0-9Vv]+$" data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <label for="tp">Telephone No:</label>
                      <input type="text" class="form-control" placeholder="Telephone No" name="tp" id="teacher_tp1" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                    </div>
                    <div class="form-group">
                      <label for="wno">Whatsapp No:</label>
                      <input type="text" class="form-control" placeholder="Whatsapp No" name="wno" id="teacher_whatsapp1" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                    </div>
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" placeholder="Address" name="address" id="teacher_address1" required data-parsley-pattern="^[a-zA-Z0-9 ,.]+$" data-parsley-trigger="keyup"/>
                    </div>

                    <div class="form-group">
                      <label for="image">Profile Image:</label>
                      <input type="file" class="form-control" placeholder="Profile Image" name="p_image">
                    </div>


                <br>

<!-- Professional Information -->
                <h3 class="text-success">Professional Information</h3>

                <div class="form-group">
                  <label for="fap_date">First Appointment Date:</label>
                  <input type="date" class="form-control" placeholder="First Appoiment Date" name="first_appoiment_date" id="teacher_fad1" required>
                </div>
                <div class="form-group">
                  <label for="a_subject">Appoiment Subject:</label>
                  <input type="text" class="form-control" placeholder="Appoiment Subject" name="appoiment_subject" id="teacher_as1" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                </div> 
                <div class="form-group">
                  <select class="form-control" name="medium" id="teacher_medium1" required>
                   <option selected disabled> Medium</option>
                    <option value="Sinhala">Sinhala</option>
                    <option value="English">English</option>
                    <option value="Tamil">Tamil</option>
                    <option value="other">Other</option>
                  </select>
                </div>                 
                <div class="form-group">
                  <select class="form-control" name="sg" id="teacher_sg1" required>
                   <option selected disabled> Service Grade</option>
                    <option value="3 - I">3 - I</option>
                    <option value="2 - II">2 - II</option>
                    <option value="2 - I">2 - I</option>
                    <option value="1">1</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="eq">Educational Qualification:</label>
                  <input type="text" class="form-control" placeholder="Education Qualification" name="eq" id="teacher_eq1" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="pq">Professional Qualification:</label>
                  <input type="text" class="form-control" placeholder="Professional Qualification" name="pq" id="teacher_pq1" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                </div>

                <div class="form-group">
                  <label for="ap_date">Appointment Date in this school:</label>
                  <input type="date" class="form-control" placeholder="Enter Appoiment Date" name="appoiment_date" id="teacher_ad1" required>
                </div> 

                <div class="form-group">
                  <label for="wnopNumber">Wnop No:</label>
                  <input type="text" class="form-control" placeholder="Wnop No" name="wnop_number" id="teacher_wnop1" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>
                <div class="form-group">
                  <label for="PaysheetNumber">Paysheet Number:</label>
                  <input type="text" class="form-control" placeholder="Paysheet Number" name="paysheet" id="teacher_paysheet1" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                </div>  

                <div class="form-group">                      
                                             
                      <div class="col-md-6">        
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-success ">
                                        <input type="radio" id="approve1" name="options" value="1" autocomplete="off"> 
                                        <B>APPROVE</B>
                                        </label>

                                        <label class="btn btn-outline-danger">
                                        <input type="radio" id="approve1" name="options" value="0" autocomplete="off"> 
                                        <B>DECLINE</B>
                                        </label>
                                    </div>
                      </div>


                </div> 
                 <button type="submit" class="btn btn-success float-right" name="update_teacher"  onclick="return confirm('Do You Want To Update Teacher');">UPDATE TEACHER DETAILS</button>
              </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- ================================= end update teacher modal ========================================-->











<!-- ================================= view teacher details modal ========================================-->
<div class="modal fade" id="view_teacher_details">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-success">
          <h4 class="modal-title text-white">Teacher Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="teacher_view">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- ================================= end view teacher details modal ====================================-->







  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#regtr">
        Register New Teacher
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
                      <th>Title</th>
                      <th>Name</th>
                      <th>Whatsapp No</th>
                      <th>NIC</th>
                      <th>Gender</th>
                      <th>First Appoiment Date</th>
                      <th>Active</th>
                      <th>Action</th>
                  </tr>
              </thead>

                  <?php 
                            
                      $get_teacher = "SELECT * FROM teacher WHERE delete_status=1 ORDER BY idTeacher DESC";
                                
                      $run_rpro = mysqli_query($conn,$get_teacher);
          
                      while($row_rpro=mysqli_fetch_array($run_rpro))
                      {
                          $idTeacher=$row_rpro['idTeacher'];
                          $Title=$row_rpro['Title'];
                          $name=$row_rpro['Name'];
                          $WhatsappNumber=$row_rpro['WhatsappNumber'];
                          $NIC=$row_rpro['NIC'];
                          $Gender=$row_rpro['Gender'];
                          $FirstAppoinmentDate=$row_rpro['FirstAppoinmentDate'];
                          $status=$row_rpro['status'];

                          if ($status==1) {
                              $st="Active";
                          }else{
                               $st="Inactive";
                          }

                  ?>

              <tbody>
                  <tr>
                      <td>
                        <a class="btn btn-success tview" data-toggle="modal" data-target="#view_teacher_details" data-idview="<?php echo $idTeacher; ?>">View</a>
                      </td>
                      <td><?php echo $idTeacher; ?></td>
                      <td><?php echo $Title; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $WhatsappNumber; ?></td>
                      <td><?php echo $NIC; ?></td>
                      <td><?php echo $Gender; ?></td>
                      <td><?php echo $FirstAppoinmentDate; ?></td>
                      <td><?php echo $st; ?></td>

                  <td>
                    <div class="dropdown">
                      <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item teach" href="teacher_register.php" data-id="<?php echo $idTeacher; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a>

                            <a class="dropdown-item" href="teacher_register.php?delete_id=<?php echo $idTeacher; ?>"  onclick="return confirm('Do You Want To Delete Teacher');"><i class="fa fa-trash"></i> Delete</a>
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

      $('.teach').click(function(){

        var teacherid=$(this).data('id');
        
          $.ajax({

                url:'teacher_details_update_ajax.php',

                type:'post',

                data:{id1:teacherid},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                        $('#teacher_id1').val(d[1]);
                        $('#hidden_teacher_id1').val(d[1]);
                        $('#teacher_title1').val(d[2]);
                        $('#teacher_name1').val(d[3]);
                        $('#teacher_tp1').val(d[4]);
                        $('#teacher_whatsapp1').val(d[5]);
                        $('#teacher_address1').val(d[6]);
                        $('#teacher_nic1').val(d[7]);
                        $('#teacher_gender1').val(d[8]);
                        $('#teacher_sg1').val(d[9]);
                        $('#teacher_eq1').val(d[10]);
                        $('#teacher_pq1').val(d[11]);
                        $('#teacher_ad1').val(d[12]);
                        $('#teacher_fad1').val(d[13]);
                        $('#teacher_as1').val(d[14]);
                        $('#teacher_wnop1').val(d[15]);
                        // $('#teacher_image').val(d[16]);
                        $('#teacher_medium1').val(d[17]);
                        $('#teacher_nationality1').val(d[18]);
                        $('#teacher_civil1').val(d[19]);
                        $('#teacher_paysheet1').val(d[20]);
                       /* $('#approve1').val(d[21]);*/
                    }

            }
          });
    });



     $('.tview').click(function(){

        var idview=$(this).data('idview');
        
          $.ajax({

                url:'teacher_details_view_ajax.php',

                type:'post',

                data:{id1:idview},

                cache: false,

                success:function(response){

                  $('#teacher_view').html(response);

            }
          });
    });

});
</script>