<?php include_once('header.php'); ?>
<?php include_once('db/conn.php'); ?>


<?php 

if (isset($_GET['id1'])) {
        # code...
    
   $id1= mysqli_real_escape_string($conn, $_GET['id1']);

   $update_teacher = "SELECT * FROM student WHERE idStudent='$id1' LIMIT 1";
   $update = mysqli_query($conn,$update_teacher);

    /*idStudent AdmissionNumber name  DOB homeTp  WhatsappNumber  address Gender  Image AdmissionYear  House  currentAddres NIC PreviosSchools  SpecialEducation  Nationality Medium Religeon  MedicleStatus BirthCertificateId  Guardian_idGuardian user_iduser Class_idClass delete_status status */
          
            if($res=mysqli_fetch_array($update))
            {
              
                $idStudent1=$res['idStudent'];
                $AdmissionNumber1=$res['AdmissionNumber'];
                $name1=$res['name'];
                $DOB1=$res['DOB'];
                $homeTp1=$res['homeTp'];
                $WhatsappNumber1=$res['WhatsappNumber'];
                $address1=$res['address'];
                $Gender1=$res['Gender'];
                $Image1=$res['Image'];
                $AdmissionYear1=$res['AdmissionYear'];
                $House1=$res['House'];
                $currentAddres1=$res['currentAddres'];
                $NIC1=$res['NIC'];
                $PreviosSchools1=$res['PreviosSchools'];
                $SpecialEducation1=$res['SpecialEducation'];
                $Nationality1=$res['Nationality'];
                $Medium1=$res['Medium'];
                $Religeon1=$res['Religeon'];
                $BirthCertificateId1=$res['BirthCertificateId'];
                $bank_name1=$res['bank_name'];
                $branch_name1=$res['branch_name'];
                $acc_no1=$res['acc_no'];
                $MedicleStatus1=$res['MedicleStatus'];
                $Guardian_idGuardian1=$res['Guardian_idGuardian'];
                $Rel_Student1=$res['rel_student'];
                $Class_idClass1=$res['Class_idClass'];
                $section_idSection1=$res['section_idSection'];
                $scolership_amount1=$res['scolership_amount'];

            }
    } 





