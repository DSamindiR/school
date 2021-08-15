<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM sports WHERE idSports='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*sports     idSports  SportName TeacherInCharge delete_status status  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idSports=$res['idSports'];
                $SportName=$res['SportName'];
                $TeacherInCharge=$res['TeacherInCharge'];

              echo ('1~'.$idSports.'~'.$SportName.'~'.$TeacherInCharge);
            }else{
                 echo ('0~0~0~0');
            }        


 ?>