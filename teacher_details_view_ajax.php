<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$get_teacher = "SELECT * FROM teacher WHERE idTeacher='$id1' LIMIT 1";
                                
    $res = mysqli_query($conn,$get_teacher);

    /*idTeacher Title Name  Tp  WhatsappNumber  Address NIC Gender  ServiceGrade  educationalQualifications professionalQualifications AppoinmentDate  FirstAppoinmentDate AppoinmentSubject wnopNumber  image Medium  Nationality CivilStatus PaysheetNumber  user_iduser delete_status status  */

            if($row_rpro=mysqli_fetch_array($res))
            {

                        $user_id= $row_rpro['user_iduser'];
                        $get_teacher = "SELECT * FROM user WHERE idUser='$user_id' LIMIT 1";
                        $res1 = mysqli_query($conn,$get_teacher);

                        if ($r=mysqli_fetch_array($res1)) {
                             $email=$r['email'];
                        }


                ?>

                    <table border="0" width="100%">
                        <tr>
                            <td style="padding: 20px;">
                                <p>-  Teacher Id :<?php echo $row_rpro['idTeacher'];?></p>
                                <p>-  Title :<?php echo $row_rpro['Title'];?></p>
                                <p>-  Name :<?php echo $row_rpro['Name'];?></p>
                                <p>-  Telephone :<?php echo $row_rpro['Tp'];?></p>
                                <p>-  Whatsapp No :<?php echo $row_rpro['WhatsappNumber'];?></p>
                                <p>-  Address :<?php echo $row_rpro['Address'];?></p>
                                <p>-  NIC :<?php echo $row_rpro['NIC'];?></p>
                                <p>-  Email :<?php echo  $email;?></p>
                                <p>-  Gender :<?php echo $row_rpro['Gender'];?></p>
                                <p>-  Service Grade :<?php echo $row_rpro['ServiceGrade'];?></p>
                                <p>-  Educational Qualifications :<?php echo $row_rpro['educationalQualifications'];?></p>
                                <p>-  Professional Qualifications :<?php echo $row_rpro['professionalQualifications'];?></p>
                                <p>-  Appoinment Date :<?php echo $row_rpro['AppoinmentDate'];?></p>
                                <p>-  First Appoinment Date :<?php echo $row_rpro['FirstAppoinmentDate'];?></p>
                                <p>-  Appoinment Subject :<?php echo $row_rpro['AppoinmentSubject'];?></p>
                                <p>-  wnop Number :<?php echo $row_rpro['wnopNumber'];?></p>
                                <p>-  Medium :<?php echo $row_rpro['Medium'];?></p>
                                <p>-  Nationality :<?php echo $row_rpro['Nationality'];?></p>
                                <p>-  Civil Status :<?php echo $row_rpro['CivilStatus'];?></p>
                                <p>-  Paysheet Number :<?php echo $row_rpro['PaysheetNumber'];?></p>
                                <p>-  User :<?php echo $row_rpro['user_iduser'];?></p>
                                <p><img src="img/<?php echo $row_rpro['image'];?>" width="300"></p>
                            </td>
                        </tr>
                        
                    </table>
                <?php
            }

 ?>