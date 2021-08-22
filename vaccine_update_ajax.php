<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM vaccsination WHERE idvaccsination='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*sports     idSports  SportName TeacherInCharge delete_status status  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idVaccine=$res['idvaccsination'];
                $vaccinName=$res['vaccinName'];
               

              echo ('1~'.$idVaccine.'~'.$vaccinName);
            }else{
                 echo ('0~0~0');
            }        


 ?>