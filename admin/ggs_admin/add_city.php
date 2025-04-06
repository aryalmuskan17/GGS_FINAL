<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
		$status = $_POST['status'];
  $table="tbl_city";
  $field_values=array("cname","status");
  $data_values=array("$cname","$status");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'City Section!!',
    message: 'City Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="add_city.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			
	
		$table="tbl_city";
  $field = array('cname'=>$cname,'status'=>$status);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'City Section!!',
    message: 'City Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_city.php";}, 3000);
</script>
<?php 
	
		}
		?>
		

        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
				<?php 
				if(isset($_GET['id']))
				{
					?>
					<h1>Edit City</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add City</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_city where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" class="form-control" placeholder="Enter City Name" value="<?php echo $data['cname'];?>" name="cname" required="">
                                        </div>
										
                                        
										 <div class="form-group">
                                            <label>City Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update City</button>
                                    </div>
                                </form>
					<?php 
				}
				else 
				{
					?>
                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" class="form-control" placeholder="Enter City Name" name="cname" required="">
                                        </div>
										
										
										<div class="form-group">
                                            <label>City Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add City</button>
                                    </div>
                                </form>
				<?php } ?>
                            </div>
            </div>
					
                
            </section>
        </div>
        
       
    </div>
</div>

<?php require 'include/footer.php';?>
</body>


</html>