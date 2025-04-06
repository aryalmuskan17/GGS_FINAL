<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			$title = mysqli_real_escape_string($mysqli,$_POST['title']);
			$subtitle = mysqli_real_escape_string($mysqli,$_POST['subtitle']);
			$category = $_POST['category'];
			$section = $_POST['section'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/service/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_home_service";
  $field_values=array("title","subtitle","img","status","sid","cid");
  $data_values=array("$title","$subtitle","$target_file","$okey","$section","$category");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Service Section!!',
    message: 'Service Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_service.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			$title = mysqli_real_escape_string($mysqli,$_POST['title']);
			$subtitle = mysqli_real_escape_string($mysqli,$_POST['subtitle']);
			$category = $_POST['category'];
			$section = $_POST['section'];
			$okey = $_POST['status'];
			$target_dir = "assets/category/service/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = uniqid() . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
   
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_home_service";
  $field = array('title'=>$title,'status'=>$okey,'img'=>$target_file,'sid'=>$section,'cid'=>$category,'subtitle'=>$subtitle);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Service Section!!',
    message: 'Service Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_service.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		$table="tbl_home_service";
  $field = array('title'=>$title,'status'=>$okey,'sid'=>$section,'cid'=>$category,'subtitle'=>$subtitle);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Service Section!!',
    message: 'Service Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="list_service.php";}, 3000);
</script>
<?php 
	}
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
					<h1>Edit Service</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add Service</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_home_service where id=".$_GET['id']."")->fetch_assoc();
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
									
									<div class="form-group">
									<label for="cname">Select Section</label>
									<select name="section" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from tbl_home");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($data['sid'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['title'];?></option>
									<?php } ?>
									</select>
								</div>
								
								<div class="form-group">
									<label for="cname">Select Category(Only Show List Without Subcategory Main Category)</label>
									<select name="category" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from category");
									while($rmed = $product->fetch_assoc())
									{
										$csub = $mysqli->query("select * from g_subcategory where cid=".$rmed['id']."")->num_rows;	
									if($csub != 0)
									{}
								else 
								{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($data['cid'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['cat_name'];?></option>
									<?php } } ?>
									</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Service Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Service Title" value="<?php echo $data['title'];?>" name="title" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Service Subtitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Service Subtitle" value="<?php echo $data['subtitle'];?>" name="subtitle" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Service Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										 <div class="form-group">
                                            <label>Service Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update Service</button>
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
									<label for="cname">Select Section</label>
									<select name="section" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from tbl_home");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['title'];?></option>
									<?php } ?>
									</select>
								</div>
								
								<div class="form-group">
									<label for="cname">Select Category(Only Show List Without Subcategory Main Category)</label>
									<select name="category" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from category");
									while($rmed = $product->fetch_assoc())
									{
									$csub = $mysqli->query("select * from g_subcategory where cid=".$rmed['id']."")->num_rows;	
									if($csub != 0)
									{}
								else 
								{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['cat_name'];?></option>
									<?php } } ?>
									</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Service Title</label>
                                            <input type="text" class="form-control" placeholder="Enter Service Title" name="title" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Service Subtitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Service Subtitle" name="subtitle" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Service Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
                                        </div>
										 <div class="form-group">
                                            <label>Service Status</label>
                                            <select name="status" class="form-control">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add Service</button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<script>
	$(".chosen-select").chosen();
	</script>
 <style>
.chosen-container-single .chosen-single
{
	    height: 40px;
    background: white;
    font-size: 14px;
    color: #000 !important;
    padding: 10px 12px;
	border: 1px solid #ced4da !important; 
}
.chosen-container-single .chosen-single div b
{
	    margin-top: 50%;
}
 .select2-container {
    width: 100% !important;
}
 </style>

</html>