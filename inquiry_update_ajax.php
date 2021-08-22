<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_activity = "SELECT * FROM inquiary WHERE idInquiary='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_activity);

  /*  idInquiary  Description PanelHead delete_status status  Student_idStudent Student_AdmissionNumber 
*/

            if($res=mysqli_fetch_array($update))
            {
            	
                $idInquiary=$res['idInquiary'];
                $Description=$res['Description'];
                $PanelHead=$res['PanelHead'];
                $Student_idStudent=$res['Student_idStudent'];
                $Student_AdmissionNumber=$res['Student_AdmissionNumber'];

              echo ('1~'.$idInquiary.'~'.$Description.'~'.$PanelHead.'~'.$Student_idStudent.'~'.$Student_AdmissionNumber);
            }else{
                 echo ('0~0~0~0~0~0');
            }        


 ?>