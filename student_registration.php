<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>


<?php 
/*================================================Teacher Register==================================*/
if (isset($_POST['register_student'])) 
{

            $email1=mysqli_real_escape_string($conn, $_POST['email1']);
            $user_name=mysqli_real_escape_string($conn, $_POST['user_name']);
            $password=mysqli_real_escape_string($conn, $_POST['password']);
            $previlages=mysqli_real_escape_string($conn, $_POST['previlages']);
            $ex_previlages=mysqli_real_escape_string($conn, $_POST['ex_previlages']);

            $admission_no=mysqli_real_escape_string($conn, $_POST['admission_no']);
            $full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
            $dob=mysqli_real_escape_string($conn, $_POST['dob']);
            $tp=mysqli_real_escape_string($conn, $_POST['tp']);
            $wno=mysqli_real_escape_string($conn, $_POST['wno']);
            $address=mysqli_real_escape_string($conn, $_POST['address']);
            $current_address=mysqli_real_escape_string($conn, $_POST['current_address']);
            $gender=mysqli_real_escape_string($conn, $_POST['gender']);
            $admission_year=mysqli_real_escape_string($conn, $_POST['admission_year']);
            $house=mysqli_real_escape_string($conn, $_POST['house']);
            $nic=mysqli_real_escape_string($conn, $_POST['nic']);
            $ps=mysqli_real_escape_string($conn, $_POST['ps']);
            $se=mysqli_real_escape_string($conn, $_POST['se']);
            $nationality=mysqli_real_escape_string($conn, $_POST['nationality']);
            $medium=mysqli_real_escape_string($conn, $_POST['medium']);
            $religeon=mysqli_real_escape_string($conn, $_POST['religeon']);
            $medical=mysqli_real_escape_string($conn, $_POST['medical']);
            $bc_id=mysqli_real_escape_string($conn, $_POST['bc_id']);
            $bank_name=mysqli_real_escape_string($conn, $_POST['bank_name']);
            $branch_name=mysqli_real_escape_string($conn, $_POST['branch_name']);
            $acc_no=mysqli_real_escape_string($conn, $_POST['acc_no']);
            $scholar_amount=mysqli_real_escape_string($conn, $_POST['scholar_amount']);
            $guardian=mysqli_real_escape_string($conn, $_POST['guardian']);
            $relaion=mysqli_real_escape_string($conn, $_POST['relaion']);
            $class1=mysqli_real_escape_string($conn, $_POST['class1']);
            $secsion1=mysqli_real_escape_string($conn, $_POST['secsion1']);
            $sport=$_POST['sport'];
            $cocurricular=$_POST['cocurricular'];
            $extracurricular=$_POST['extracurricular'];

            $user_img = $_FILES['p_image']['name'];
            $temp_img1 = $_FILES['p_image']['tmp_name'];

            $epw=sha1($password);

            /*iduser  userName  password  email extra_previlages  previlages_idpre*/
            $sql_select="SELECT * FROM user WHERE userName='$user_name' OR email='$email1' LIMIT 1";
            $result=mysqli_query($conn, $sql_select);
            $user=mysqli_fetch_array($result);

            $sql_select2="SELECT * FROM student WHERE NIC='$nic' OR AdmissionNumber='$admission_no' OR BirthCertificateId='$bc_id' LIMIT 1";
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
                if ($user2['AdmissionNumber']===$admission_no)
                 {
                    array_push($error, "<br>Admission No already exists");
                }
                if ($user2['BirthCertificateId']===$bc_id)
                 {
                    array_push($error, "<br>Birth Certificate id already exists");
                }
                 if ($user2['acc_no']===$acc_no)
                 {
                    array_push($error, "<br>Account No already exists");
                }
            }


            if (count($error)==0)
            {

             
/*iduser  first_name  last_name  email  userName  password  extra_previlages  previlages_idprevilages  delete_status  status*/


               $sql="INSERT INTO user(email,userName,password,extra_previlages,previlages_idprevilages,delete_status,status) VALUES('$email1','$user_name','$epw','$ex_previlages','$previlages',1,0)";

                if(mysqli_query($conn,$sql))
                {
                    $uid= mysqli_insert_id($conn);


                   if (isset($user_img)) 
                   {
                      move_uploaded_file($temp_img1, "img/$user_img");


/*idStudent AdmissionNumber name  DOB homeTp  WhatsappNumber  address Gender  Image AdmissionYear  House  currentAddres NIC PreviosSchools  SpecialEducation  Nationality Medium Religeon  MedicleStatus BirthCertificateId  Guardian_idGuardian user_iduser Class_idClass delete_status status */ 


                      $sql_student="INSERT INTO student(AdmissionNumber, name,  DOB, homeTp,  WhatsappNumber,  address, Gender,  Image, AdmissionYear,  House,  currentAddres, NIC, PreviosSchools,  SpecialEducation,  Nationality, Medium, Religeon,  MedicleStatus, BirthCertificateId,bank_name,branch_name,acc_no,scolership_amount,  Guardian_idGuardian, rel_student, user_iduser, Class_idClass,section_idSection, delete_status, status)VALUES('$admission_no','$full_name','$dob','$tp','$wno','$address','$gender','$user_img','$admission_year','$house','$current_address','$nic','$ps','$se','$nationality','$medium','$religeon','$medical','$bc_id','$bank_name','$branch_name','$acc_no','$scholar_amount','$guardian','$relaion','$uid','$class1','$secsion1',1,0)";

                        if(mysqli_query($conn,$sql_student))
                        {
                               $sid= mysqli_insert_id($conn);
                              /*  Sports_idSports Student_idStudent Student_AdmissionNumber 
*/
                               foreach ($sport as $sport_id) {
                                  $sql_sport="INSERT INTO sports_has_student(Sports_idSports,Student_idStudent, Student_AdmissionNumber)VALUES('$sport_id','$sid','$admission_no')";
                                  mysqli_query($conn,$sql_sport);
                               }

                               /* CoreCurricularActivities_idCurricularActivities Student_idStudent Student_AdmissionNumber 
*/
                                foreach ($cocurricular as $cor_id) {
                                  $sql_cocurricular="INSERT INTO student_has_corecurricularactivities(CoreCurricularActivities_idCurricularActivities,Student_idStudent,Student_AdmissionNumber)VALUES('$cor_id','$sid','$admission_no')";
                                  mysqli_query($conn,$sql_cocurricular);
                               }

                               foreach ($extracurricular as $extra_id) {
                                  $sql_extracurricular="INSERT INTO student_has_extracurricularactivities(ExtraCurricularActivities_idActivities,Student_idStudent,Student_AdmissionNumber)VALUES('$extra_id','$sid','$admission_no')";
                                  mysqli_query($conn,$sql_extracurricular);
                               }

                                ?><script type="text/javascript">alert("student Registerd");</script><?php
                        }
                        else
                        {
                          ?><script type="text/javascript">alert("student Register error");</script><?php
                        }

                   }
                   else
                   {

                    $sql_student="INSERT INTO student(AdmissionNumber, name,  DOB, homeTp,  WhatsappNumber,  address, Gender, AdmissionYear,  House,  currentAddres, NIC, PreviosSchools,  SpecialEducation,  Nationality, Medium, Religeon,  MedicleStatus, BirthCertificateId,bank_name,branch_name,acc_no,scolership_amount,  Guardian_idGuardian,, rel_student user_iduser, Class_idClass, delete_status, status)VALUES('$admission_no','$full_name','$dob','$tp','$wno','$address','$gender','$admission_year','$house','$current_address','$nic','$ps','$se','$nationality','$medium','$religeon','$medical','$bc_id','$bank_name','$branch_name','$acc_no','$scholar_amount','$guardian','$relaion','$uid','$class1',1,0)";

                        if(mysqli_query($conn,$sql_student))
                        {
                              $sid= mysqli_insert_id($conn);
                              /*  Sports_idSports Student_idStudent Student_AdmissionNumber 
*/
                               foreach ($sport as $sport_id) {
                                  $sql_sport="INSERT INTO sports_has_student(Sports_idSports,Student_idStudent, Student_AdmissionNumber )VALUES('$sport_id','$$sid','$admission_no')";
                                  mysqli_query($conn,$sql_sport);
                               }

                               /* CoreCurricularActivities_idCurricularActivities Student_idStudent Student_AdmissionNumber 
*/
                                foreach ($cocurricular as $cor_id) {
                                  $sql_cocurricular="INSERT INTO student_has_corecurricularactivities(CoreCurricularActivities_idCurricularActivities,Student_idStudent,Student_AdmissionNumber)VALUES('$cor_id','$$sid','$admission_no')";
                                  mysqli_query($conn,$sql_cocurricular);
                               }

                               foreach ($extracurricular as $extra_id) {
                                  $sql_extracurricular="INSERT INTO student_has_extracurricularactivities(ExtraCurricularActivities_idActivities,Student_idStudent,Student_AdmissionNumber)VALUES('$extra_id','$$sid','$admission_no')";
                                  mysqli_query($conn,$sql_extracurricular);
                               }

                                ?><script type="text/javascript">alert("student Registerd");</script><?php
                        }
                        else
                        {
                          ?><script type="text/javascript">alert("student Register error");</script><?php
                        }
                   }

            }
            else
            {
                 ?><script type="text/javascript">alert("student Register error 1");</script><?php
            }
        }
        else
        {
               ?><script type="text/javascript">alert("Some Fields already exit");</script><?php
        }
}

