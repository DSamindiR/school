<?php include_once('db/conn.php'); ?>
<?php include_once('header.php'); ?>




<form action="attendance.php" method="post">
  <div class="row">
    <div class="col-lg-12">
        <div class="statistic d-flex align-items-center bg-white has-shadow">  

        <div class="input-group mb-3">
              <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox" name="clz">
                    </div>
               </div>
               <select  name="class1" class="form-control" required>
                        <option selected disabled>Select Class</option>
                    
                              <?php
                                            
                                    $get_cat = "SELECT * FROM class";
                                    $run_cat = mysqli_query($conn, $get_cat);
                                                                    
                                    while ($row_cat=mysqli_fetch_array($run_cat)) {
                                        $idClass = $row_cat['idClass'];
                                        $Name = $row_cat['Name'];
                                                                            
                                        echo " <option value='$idClass'> $Name </option>";
                                    } ?>           
                </select>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="statistic d-flex align-items-center bg-white has-shadow">
        <button type="submit" class="btn btn-success float-right" name="clzz">
          Show Students' Details
      </button>&nbsp;&nbsp;&nbsp;&nbsp;
      </form>
       
      </div>
    </div>
  </div>

<br>


<?php 

if (isset($_POST['clzz']) && (isset($_POST['class1']) && isset($_POST['clz']))) {
 ?>


    <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <table id="example" class="display" style="width:100%">
              <thead>
                  <tr>
                  
                      <th>Student id</th>
                      <th>Admission No</th>
                      <th>Student Name</th>
                      <th>Class id</th>
                      <th>Class</th>
                      <th>Attend</th>
                  </tr>
              </thead>

                  <?php 

                    $class1=mysqli_real_escape_string($conn, $_POST['class1']);

                     $get_subject = "SELECT * FROM student WHERE delete_status=1 AND Class_idClass='$class1'";
                     $run_rpro = mysqli_query($conn,$get_subject);
                     $x=0;
                     while($row_rpro=mysqli_fetch_array($run_rpro))
                      {
                       
                        $x++;

                          $idStudent=$row_rpro['idStudent'];
                          $AdmissionNumber=$row_rpro['AdmissionNumber'];
                          $name=$row_rpro['name'];
                          $Class_idClass=$row_rpro['Class_idClass'];

                           $get_teacher = "SELECT * FROM class WHERE idClass='$Class_idClass' LIMIT 1";     
                           $res = mysqli_query($conn,$get_teacher);

                           if($result=mysqli_fetch_array($res)){
                              $Name=$result['Name'];
                      }
                  
                  ?>

              <tbody>
                  <tr>
                      <td><?php echo $idStudent; ?></td>
                      <td><?php echo $AdmissionNumber; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $Class_idClass; ?></td>
                      <td><?php echo $Name; ?></td>

                  <td>
                   <!--  <div class="form-check-inline">
                     <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="att">
                    </label>
                    </div> -->
                  <div class="form-group">
                  <select class="form-control" id="attend" required>
                    <option value="Prasant">Present</option>
                    <option value="Absant">Absent</option>>
                  </select>
                </div> 
                  </td>
                  </tr>

                </tbody>
              <?php }  ?>
              </table>

              <button type="button" id="submit_attend" class="btn btn-success float-right" >
               Add Attendance
              </button>

            </div>
          </div>
        </div>
      </div>
    </div>

<?php   
}
?>
  


    
<?php include_once('footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
      $('#mainForm').parsley();
      $('.sl2').select2();



    $('.scholarship_id1').click(function(){

        var scholarship=$(this).data('id');
        
          $.ajax({

                url:'scholarship_update_ajax.php',

                type:'post',

                data:{id1:scholarship},

                cache: false,

                success:function(data){

                    var d=data.split('~');

                    if (d[0]==1) {
                            $('#scholarship_id').val(d[1]);
                            $('#hiddenen_scholarship_id').val(d[1]);
                            $('#month').val(d[2]);
                            $('#amount').val(d[3]);
                            $('#discription').val(d[4]);
                            $('#Student').val(d[5]);
                            $('#admission_no').val(d[6]);
                    }

            }
          });
    });





$("#submit_attend").on('click',function(){
 
   var arrData=[];
   // loop over each table row (tr)
   $("#example tr").each(function(){
        var currentRow=$(this);
    
        //var attend=$('#attend').val();
        var col1_value=currentRow.find("td:eq(0)").text();
        var col2_value=currentRow.find("td:eq(1)").text();
        var col4_value=currentRow.find("td:eq(3)").text();
        //var col5_value=currentRow.find("td:eq(5)").();
        var col5_value=document.getElementById("attend").value;

        var obj={};
        
        obj.col1=col1_value;
        obj.col2=col2_value;
        obj.col4=col4_value;
        obj.col5=col5_value;

        arrData.push(obj);
   });
   
    console.log(arrData);

});


});
</script>