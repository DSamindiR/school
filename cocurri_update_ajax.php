<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM corecurricularactivities WHERE idCurricularActivities ='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*sports     idCoCurri  Name TeacherInCharge delete_status status  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idCoCurri=$res['idCurricularActivities'];
                $Name=$res['name'];
                $TeacherInCharge=$res['TeacherInCharge'];

              echo ('1~'.$idCoCurri.'~'.$Name.'~'.$TeacherInCharge);
            }else{
                 echo ('0~0~0~0');
            }        


 ?>