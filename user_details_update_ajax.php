<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$update_teacher = "SELECT * FROM user WHERE iduser='$id1' LIMIT 1";
                                
    $update = mysqli_query($conn,$update_teacher);

  /*
iduser,userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name,img,address,nic,telephone,DOB
*/
  
          
            if($res=mysqli_fetch_array($update))
            {
            	
                $iduser=$res['iduser'];
                $first_name=$res['first_name'];
                $last_name=$res['last_name'];
                $email=$res['email'];
                $previlages_idprevilages=$res['previlages_idprevilages'];
                $extra_previlages=$res['extra_previlages'];
                $status=$res['status'];

              echo ('1~'.$iduser.'~'.$first_name.'~'.$last_name.'~'.$email.'~'.$previlages_idprevilages.'~'.$extra_previlages.'~'.$status);
            }else{
                 echo ('0~0~0~0~0~0~0~0');
            }        


 ?>