<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM guardian WHERE idGuardian='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

/*guardian  idGuardian  Name  NIC Tp  Address delete_status status  occupatin relationship_with_student  */

            if($res=mysqli_fetch_array($update))
            {
            	
                $idGuardian=$res['idGuardian'];
                $Name=$res['Name'];
                $NIC=$res['NIC'];
                $Tp=$res['Tp'];
                $Address=$res['Address'];
                $occupatin=$res['occupatin'];
                $relationship_with_student=$res['relationship_with_student'];
                

              echo ('1~'.$idGuardian.'~'.$Name.'~'.$NIC.'~'.$Tp.'~'.$Address.'~'.$occupatin.'~'.$relationship_with_student);
            }else{
                 echo ('0~0~0~0~0~0~0~0');
            }        


 ?>