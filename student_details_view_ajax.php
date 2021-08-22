<?php include_once('db/conn.php'); ?>
<?php 


if (isset($_POST['id1'])) {

	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$get_teacher = "SELECT * FROM student WHERE idStudent='$id1' LIMIT 1";
                                
    $res = mysqli_query($conn,$get_teacher);

   /*idStudent AdmissionNumber name  DOB homeTp  WhatsappNumber  address Gender  Image AdmissionYear  House  currentAddres NIC PreviosSchools  SpecialEducation  Nationality Medium Religeon  MedicleStatus BirthCertificateId  Guardian_idGuardian user_iduser Class_idClass delete_status status */

            if($row_rpro=mysqli_fetch_array($res))
            {


                $get_sport = "SELECT * FROM sports_has_student WHERE Student_idStudent='$id1'";
                $res2 = mysqli_query($conn,$get_sport);

                $Sports_idSports=[];
                while ($r1=mysqli_fetch_array($res2)) {
                    $Sports_idSports[]=$r1['Sports_idSports'];
                }
                $Sports_idSports1=json_encode($Sports_idSports);

                $get_co = "SELECT * FROM student_has_corecurricularactivities WHERE Student_idStudent='$id1'";
                $res3 = mysqli_query($conn,$get_co);

                $cor_activity=[];
                while ($r2=mysqli_fetch_array($res3)) {
                    $cor_activity[]=$r2['CoreCurricularActivities_idCurricularActivities'];
                }
                $cor_activity1=json_encode($cor_activity);

                $get_extra = "SELECT * FROM student_has_extracurricularactivities WHERE Student_idStudent='$id1'";
                $res4 = mysqli_query($conn,$get_extra);

                $ectra_curri=[];
                while ($r3=mysqli_fetch_array($res4)) {
                    $ectra_curri[]=$r3['ExtraCurricularActivities_idActivities'];
                } 
                $ectra_curri1=json_encode($ectra_curri);

                        $user_id= $row_rpro['user_iduser'];
                        $get_teacher = "SELECT * FROM user WHERE idUser='$user_id' LIMIT 1";
                        $res1 = mysqli_query($conn,$get_teacher);

                        if ($r=mysqli_fetch_array($res1)) {
                             $email=$r['email'];
                        }


                        $now = time(); // or your date as well
                        $your_date = strtotime($row_rpro['DOB']);
                        $datediff = $now - $your_date;

                        $age =(int)((round($datediff / (60 * 60 * 24)))/365);

                ?>

                    <table border="0" width="100%">
                        <tr>
                            <td style="padding: 20px;">
                                <p>-  Student Id :<?php echo $row_rpro['idStudent'];?></p>
                                <p>-  Admission NO :<?php echo $row_rpro['AdmissionNumber'];?></p>
                                <p>-  Name :<?php echo $row_rpro['name'];?></p>
                                <p>-  DOB :<?php echo $row_rpro['DOB'];?></p>
                                <p>-  Telephone :<?php echo $row_rpro['homeTp'];?></p>
                                <p>-  Whatsapp No :<?php echo $row_rpro['WhatsappNumber'];?></p>
                                <p>-  Address :<?php echo $row_rpro['address'];?></p>
                                <p>-  Current Address :<?php echo $row_rpro['currentAddres'];?></p>
                                <p>-  Email :<?php echo  $email;?></p>
                                <p>-  Gender :<?php echo $row_rpro['Gender'];?></p>
                                <p>-  Admission Year :<?php echo $row_rpro['AdmissionYear'];?></p>
                                <p>-  House :<?php echo $row_rpro['House'];?></p>
                                <p>-  NIC :<?php echo $row_rpro['NIC'];?></p>
                                <p>-  Previos Schools :<?php echo $row_rpro['PreviosSchools'];?></p>
                                <p>-  Special Education :<?php echo $row_rpro['SpecialEducation'];?></p>
                                <p>-  Nationality :<?php echo $row_rpro['Nationality'];?></p>
                                <p>-  Medium :<?php echo $row_rpro['Medium'];?></p>
                                <p>-  Religeon :<?php echo $row_rpro['Religeon'];?></p>
                                <p>-  Medicle Status :<?php echo $row_rpro['MedicleStatus'];?></p>
                                <p>-  Birth Certificate Id :<?php echo $row_rpro['BirthCertificateId'];?></p>
                                <p>-  Bank Name :<?php echo $row_rpro['bank_name'];?></p>
                                <p>-  Branch Name :<?php echo $row_rpro['branch_name'];?></p>
                                <p>-  Account No :<?php echo $row_rpro['acc_no'];?></p>
                                <p>-  Guardian :<?php echo $row_rpro['Guardian_idGuardian'];?></p>
                                <p>-  Relationship with student :<?php echo $row_rpro['rel_student'];?></p>
                                <p>-  User :<?php echo $row_rpro['user_iduser'];?></p>
                                <p>-  Class :<?php echo $row_rpro['Class_idClass'];?></p>
                                <p>-  Age :<?php echo $age;?> years</p>
                                <p>-  Sports :<?php echo ($Sports_idSports1);?></p>
                                <p>-  Co-Curriculam Activities :<?php echo ($cor_activity1);?></p>
                                <p>-  Extra Curriculam Activities :<?php echo ($ectra_curri1);?></p>
                                <p><img src="img/<?php echo $row_rpro['Image'];?>" width="300"></p>
                            </td>
                        </tr>
                        
                    </table>
                <?php
            }
}

 ?>