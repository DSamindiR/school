<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_teacher = "SELECT * FROM teacher WHERE idTeacher='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_teacher);

    /*idTeacher Title Name  Tp  WhatsappNumber  Address NIC Gender  ServiceGrade  educationalQualifications professionalQualifications AppoinmentDate  FirstAppoinmentDate AppoinmentSubject wnopNumber  image Medium  Nationality CivilStatus PaysheetNumber  user_iduser delete_status status  */
          
            if($res=mysqli_fetch_array($update))
            {
            	
                $idTeacher=$res['idTeacher'];
                $Title=$res['Title'];
                $Name=$res['Name'];
                $Tp=$res['Tp'];
                $WhatsappNumber=$res['WhatsappNumber'];
                $Address=$res['Address'];
                $NIC=$res['NIC'];
                $Gender=$res['Gender'];
                $ServiceGrade=$res['ServiceGrade'];
                $educationalQualifications=$res['educationalQualifications'];
                $professionalQualifications=$res['professionalQualifications'];
                $AppoinmentDate=$res['AppoinmentDate'];
                $FirstAppoinmentDate=$res['FirstAppoinmentDate'];
                $AppoinmentSubject=$res['AppoinmentSubject'];
                $wnopNumber=$res['wnopNumber'];
                $image=$res['image'];
                $Medium=$res['Medium'];
                $Nationality=$res['Nationality'];
                $CivilStatus=$res['CivilStatus'];
                $PaysheetNumber=$res['PaysheetNumber'];
                $status=$res['status'];

              echo ('1~'.$idTeacher.'~'.$Title.'~'.$Name.'~'.$Tp.'~'.$WhatsappNumber.'~'.$Address.'~'.$NIC.'~'.$Gender.'~'.$ServiceGrade.'~'.$educationalQualifications.'~'.$professionalQualifications.'~'.$AppoinmentDate.'~'.$FirstAppoinmentDate.'~'.$AppoinmentSubject.'~'.$wnopNumber.'~'.$image.'~'.$Medium.'~'.$Nationality.'~'.$CivilStatus.'~'.$PaysheetNumber.'~'.$status);
            }else{
                 echo ('0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0~0');
            }        


 ?>