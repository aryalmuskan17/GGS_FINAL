<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        
<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_home";
$where = "where id=".$id."";
$h = new Common();
	$check = $h->Deletedata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Section!!',
    message: 'Section Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_section.php";}, 3000);
</script>
<?php 
}
?>
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="col-md-9 col-lg-9 col-xs-12">
                    <h1>Dynamic Section List</h1>
					</div>
					<div class="col-md-3 col-lg-3 col-xs-12">
					<a href="add_section.php" class="btn btn-primary" > Add New  Section </a>
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
                                                <th>Section Title</th>
                                                <th>Section Subtitle</th>
                                                
                                                
                                                <th>Section Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_home`");
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
                                                <td class="align-middle">
                                                   <?php echo $row['subtitle']; ?>
                                                </td>
                                                
                                               
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Unpublish</div></td>
												<?php } ?>
												
																								
												
                                                <td><a href="add_section.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
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