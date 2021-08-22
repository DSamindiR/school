<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM scholarship WHERE idScholarship='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

 /*scholarship idScholarship Month amount  delete_status Student_idStudent Student_AdmissionNumber */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idScholarship=$res['idScholarship'];
                $Month=$res['Month'];
                $amount=$res['amount'];
                $discription=$res['discription'];
                $Student_idStudent=$res['Student_idStudent'];
                $Student_AdmissionNumber=$res['Student_AdmissionNumber'];

              echo ('1~'.$idScholarship.'~'.$Month.'~'.$amount.'~'.$discription.'~'.$Student_idStudent.'~'.$Student_AdmissionNumber);
            }else{
                 echo ('0~0~0~0~0~0~0');
            }        


 ?>