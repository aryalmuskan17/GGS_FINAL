<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="partner";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Partner Section!!',
    message: 'Partner Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="partner.php";}, 3000);
</script>
<?php 
}
?>

<?php 
		
		if(isset($_GET['status']))
		{
			
		$id = $_GET['id'];
$status = $_GET['status'];
 $table="partner";
  $field = "status=".$status."";
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData_single($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Partner Section!!',
    message: 'Partner Status Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="partner.php";}, 3000);
</script>
<?php 	  
		}
		?>


<?php 
		
		if(isset($_GET['aprove']))
		{
			
		$id = $_GET['id'];
$aprove = $_GET['aprove'];
 $table="partner";
  $field = "aprove=".$aprove."";
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData_single($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Partner Section!!',
    message: 'Partner Status Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="partner.php";}, 3000);
</script>
<?php 	  
		}
		?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Partner List</h1>
                </div>
				<div class="card">
				
                               <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped v_center" id="table-1">
                                            <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                
                                                
                                                <th>Mobile</th>
												
												<th>Credit</th>
												<th>City</th>
												<th>Address</th>
												<th>Partner Category</th>
												<th>Status</th>
												<th>Approve??</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `partner` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['name']; ?></td>
                                                <td> <?php echo $row['email']; ?></td>
												<td> <?php echo $row['mobile']; ?></td>
                                                
                                               
												
												
																								
												
												<td> <?php echo $row['credit']; ?></td>
												<td> <?php echo $row['city']; ?></td>
												<td> <?php echo $row['address']; ?></td>
												<td> <?php $cdata = $mysqli->query("select * from category where id=".$row['category_id']."")->fetch_assoc(); echo $cdata['cat_name'];?></td>
												<?php if($row['status'] == 1) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&status=0"><div class="badge badge-danger">Make Deactive</div></a></td>
												<?php } else { ?>
												<td><a href="?id=<?php echo $row['id'];?>&status=1"><div class="badge badge-success">Make Active</div></a></td>
												<?php } ?>
												
												<?php if($row['aprove'] == 0) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&aprove=1"><div class="badge badge-success">Make Approve</div></a> <a href="?id=<?php echo $row['id'];?>&aprove=2"><div class="badge badge-danger">Make Disapprove</div></a></td>
												<?php } else if($row['aprove'] == 2){ ?>
												<td><div class="badge badge-danger">Disappproved</div></td>
												<?php } else {
													?>
													<td><div class="badge badge-success">Appproved</div></td>
													<?php 
												}?>
												
												<td>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
												
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>
</body>


</html>