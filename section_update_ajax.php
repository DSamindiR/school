<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM section WHERE idSection ='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*sports     idCoCurri  Name TeacherInCharge delete_status status  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idSec=$res['idSection'];
                $Name=$res['sectionName'];
                $SecHead=$res['SectionHead'];
                

              echo ('1~'.$idSec.'~'.$Name.'~'.$SecHead);
            }else{
                 echo ('0~0~0~0');
            }        


 ?>