/*=============================================================end Teacher Register==================================*/










/*================================================delete Teacher ==================================*/
    if (isset($_GET['delete_id'])) 
    {
        $id=mysqli_real_escape_string($conn,$_GET['delete_id']);



/*idStudent AdmissionNumber name  DOB homeTp  WhatsappNumber  address Gender  Image AdmissionYear  House  currentAddres NIC PreviosSchools  SpecialEducation  Nationality Medium Religeon  MedicleStatus BirthCertificateId  Guardian_idGuardian user_iduser Class_idClass delete_status status */


         $get_teacher = "SELECT user_iduser FROM student WHERE idStudent='$id' LIMIT 1";
          $run = mysqli_query($conn,$get_teacher);
          
              if($row_rpro=mysqli_fetch_array($run))
              {
                  $user_iduser=$row_rpro['user_iduser'];
              }

         $sql="UPDATE user SET delete_status = 0 WHERE iduser='$user_iduser'";

        if (mysqli_query($conn,$sql))
        {
           $sql="UPDATE student SET delete_status = 0 WHERE idStudent='$id'";
           mysqli_query($conn,$sql);
           echo "<script>window.open('student_registration.php','_self')</script>";
        }
    }


/*================================================end delete Teacher ==================================*/


     
 ?>















<!-- =====================================The insert teacher modal ========================================-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title text-white">Registration Form</h4>
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

                       <form action="student_registration.php" class="f1" id="mainForm" method="post" enctype="multipart/form-data">

                        <!-- =================================================================================== -->
                      
                        <fieldset>
                            <h2 class="text-success">Login information:</h2><hr>
                                <div class=" row form-group">
                                  <div class="col-6">
                                    <label for="user_name">User Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter User Name" name="user_name" required data-parsley-pattern="^[a-zA-Z0-9 ]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                 <div class="col-6">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email1" required data-parsley-type="email" data-parsley-trigger="keyup"/>
                                 </div>
                              </div>
                                <div class="row form-group">
                                   <div class="col-6">
                                      <label for="password">Password:</label>
                                      <input type="password" class="form-control" id="pw" placeholder="Enter Password" name="password" required data-parsley-length=[8,16] data-parsley-trigger="keyup"/>
                                  </div>
                                  <div class="col-6">
                                      <label for="confirm_password">Confirm Password:</label>
                                      <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required data-parsley-equalto="#pw" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>

                                <div class="row form-group">
                                  <div class="col-4">
                                    <label for="user_type">User Type:</label>&nbsp
                                      <select class="form-control" name="previlages" required>
                                       <option selected disabled> Select</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Modaretor</option>
                                        <option value="3">Teacher</option>
                                        <option value="4">Student</option>
                                      </select>
                                  </div>
                                  <div class="col-8">
                                      <label for="exp">Extra User Permissions:</label>
                                      <input type="text" class="form-control" placeholder="Enter Extra User Permissions" name="ex_previlages" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
                            <!-- =================================================================================== -->





                            <!-- =================================================================================== -->
                            <fieldset>
                                <h3 class="text-success">Personal Information</h3><hr>
                                <div class="row form-group">
                                   <div class="col-6">
                                      <label for="name">Full Name:</label>
                                      <input type="text" class="form-control" placeholder="Enter Full Name"name="full_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                  <div class="col-6">
                                      <label for="dob">Date of birth:</label>
                                      <input type="date" class="form-control" placeholder="Enter Date of birth" name="dob" required>
                                  </div>
                                </div>
                                <div class="row form-group">
                                   <div class="col-6">
                                      <label for="tp">Telephone No:</label>
                                      <input type="text" class="form-control" placeholder="Enter Telephone No" name="tp" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                   </div>
                                  <div class="col-6">
                                    <label for="wno">Whatsapp No:</label>
                                    <input type="text" class="form-control" placeholder="Enter Whatsapp No" name="wno" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>
                                <div class="row form-group">
                                   <div class="col-6">
                                      <label for="address">Address:</label>
                                      <input type="text" class="form-control" placeholder="Enter Address" name="address" required data-parsley-pattern="^[a-zA-Z0-9 ,.]+$" data-parsley-trigger="keyup"/>
                                    </div>
                                 <div class="col-6">
                                    <label for="current_address">Current Address:</label>
                                    <input type="text" class="form-control" placeholder="Enter Current Address" name="current_address" required data-parsley-pattern="^[a-zA-Z0-9 ,.]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>
                                 <div class="row form-group">
                                     <div class="col-6">
                                        <label for="title">Gender:</label>
                                        <select class="form-control" name="gender" required>
                                          <option selected disabled> Select</option>
                                          <option value="male">Male</option>
                                          <option value="female">Female</option>
                                        </select>
                                      </div>
                                     <div class="col-6">
                                        <label for="image">Profile Image:</label>
                                        <input type="file" class="form-control" placeholder="Add Profile Image" name="p_image">
                                      </div> 
                                  </div>
                                <div class="row form-group">
                                   <div class="col-6">
                                      <label for="nic">NIC:</label>
                                      <input type="text" class="form-control" placeholder="Enter NIC" name="nic" data-parsley-pattern="^[0-9Vv]+$" data-parsley-trigger="keyup"/>
                                    </div>
                                   <div class="col-6">
                                      <label for="wnopNumber">Birth Certificate id:</label>
                                      <input type="text" class="form-control" placeholder="Enter Birth Certificat id" name="bc_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>
                                <div class="row form-group">
                                   <div class="col-4">
                                      <label for="Nationality">Nationality:</label>
                                      <input type="text" class="form-control" placeholder="Enter Nationality" name="nationality" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                   </div>
                                   <div class="col-8">
                                      <div class="form-group">
                                        <label for="guardian" >Guardian:</label>&nbsp;&nbsp;
                                         <img src="img/1.png" id="loader">&nbsp;&nbsp;
                                         <a href="guardian_registration.php" target="_blank">New</a>
                                          <div id="load">
                                          <select  name="guardian" class="form-control" required>
                                              <option selected disabled> Select Guardian</option>
                                          
                                                    <?php
                                                                  
                                                          $get_cat = "SELECT * FROM guardian";
                                                          $run_cat = mysqli_query($conn, $get_cat);
                                                                                          
                                                          while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                              $idGuardian = $row_cat['idGuardian'];
                                                              $Name = $row_cat['Name'];
                                                                                                  
                                                              echo " <option value='$idGuardian'> $Name </option>";
                                                          } ?>           
                                           </select>
                                         </div>
                                      </div>

                                      <div class="form-group">
                                            <label for="rwo">Relationship with student:</label>
                                            <input type="text" class="form-control" placeholder="Relationship with occupatin" name="relaion" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                      </div>
                                    </div>
                                  </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
                            <!-- ===================================================================== -->
                            





                            <!-- ===================================================================== -->
                            <fieldset>
                                <h3 class="text-success">Admission Information:</h3><hr>
                                 <div class="row form-group">
                                   <div class="col-6">
                                      <label for="admission_no">Admission No:</label>
                                      <input type="text" class="form-control" placeholder="Enter Admission No"name="admission_no" required data-parsley-pattern="^[a-zA-Z0-9]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                 <div class="col-6">
                                  <label for="sg">Admission Year:</label>
                                  <input type="text" class="form-control" placeholder="Enter Admission Year" name="admission_year" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                  <label for="house">House:</label>
                                  <input type="text" class="form-control" placeholder="Enter Student House" name="house" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="ps">Provins Schools:</label>
                                  <input type="text" class="form-control" placeholder="Enter Provins Schools" name="ps" data-parsley-pattern="^[a-zA-Z./, ]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="se">Special Education :</label>
                                    <input type="text" class="form-control" placeholder="Enter Specian Education" name="se" data-parsley-pattern="^[a-zA-Z./, ]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="Religeon">Religion:</label>
                                  <input type="text" class="form-control" placeholder="Enter Religeon" name="religeon" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="ms">Medical Status:</label>
                                    <input type="text" class="form-control" placeholder="Enter Medical Status" name="medical" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="medium">Medium:</label>
                                  <select class="form-control" name="medium" required>
                                   <option selected disabled> Select</option>
                                    <option value="Sinhala">Sinhala</option>
                                    <option value="English">English</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="other">Other</option>
                                  </select>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="class1" >Class:</label>
                                      <select  name="class1" class="form-control" required>
                                          <option selected disabled> Select Class</option>
                                      
                                                <?php
                                                              
                                                      $get_cat = "SELECT * FROM class";
                                                      $run_cat = mysqli_query($conn, $get_cat);
                                                                                      
                                                      while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                          $idClass = $row_cat['idClass'];
                                                          $Name = $row_cat['Name'];
                                                                                              
                                                          echo " <option value='$idClass'> $Name </option>";
                                                      } ?>           
                                       </select>
                                </div>

                                 <div class="col-6">
                                  <label for="class1" >Section:</label>
                                    <select  name="secsion1" class="form-control" required>
                                        <option selected disabled> Select Section</option>
                                    
                                              <?php
                                                            
                                                    $get_cat = "SELECT * FROM section";
                                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                                    
                                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                        $idSection = $row_cat['idSection'];
                                                        $sectionName = $row_cat['sectionName'];
                                                                                            
                                                        echo " <option value='$idSection'> $sectionName </option>";
                                                    } ?>           
                                     </select>
                                </div>
                              </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
                          <!-- ============================================================================== -->





                            <!-- ============================================================================== -->
                             <fieldset>
                                <h3 class="text-success">Activities:</h3><hr>
                               <div class="form-group">
                                  <label for="class1" >Select Sports&nbsp;&nbsp;&nbsp;</label>
                                    <select  name="sport[]" data-placeholder="Select Your Favorite Spotts" class="form-control sl2" multiple required>
                                        <!-- <option selected value="0"> None</option> -->
                                    
                                              <?php
                                                            
                                                    $get_sport = "SELECT * FROM sports";
                                                    $run_sport = mysqli_query($conn, $get_sport);
                                                                                    
                                                    while ($row_sport=mysqli_fetch_array($run_sport)) {
                                                        $idSports = $row_sport['idSports'];
                                                        $SportName = $row_sport['SportName'];
                                                                                            
                                                        echo " <option value='$idSports'> $SportName </option>";
                                                    } ?>           
                                     </select>
                                </div>

                                <div class="form-group">
                                  <label for="class1" >Co-curricular&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <select  name="cocurricular[]" data-placeholder="Select Co-Curricular Activities" class="form-control sl2" multiple required>
                                  <!--       <option selected value="0"> None</option> -->
                                    
                                              <?php
                                                            
                                                    $get_co = "SELECT * FROM corecurricularactivities";
                                                    $run_co = mysqli_query($conn, $get_co);
                                                                                    
                                                    while ($row_co=mysqli_fetch_array($run_co)) {
                                                        $idCurricularActivities = $row_co['idCurricularActivities'];
                                                        $name = $row_co['name'];
                                                                                            
                                                        echo " <option value='$idCurricularActivities'> $name </option>";
                                                    } ?>           
                                     </select>
                                </div>
                                <div class="form-group">
                                  <label for="class1" >Extra-curricular</label>
                                    <select  name="extracurricular[]" data-placeholder="Select Extra-curricular Activities" class="form-control sl2" multiple required>
                                       <!--  <option selected value="0"> None</option> -->
                                    
                                              <?php
                                                            
                                                    $get_extra = "SELECT * FROM extracurricularactivities";
                                                    $run_extra = mysqli_query($conn, $get_extra);
                                                                                    
                                                    while ($row_extra=mysqli_fetch_array($run_extra)) {
                                                        $idActivities = $row_extra['idActivities'];
                                                        $CurricularName = $row_extra['CurricularName'];
                                                                                            
                                                        echo " <option value='$idActivities'> $CurricularName </option>";
                                                    } ?>           
                                     </select>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
                            <!-- ============================================================================ -->






                            <!-- =================================================================================== -->
                            <fieldset>
                                <h3 class="text-success">Bank Account information :</h3><hr>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="bank_name">Bank Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="bank_name" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="wnopNumber">Branch Name:</label>
                                  <input type="text" class="form-control" placeholder="Enter Branch Name" name="branch_name" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                  <label for="wnopNumber">Account No:</label>
                                  <input type="text" class="form-control" placeholder="Enter Account No" name="acc_no" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                                 <div class="col-6">
                                  <label for="wnopNumber">Scholarship Amount:</label>
                                  <input type="text" class="form-control" placeholder="Enter Scholarship Amount" name="scholar_amount" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn btn-info" name="register_student">Register</button>
                                </div>
                            </fieldset>
                            <!-- =================================================================================== -->




                             <!-- =================================================================================== -->
                         <!--    <fieldset>
                                <h4>Sibilings Details :</h4><hr>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="bank_name">Bank Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="bank_name" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="wnopNumber">Branch Name:</label>
                                  <input type="text" class="form-control" placeholder="Enter Branch Name" name="branch_name" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                  <label for="wnopNumber">Account No:</label>
                                  <input type="text" class="form-control" placeholder="Enter Account No" name="acc_no" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                                 <div class="col-6">
                                  <label for="wnopNumber">Scholarship Amount:</label>
                                  <input type="text" class="form-control" placeholder="Enter Scholarship Amount" name="scholar_amount" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                     <button type="submit" class="btn btn-info" name="register_student">Register</button>
                                </div>
                            </fieldset> -->
                            <!-- =================================================================================== -->
                      
                      </form>


        </div>

        
      </div>
    </div>
  </div>