if (isset($_POST['update_student'])) 
{

            $hidden_student_id=mysqli_real_escape_string($conn, $_POST['hidden_student_id']);
            $hidden_admission_no=mysqli_real_escape_string($conn, $_POST['hidden_admission_no']);
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
            $sport_arr=$_POST['sport'];
            $cocurricular=$_POST['cocurricular'];
            $extracurricular=$_POST['extracurricular'];

           

/*idStudent AdmissionNumber name  DOB homeTp  WhatsappNumber  address Gender  Image AdmissionYear  House  currentAddres NIC PreviosSchools  SpecialEducation  Nationality Medium Religeon  MedicleStatus BirthCertificateId  Guardian_idGuardian user_iduser Class_idClass section_idSection  delete_status status */


            if (count($error)==0)
            {

              $options_value="";
              if (isset($_POST['options'])) {
                  $options=mysqli_real_escape_string($conn, $_POST['options']);
                  $options_value=" ,status='$options' ";
                   //echo($options_value);
              }else{
                //echo("C");
              }

              $user_imgage="";
              $temp_img1="";
              $user_img="";
              if (!empty( $_FILES['p_image']['name']) && isset($_FILES['p_image']['name'])) {
                   $user_img = $_FILES['p_image']['name'];
                   $temp_img1 = $_FILES['p_image']['tmp_name'];
                   $user_imgage=" ,Image='$user_img' ";
                   //echo($user_imgage." a");
              }else{
                //echo("b");
              }

  
                        move_uploaded_file($temp_img1, "img/$user_img");
                        $update_stud = "UPDATE student SET name='$full_name',DOB='$dob',homeTp='$tp',WhatsappNumber='$wno',address='$address',Gender='$gender' $user_imgage ,AdmissionYear='$admission_year',House='$house',currentAddres='$current_address',NIC='$nic',PreviosSchools='$ps',SpecialEducation='$se',Nationality='$nationality',Medium='$medium',Religeon='$religeon',MedicleStatus='$medical',BirthCertificateId='$bc_id',bank_name='$bank_name',branch_name='$branch_name',acc_no='$acc_no',scolership_amount='$scholar_amount',Guardian_idGuardian='$guardian',rel_student='$relaion',Class_idClass='$class1',section_idSection='$secsion1' $options_value WHERE idStudent='$hidden_student_id' LIMIT 1";
                          if (mysqli_query($conn,$update_stud)) {

                            //co curriculam
                              $get_sport = "SELECT * FROM sports_has_student WHERE Student_idStudent='$hidden_student_id'";
                              $res2 = mysqli_query($conn,$get_sport);

                              $Sports_idSports1=[];
                              foreach ($res2 as $list) {
                                 $Sports_idSports1[] = $list['Sports_idSports'];
                              }

                              foreach ($sport_arr as $sport_id1) {
                                 if(!in_array($sport_id1, $Sports_idSports1)){
                                    //echo $sport_id1."inserted ";
                                  $sql_sport="INSERT INTO sports_has_student(Sports_idSports,Student_idStudent, Student_AdmissionNumber)VALUES('$sport_id1','$hidden_student_id','$hidden_admission_no')";
                                  mysqli_query($conn,$sql_sport);
                                 }
                              }

                              foreach ($Sports_idSports1 as $val) {
                                 if(!in_array($val, $sport_arr)){
                                    //echo $val."delete ";
                                  $delte_sport="DELETE FROM sports_has_student WHERE Sports_idSports='$val' AND Student_idStudent='$hidden_student_id'";
                                  mysqli_query($conn,$delte_sport);
                                 }
                              }

                              //co-curricular activity
                              $get_co = "SELECT * FROM student_has_corecurricularactivities WHERE Student_idStudent='$hidden_student_id'";
                              $res3 = mysqli_query($conn,$get_co);

                              $cor_curicular_arr=[];
                              foreach ($res3 as $list1) {
                                 $cor_curicular_arr[] = $list1['CoreCurricularActivities_idCurricularActivities'];
                              }

                              foreach ($cocurricular as $co_id) {
                                 if(!in_array($co_id, $cor_curicular_arr)){
                                    //echo $sport_id1."inserted ";
                                  $sql_co="INSERT INTO student_has_corecurricularactivities(CoreCurricularActivities_idCurricularActivities,Student_idStudent, Student_AdmissionNumber)VALUES('$co_id','$hidden_student_id','$hidden_admission_no')";
                                  mysqli_query($conn,$sql_co);
                                 }
                              }

                              foreach ($cor_curicular_arr as $res) {
                                 if(!in_array($res, $cocurricular)){
                                    //echo $val."delete ";
                                  $delte_co="DELETE FROM student_has_corecurricularactivities WHERE CoreCurricularActivities_idCurricularActivities='$res' AND Student_idStudent='$hidden_student_id'";
                                  mysqli_query($conn,$delte_co);
                                 }
                              }


                               //extra curricular activity
                              $get_extra = "SELECT * FROM student_has_extracurricularactivities WHERE Student_idStudent='$hidden_student_id'";
                              $res4 = mysqli_query($conn,$get_extra);

                              $extra_curicular_arr=[];
                              foreach ($res4 as $list2) {
                                 $extra_curicular_arr[] = $list2['ExtraCurricularActivities_idActivities'];
                              }

                              foreach ($extracurricular as $extra_input_id) {
                                 if(!in_array($extra_input_id, $extra_curicular_arr)){
                                    //echo $sport_id1."inserted ";
                                  $sql_extra="INSERT INTO student_has_extracurricularactivities(ExtraCurricularActivities_idActivities,Student_idStudent, Student_AdmissionNumber)VALUES('$extra_input_id','$hidden_student_id','$hidden_admission_no')";
                                  mysqli_query($conn,$sql_extra);
                                 }
                              }

                              foreach ($extra_curicular_arr as $extra_db_id) {
                                 if(!in_array($extra_db_id, $extracurricular)){
                                    //echo $val."delete ";
                                  $delte_extra="DELETE FROM student_has_extracurricularactivities WHERE ExtraCurricularActivities_idActivities='$extra_db_id' AND Student_idStudent='$hidden_student_id'";
                                  mysqli_query($conn,$delte_extra);
                                 }
                              }

                          echo "<script>window.open('student_registration.php','_self')</script>";
                          exit();
                          } 

            }
            else
            {
                 ?><script type="text/javascript">alert("Student Update error 1");</script><?php
            }

        }              


 ?>

        <div class="row">
                    <div class="col-sm-12">
                      <form action="" id="mainForm" method="post" class="f1" style="width: 99.9%;" enctype="multipart/form-data">


                        <!-- ============================================================================== -->
        <div class="bg-success">
          <h3 class="text-white text-center">STUDENT DETAILS UPDATE</h3>
      </div>
        <br>
                        
                     
                            <h3 class="text-success">Personal Information</h3><hr>
                            <div class="row form-group"> 
                               <div class="col-12">                     
                                <label class="col-md-3 control-label"> Approvement</label>                       
                                <div class="col-md-6">        
                                             <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                  <label class="btn btn-outline-success ">
                                                  <input type="radio" id="approve1" name="options" value="1" autocomplete="off"> 
                                                  Approve
                                                  </label>

                                                  <label class="btn btn-outline-danger">
                                                  <input type="radio" id="approve1" name="options" value="0" autocomplete="off"> Dicline
                                                  </label>
                                              </div>
                                </div>                   
                             </div>
                             </div>

                             <div class="row form-group">  
                                <div class="col-6">
                                  <label for="name">Full Name:</label>
                                  <input type="text" class="form-control" value="<?php echo($name1); ?>" placeholder="Enter Full Name" name="full_name" id="full_name" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                 <div class="form-group">
                                  <label for="dob">Date of birth:</label>
                                  <input type="date" class="form-control" value="<?php echo($DOB1); ?>" placeholder="Enter Date of birth" name="dob" id="dob" required>
                                </div>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col-6">
                                  <label for="tp">Telephone No:</label>
                                  <input type="text" class="form-control" value="<?php echo($homeTp1); ?>" placeholder="Enter Telephone No" name="tp" id="tp" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="wno">Whatsapp No:</label>
                                  <input type="text" class="form-control" value="<?php echo($WhatsappNumber1); ?>" placeholder="Enter Whatsapp No" name="wno" id="wno"  required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                  <label for="address">Address:</label>
                                  <input type="text" class="form-control" value="<?php echo($address1); ?>" placeholder="Enter Address" name="address" id="address" required data-parsley-pattern="^[a-zA-Z0-9 ,.]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="current_address">Current Address:</label>
                                  <input type="text" class="form-control" value="<?php echo($currentAddres1); ?>" placeholder="Enter Current Address" name="current_address" id="current_address" required data-parsley-pattern="^[a-zA-Z0-9 ,.]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                 <div class="row form-group">
                                    <div class="col-6">
                                    <label for="title">Gender:</label>
                                    <select class="form-control" name="gender" id="gender" required>
                                      <option selected disabled> Select</option>
                                      <option value="male" <?php if($Gender1=='male'){echo "selected";} ?>>Male</option>
                                      <option value="female" <?php if($Gender1=='female'){echo "selected";} ?>>Female</option>
                                    </select>
                                  </div>
                                  <div class="col-6">
                                      <label for="image">Profile Image:</label>
                                      <input type="file" class="form-control" placeholder="Add Profile Image" name="p_image" id="p_image" />
                                  </div>
                              </div>
                               <div class="row form-group">
                                  <div class="col-6">
                                   <label for="nic">NIC:</label>
                                   <input type="text" class="form-control" value="<?php echo($NIC1); ?>" placeholder="Enter NIC" name="nic" id="nic" data-parsley-pattern="^[0-9Vv]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                  <label for="wnopNumber">Birth Certificate id:</label>
                                  <input type="text" class="form-control" value="<?php echo($BirthCertificateId1); ?>" placeholder="Enter Birth Certificat id" name="bc_id" id="bc_id" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                </div>
                              </div>
                                 <div class="row form-group">
                                   <div class="col-6">
                                    <label for="Nationality">Nationality:</label>
                                    <input type="text" class="form-control" value="<?php echo($Nationality1); ?>" placeholder="Enter Nationality" name="nationality" id="nationality" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                   </div>
                                 <div class="col-6">
                                    <label for="guardian" >Guardian:</label>
                                    <img src="img/1.png" id="loader">&nbsp;&nbsp;
                                    <a href="guardian_registration.php" target="_blank">New</a>
                                     <div id="load1">
                                     <select  name="guardian" id="guardian" class="form-control" required>
                                                    
                                            <?php
                                                                            
                                               $get_cat = "SELECT * FROM guardian";
                                               $run_cat = mysqli_query($conn, $get_cat);
                                                                                                    
                                                while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                      $idGuardian = $row_cat['idGuardian'];
                                                      $Name = $row_cat['Name'];
                                                                 
                                               ?>     
                                                <option value='<?php echo($idGuardian); ?>'<?php if($idGuardian==$Guardian_idGuardian1){echo('selected');} ?>><?php  echo($Name);?> </option>";                                  
                                             <?php  }  ?>           
                                       </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="rwo">Relationship with student:</label>
                                      <input type="text" class="form-control" value="<?php echo($Rel_Student1); ?>" placeholder="Relationship with occupatin" name="relaion" id="relaion" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>

                            <!-- ========================================================================== -->





                            <!-- ============================================================================== -->
                            
                                <h3 class="text-success">Admission Information</h3><hr>
                                <div class="form-group">
                                  <input type="hidden" class="form-control" value="<?php echo($idStudent1); ?>" placeholder="Enter Subject id" name="hidden_student_id" id="hidden_student_id" required>
                                </div>
                                <div class="form-group">
                                  <input type="hidden" class="form-control" value="<?php echo($AdmissionNumber1); ?>" placeholder="Enter Admission No" name="hidden_admission_no" id="hidden_admission_no" required />
                                </div>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="stubent_id">Stubent id:</label>
                                    <input type="text" class="form-control" value="<?php echo($idStudent1); ?>" placeholder="Enter Stubent id" name="stubent_id" id="stubent_id" disabled />
                                </div>
                                 <div class="col-6">
                                    <label for="admission_no">Admission No:</label>
                                    <input type="text" class="form-control" value="<?php echo($AdmissionNumber1); ?>" placeholder="Enter Admission No" name="admission_no" id="admission_no" required disabled />
                              </div>
                            </div>
                            <div class="row form-group">
                               <div class="col-6">
                                  <label for="sg">Admission Year:</label>
                                  <input type="text" class="form-control" value="<?php echo($AdmissionYear1); ?>" placeholder="Enter Admission Year" name="admission_year" id="admission_year" required data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup"/>
                                </div>
                              <div class="col-6">
                                    <label for="house">House:</label>
                                    <input type="text" class="form-control" value="<?php echo($House1); ?>" placeholder="Enter Student House" name="house" id="house" required data-parsley-pattern="^[a-zA-Z. ]+$" data-parsley-trigger="keyup"/>
                              </div>
                          </div>
                            <div class="row form-group">
                              <div class="col-6">
                              <label for="ps">Provins Schools:</label>
                              <input type="text" class="form-control" value="<?php echo($PreviosSchools1); ?>" placeholder="Enter Provins Schools" name="ps" id="ps" data-parsley-pattern="^[a-zA-Z./, ]+$" data-parsley-trigger="keyup"/>
                            </div>
                            <div class="col-6">
                              <label for="se">Specian Education :</label>
                              <input type="text" class="form-control" value="<?php echo($SpecialEducation1); ?>" placeholder="Enter Specian Education" name="se" id="se" data-parsley-pattern="^[a-zA-Z./, ]+$" data-parsley-trigger="keyup"/>
                            </div>
                          </div>
                            <div class="row form-group">
                              <div class="col-6">
                              <label for="medium">Medium:</label>
                              <select class="form-control" name="medium" id="medium" required>
                                <option value="Sinhala" <?php if($Medium1=='Sinhala'){echo "selected";} ?>>Sinhala</option>
                                <option value="English" <?php if($Medium1=='English'){echo "selected";} ?>>English</option>
                                <option value="Tamil" <?php if($Medium1=='Tamil'){echo "selected";} ?>>Tamil</option>
                                <option value="other" <?php if($Medium1=='Other'){echo "selected";} ?>>Other</option>
                              </select>
                            </div>

                            <div class="col-6">
                              <label for="Religeon">Religeon:</label>
                              <input type="text" value="<?php echo($Religeon1); ?>" class="form-control" placeholder="Enter Religeon" name="religeon" id="religeon" required data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                            </div>
                          </div>
                            <div class="row form-group">
                              <div class="col-6">
                              <label for="ms">Medical Status:</label>
                              <input type="text" class="form-control" value="<?php echo($MedicleStatus1); ?>" placeholder="Enter Medical Status" name="medical" id="medical" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-trigger="keyup"/>
                            </div>  


                           <div class="col-6">
                              <label for="class1" >Class:</label>
                                <select  name="class1" id="class1" class="form-control" required>
                                
                                          <?php
                                                        
                                                $get_cat = "SELECT * FROM class";
                                                $run_cat = mysqli_query($conn, $get_cat);
                                                                                
                                                while ($row_cat=mysqli_fetch_array($run_cat)) {
                                                    $idClass = $row_cat['idClass'];
                                                    $Name = $row_cat['Name'];
                                                      
                                                ?>     
                                                <option value='<?php echo($idClass); ?>'  <?php if($idClass==$Class_idClass1){echo('selected');} ?> ><?php  echo($Name);?> </option>";                                  
                                               <?php  }  ?>      
                                 </select>
                            </div>
                          </div>


                            <div class="row form-group">
                              <div class="col-12">
                                  <label for="class1" >Section:</label>
                                    <select  name="secsion1" id="secsion1" class="form-control" required>
                                    
                                              <?php
                                                            
                                                    $get_cat1 = "SELECT * FROM section";
                                                    $run_cat1 = mysqli_query($conn, $get_cat1);
                                                                                    
                                                    while ($row_cat1=mysqli_fetch_array($run_cat1)) {
                                                        $idSection = $row_cat1['idSection'];
                                                        $sectionName = $row_cat1['sectionName'];
                                                     ?>     
                                                           <option value='<?php echo($idSection); ?>' <?php if($idSection==$section_idSection1){echo('selected');} ?>><?php  echo($sectionName);?> </option>";                                  
                                                   <?php  }  ?>          
                                                      
                                     </select>
                                </div>
                              </div>


                            <!-- ==================================================================================== -->





                            <!-- =============================================================================================== -->
             
                                <h3 class="text-success">Activities</h3><hr>
                                 <div class="form-group">
                                <label for="class1" >Select Sports&nbsp;&nbsp;&nbsp;</label>
                                  <select  name="sport[]" data-placeholder="Select Your Favorite Spotts" class="form-control sl2" multiple required>
                                  
                                            <?php

                                            $get_sport = "SELECT * FROM sports_has_student WHERE Student_idStudent='$id1'";
                                            $res2 = mysqli_query($conn,$get_sport);

                                            $Sports_idSports=[];
                                            while ($r1=mysqli_fetch_array($res2)) {
                                                $Sports_idSports[]=$r1['Sports_idSports'];
                                            }
                                                          
                                                  $get_sport = "SELECT * FROM sports";
                                                  $run_sport = mysqli_query($conn, $get_sport);
                                                                                  
                                                  while ($row_sport=mysqli_fetch_array($run_sport)) {
                                                      $idSports = $row_sport['idSports'];
                                                      $SportName = $row_sport['SportName'];
                                                     ?>
                                                      <option value='<?php echo $idSports ?>' <?php echo in_array($idSports, $Sports_idSports)?'Selected':'' ?>> <?php echo $SportName; ?> </option>
                                                     <?php                                     
                                                  } 
                                            ?>          
                                   </select>
                              </div>
                          <div class="form-group">
                              <label for="class1" >Co-curricular&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <select  name="cocurricular[]" data-placeholder="Select Co-Curricular Activities" id="cocurricular" class="form-control sl2" multiple required>
                                
                                          <?php

                                           $get_co = "SELECT * FROM student_has_corecurricularactivities WHERE Student_idStudent='$id1'";
                                            $res3 = mysqli_query($conn,$get_co);

                                            $cor_activity=[];
                                            while ($r2=mysqli_fetch_array($res3)) {
                                                $cor_activity[]=$r2['CoreCurricularActivities_idCurricularActivities'];
                            }
                                                        
                                                $get_co = "SELECT * FROM corecurricularactivities";
                                                $run_co = mysqli_query($conn, $get_co);
                                                                                
                                                while ($row_co=mysqli_fetch_array($run_co)) {
                                                    $idCurricularActivities = $row_co['idCurricularActivities'];
                                                    $name = $row_co['name'];
                                                    ?>
                                                    <option value='<?php echo $idCurricularActivities ?>' <?php echo in_array($idCurricularActivities, $cor_activity)?'selected':'' ?>> <?php echo $name;?> </option>
                                                   <?php
                                                } 
                                           ?>           
                                 </select>
                            </div>
                              <div class="form-group">
                                  <label for="class1" >Extra-curricular</label>
                                    <select  name="extracurricular[]" data-placeholder="Select Extra-curricular Activities" id="extracurricular" class="form-control sl2" multiple required>
                                    
                                              <?php

                                              $get_extra = "SELECT * FROM student_has_extracurricularactivities WHERE Student_idStudent='$id1'";
                                              $res4 = mysqli_query($conn,$get_extra);

                                              $ectra_curri=[];
                                              while ($r3=mysqli_fetch_array($res4)) {
                                                  $ectra_curri[]=$r3['ExtraCurricularActivities_idActivities'];
                                              }
                                                                          
                                                    $get_extra = "SELECT * FROM extracurricularactivities";
                                                    $run_extra = mysqli_query($conn, $get_extra);
                                                                                    
                                                    while ($row_extra=mysqli_fetch_array($run_extra)) {
                                                        $idActivities = $row_extra['idActivities'];
                                                        $CurricularName = $row_extra['CurricularName'];
                                                        ?>
                                                        <option value='<?php echo $idActivities ?>' <?php echo in_array($idActivities, $ectra_curri)?'selected':'' ?>> <?php echo $CurricularName;?> </option>
                                                       <?php
                                                    }
                                               ?>           
                                     </select>
                                </div>

                            <!-- ================================================================================== -->




                            <!-- ================================================================================== -->

                                  <h3 class="text-success">Bank Account information</h3><hr>
                                <div class="row form-group">
                                  <div class="col-6">
                                    <label for="bank_name">Bank Name:</label>
                                    <input type="text" class="form-control" value="<?php echo($bank_name1); ?>" placeholder="Enter Bank Name" name="bank_name" id="bank_name" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                  <div class="col-6">
                                    <label for="wnopNumber">Branch Name:</label>
                                    <input type="text" class="form-control" value="<?php echo($branch_name1); ?>" placeholder="Enter Branch Name" name="branch_name" id="branch_name" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                  </div>
                                </div>
                              <div class="row form-group">
                                <div class="col-6">
                                  <label for="wnopNumber">Account No:</label>
                                  <input type="text" class="form-control" value="<?php echo($acc_no1); ?>" placeholder="Enter Account No" name="acc_no" id="acc_no" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                                </div>
                                <div class="col-6">
                                <label for="wnopNumber">Scholarship Amount:</label>
                                <input type="text" class="form-control" value="<?php echo($scolership_amount1); ?>" placeholder="Enter Scholarship Amount" name="scholar_amount" id="scholar_amount" required data-parsley-pattern="^[0-9a-zA-Z]+$" data-parsley-trigger="keyup"/>
                              </div>
                            </div>
    <div class="f1-buttons">
        <button class="btn btn-secondary" type="button" onclick="goBack()">CANCEL</button>
        <button type="submit" class="btn btn-info" onclick="return confirm('Do You Want To Update Student');" name="update_student">Register</button>
    </div>
                            
                            <!-- ================================================================================= -->
                      
                      </form>
                    </div>
                </div>


<?php include_once('footer.php'); ?>

<script type="text/javascript">

  $('#mainForm').parsley();

  $('#loader').click(function(){
      $('#load').load(" #load");
  });


  $(document).ready(function() {
    $(".sl2").select2({
        //maximumSelectionLength: 2
    });
  });


    function goBack() {
      window.history.back();
    }


</script>