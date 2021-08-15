<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM class WHERE idClass ='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*sports     idCoCurri  Name TeacherInCharge delete_status status  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idClass=$res['idClass'];
                $Name=$res['Name'];
                $NoStudents=$res['NoOfStudents'];
                $Section=$res['section_idSection'];
                $ClassTeacher=$res['Teacher_idTeacher'];

              echo ('1~'.$idClass.'~'.$Name.'~'.$NoStudents.'~'.$Section.'~'.$ClassTeacher);
            }else{
                 echo ('0~0~0~0~0~0');
            }        


 ?>