<?php include_once('db/conn.php'); ?>
<?php 
	$id1=mysqli_real_escape_string($conn, $_POST['id1']);

	$get_teacher = "SELECT * FROM user WHERE iduser='$id1' LIMIT 1";
                                
    $res = mysqli_query($conn,$get_teacher);

  /*
iduser,userName,password,email,extra_previlages,previlages_idprevilages,delete_status,status,first_name,last_name,img,address,nic,telephone,DOB
*/
  

            if($row_rpro=mysqli_fetch_array($res))
            {


                ?>

                    <table border="0" width="100%">
                        <tr>
                            <td style="padding: 20px;">
                                <p>-  User Id :<?php echo $row_rpro['iduser'];?></p>
                                <p>-  First name :<?php echo $row_rpro['first_name'];?></p>
                                <p>-  Last Name :<?php echo $row_rpro['last_name'];?></p>
                                <p>-  Email :<?php echo $row_rpro['email'];?></p>
                            </td>
                        </tr>
                        
                    </table>
                <?php
            }

 ?>