<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_happy_user";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Testimonial Section!!',
    message: 'Testimonial Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_testimonial.php";}, 3000);
</script>
<?php 
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                   <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Testimonial List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_testimonial.php" class="btn btn-primary" > Add New Testimonial </a>
					</div>
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
                                                <th>Testimonial Name</th>
												<th>Testimonial Comment</th>
                                                <th>Testimonial Image</th>
                                                
                                                
                                                <th>Status</th>
												
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_happy_user`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['title']; ?></td>
												<td> <?php echo $row['comment']; ?></td>
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['img']; ?>" width="60" height="60"/>
                                                </td>
                                                
                                               
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
												
																								
												
                                                <td><a href="add_testimonial.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
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