<!-- =================================End insert teacher modal ========================================-->










<!-- ================================= view teacher details modal ========================================-->
<div class="modal fade" id="view_student_details">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">All Student Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="student_view">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- ================================= end view teacher details modal ====================================-->








  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        NEW STUDENT
      </button>
      </div>
    </div>
  </div>
<br>

<form action="student_registration.php" method="post">
  <div class="row">
    <div class="col-lg-12">
        <div class="statistic d-flex align-items-center bg-white has-shadow">    
          
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text bg-success">
                    <input type="checkbox" name="admis">
                  </div>
                </div>
                <select  name="search_admission" id="search_admission" class="form-control" required>
                        <option selected disabled>Select Admission No</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM student";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $AdmissionNumber = $row_cat['AdmissionNumber'];
                                                                            
                                        echo " <option value='$AdmissionNumber'> $AdmissionNumber </option>";
                                    } ?>           
                </select>
                &nbsp;&nbsp;&nbsp;


               <div class="input-group-prepend">
                  <div class="input-group-text bg-success">
                    <input type="checkbox" name="sec">
                  </div>
                </div>
                <select  name="search_section" id="search_section" class="form-control" required>
                        <option selected disabled> Select Section</option>
                    
                              <?php
                                            
                                    $get_cat2 = "SELECT * FROM section";
                                    $run_cat2 = mysqli_query($conn, $get_cat2);
                                                                    
                                    while ($row_cat2=mysqli_fetch_array($run_cat2)) {
                                        $idSection = $row_cat2['idSection'];
                                        $sectionName = $row_cat2['sectionName'];
                                                                            
                                        echo " <option value='$idSection'> $sectionName </option>";
                                    } ?>           
                </select>&nbsp;&nbsp;&nbsp;


                <div class="input-group-prepend">
                    <div class="input-group-text bg-success">
                      <input type="checkbox" name="clz">
                    </div>
               </div>
               <select  name="search_class" id="search_class" class="form-control" required>
                        <option selected disabled> Select Class</option>
                    
                              <?php
                                            
                                    $get_cat1 = "SELECT * FROM class";
                                    $run_cat1 = mysqli_query($conn, $get_cat1);
                                                                    
                                    while ($row_cat1=mysqli_fetch_array($run_cat1)) {
                                        $idClass = $row_cat1['idClass'];
                                        $Name = $row_cat1['Name'];
                                                                            
                                        echo " <option value='$idClass'> $Name </option>";
                                    } ?>           
                </select>


            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow float-right">
        <button type="submit" class="btn btn-success" name="search_student">
          VIEW STUDENTS
      </button>
      </div>
    </div>
  </div>
