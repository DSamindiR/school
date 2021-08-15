<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM extracurricularactivities WHERE idActivities ='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*sports     idexCurri  Name TeacherInCharge delete_status status  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idExCurri=$res['idActivities'];
                $Name=$res['CurricularName'];
                $TeacherInCharge=$res['TeacherInCharge'];

              echo ('1~'.$idExCurri.'~'.$Name.'~'.$TeacherInCharge);
            }else{
                 echo ('0~0~0~0');
            }        


 ?>