</form>
<br>



     <?php 

         

/*================================================== search student =====================================================*/

            if (isset($_POST['search_student']) && (isset($_POST['search_admission']) && isset($_POST['admis'])) || (isset($_POST['search_class']) && isset($_POST['clz'])) || (isset($_POST['search_section']) && isset($_POST['sec'])))
            {                                                               
/*================================================== search student =====================================================*/

         ?>



  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <table id="example" class="display" style="width:100%">

              <thead>
                  <tr>
                      <th>View Details</th>
                      <th>Student Id</th>
                      <th>Admission No</th>
                      <th>Full Name</th>
                      <th>Whatsapp No</th>
                      <th>Gender</th>
                      <th>Admission Year</th>
                      <th>Active</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>

                <?php 

                  $a = "";

                  if (isset($_POST['admis']) && isset($_POST['search_admission'])) {
                       $search_admission=mysqli_real_escape_string($conn, $_POST['search_admission']);
                       $admission1=" AdmissionNumber='$search_admission' ";
                       $a=$a.$admission1;
                      
                  }

                  if ((isset($_POST['admis']) && isset($_POST['search_admission'])) && (isset($_POST['sec']) && isset($_POST['search_section']))) {
                       $search_section=mysqli_real_escape_string($conn, $_POST['search_section']);
                       $sections=" AND section_idSection='$search_section' ";  
                       $a=$a.$sections;

                  }elseif(isset($_POST['sec']) && isset($_POST['search_section'])){
                       $search_section=mysqli_real_escape_string($conn, $_POST['search_section']);
                       $sections=" section_idSection='$search_section' "; 
                       $a=$a.$sections;
                  }


                  if (((isset($_POST['admis']) && isset($_POST['search_admission'])) || (isset($_POST['sec']) && isset($_POST['search_section']))) && (isset($_POST['clz']) && isset($_POST['search_class']))) {

                      $search_class=mysqli_real_escape_string($conn, $_POST['search_class']);
                      $class1=" AND Class_idClass='$search_class' "; 
                      $a=$a.$class1;

                  }elseif(isset($_POST['clz']) && isset($_POST['search_class'])){
                      $search_class=mysqli_real_escape_string($conn, $_POST['search_class']);
                      $class1=" Class_idClass='$search_class' "; 
                      $a=$a.$class1;
                  }else{
                    
                  }

                  $get_cat1 = "SELECT * FROM student WHERE $a";
                  $run_cat1 = mysqli_query($conn, $get_cat1);

                      
                   /*idStudent AdmissionNumber name  DOB homeTp  WhatsappNumber  address Gender  Image AdmissionYear  House  currentAddres NIC PreviosSchools  SpecialEducation  Nationality Medium Religeon  MedicleStatus BirthCertificateId  Guardian_idGuardian user_iduser Class_idClass delete_status status */
                                                                    
                                    while ($row_cat1=mysqli_fetch_array($run_cat1)) {
                                        $idStudent = $row_cat1['idStudent'];
                                        $AdmissionNumber = $row_cat1['AdmissionNumber'];
                                        $name = $row_cat1['name'];
                                        $WhatsappNumber = $row_cat1['WhatsappNumber'];
                                        $Gender = $row_cat1['Gender'];
                                        $AdmissionYear = $row_cat1['AdmissionYear'];
                                        $status = $row_cat1['status'];


                                        if ($status==1) {
                                            $st="Active";
                                        }else{
                                             $st="Inactive";
                                        }
                 ?>
                  <tr>
                      <td>
                        <a class="btn btn-success sview" data-toggle="modal" data-target="#view_student_details" data-idview="<?php echo $idStudent; ?>">View</a>
                      </td>
                
                      <td><?php echo $idStudent; ?></td>
                      <td><?php echo $AdmissionNumber; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $WhatsappNumber; ?></td>
                      <td><?php echo $Gender; ?></td>
                      <td><?php echo $AdmissionYear; ?></td>
                      <td><?php echo $st; ?></td>

                  <td>
                    <div class="dropdown">
                      <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                            <!-- <a class="dropdown-item student_up" href="student_registration.php" data-id1="<?php echo $idStudent; ?>" data-toggle="modal" data-target="#update_modal"><i class="fa fa-pencil"></i> Edit</a> -->
                             <a class="dropdown-item" href="student_update.php?id1=<?php echo $idStudent; ?>"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item" href="student_registration.php?delete_id=<?php echo $idStudent; ?>"  onclick="return confirm('Do You Want To Delete Student');"><i class="fa fa-trash"></i> Delete</a>
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

<?php } ?>

    
<?php include_once('footer.php'); ?>

<script type="text/javascript">
  
    $(document).ready(function() {
    
      $('#example').DataTable();
      $('#mainForm').parsley();

      $('#loader').click(function(){
          $('#load').load(" #load");
     });

$(".sl2").select2({
  //maximumSelectionLength: 2
});


    $('.student_up').click(function(){

           var std_id=$(this).data('id1');
        
          $.ajax({

                url:'student_details_update_ajax.php',

                type:'post',

                data:{id1:std_id},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                        $('#stubent_id').val(d[1]);
                        $('#hidden_student_id').val(d[1]);
                        $('#admission_no').val(d[2]);
                        $('#full_name').val(d[3]);
                        $('#dob').val(d[4]);
                        $('#tp').val(d[5]);
                        $('#wno').val(d[6]);
                        $('#address').val(d[7]);
                        $('#current_address').val(d[12]);
                        $('#gender').val(d[8]);
                      /*  $('#p_image').val(d[9]);*/
                        $('#admission_year').val(d[10]);
                        $('#house').val(d[11]);
                        $('#nic').val(d[13]);
                        $('#ps').val(d[14]);
                        $('#se').val(d[15]);
                        $('#nationality').val(d[16]);
                        $('#medium').val(d[17]);
                        $('#religeon').val(d[18]);
                        $('#bc_id').val(d[19]);
                        $('#bank_name').val(d[20]);
                        $('#branch_name').val(d[21]);
                        $('#acc_no').val(d[22]);
                        $('#medical').val(d[23]);
                        $('#guardian').val(d[24]);
                        $('#class1').val(d[25]);
                        $('#secsion1').val(d[26]);
                        $('#scholar_amount').val(d[27]);
                        $('#sport').val(d[28]);
                        $('#cocurricular').val(d[29]);
                        $('#extracurricular').val(d[30]);
                    }

            }
          });
    });


     $('.sview').click(function(){

        var idview=$(this).data('idview');
        
          $.ajax({

                url:'student_details_view_ajax.php',

                type:'post',

                // dataType:'json',

                data:{id1:idview},

                cache: false,

                success:function(response){

                  $('#student_view').html(response);

            }
          });
    });

});

</script>