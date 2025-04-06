<?php 
require 'include/navbar.php';
require 'include/sidebar.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
        <!-- Start main left sidebar menu -->
        <?php 
		if(isset($_POST['icat']))
		{
			$timsloat = implode(',',$_POST['timsloat']);
			$dthing = $_POST['dthing'];
			$category = $_POST['category'];
			$day = $_POST['day'];
			
			
			
			$check_cid = $mysqli->query("select cid from time_date where cid=".$category ."")->num_rows;
			if($check_cid != 0)
			{
				?>
				<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'TimeSlot & Date Section!!',
    message: 'Category Date Already Inserted!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="add_timedate.php";}, 3000);
	 </script>
	 
				<?php 
			}
			else 
			{
   
  $table="time_date";
  $field_values=array("cid","dstatus","days","tslot");
  $data_values=array("$category","$dthing","$day","$timsloat");
  
$h = new Common();
	  $check = $h->InsertData($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'TimeSlot & Date Section!!',
    message: 'TimeSlot & Date Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="add_timedate.php";}, 3000);
</script>
<?php 
			}
		
		}
		?>
		
		<?php 
		if(isset($_POST['ucat']))
		{
			
			$timsloat = implode(',',$_POST['timsloat']);
			$dthing = $_POST['dthing'];
			
			$day = $_POST['day'];

	
		
		$table="time_date";
  $field = array('dstatus'=>$dthing,'days'=>$day,'tslot'=>$timsloat);
  $where = "where id=".$_GET['id']."";
$h = new Common();
	  $check = $h->UpdateData($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'TimeSlot & Date Section!!',
    message: 'TimeSlot & Date Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="list_timedate.php";}, 3000);
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
					<h1>Edit TimeSlot & Date</h1>
					<?php 
				}
				else 
				{
				?>
                    <h1>Add TimeSlot & Date</h1>
				<?php } ?>
                </div>
				
				<div class="card">
				
				
				<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from time_date where id=".$_GET['id']."")->fetch_assoc();
					$extime = explode(',',$data['tslot']);		
					?>
					<form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
									
									
								
								
                                        <div class="form-group">
                                            <label>Current Or Next Date?</label>
                                            <select name="dthing" class="form-control">
											<option value="">Select Date Status</option>
											<option value="1" <?php if($data['dstatus'] == 1){echo 'selected';}?>>Current</option>
											<option value="0" <?php if($data['dstatus'] == 0){echo 'selected';}?>>Next</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Date+Day</label>
                                            <input type="number" class="form-control" placeholder="Enter Day"  value="<?php echo $data['days'];?>" step="any" name="day" required="">
                                        </div>
										
										
                                       
										 <div class="form-group row">
                                            <label class="col-md-12">TimeSloat List</label>
											<?php 
											function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i a';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[] = $date->format( $format );
    }

    return $times;
}
$range = hoursRange( 28800, 72000, 60 * 30, 'h:i a' );

for($i=0;$i<count($range);$i++)
{
											?>
											<div class="col-md-2">
											
                                            <input type="checkbox"  name="timsloat[]" value="<?php echo $range[$i];?>" <?php if (in_array($range[$i], $extime)){echo 'checked';} ?> /> <?php echo $range[$i];?>
											</div>
<?php } ?>
                                        </div>
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="ucat" class="btn btn-primary">Update TimeSlot & Date</button>
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
									<label for="cname">Select Category</label>
									<select name="category" class="form-control chosen-select" required>
									
									<?php 
									$product = $mysqli->query("select * from category");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['cat_name'];?></option>
									<?php } ?>
									</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Current Or Next Date?</label>
                                            <select name="dthing" class="form-control">
											<option value="">Select Date Status</option>
											<option value="1">Current</option>
											<option value="0">Next</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Date+Day</label>
                                            <input type="number" class="form-control" placeholder="Enter Day"  step="any" name="day" required="">
                                        </div>
										
										
                                       
										 <div class="form-group row">
                                            <label class="col-md-12">TimeSloat List</label>
											<?php 
											function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i a';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[] = $date->format( $format );
    }

    return $times;
}
$range = hoursRange( 28800, 72000, 60 * 30, 'h:i a' );

for($i=0;$i<count($range);$i++)
{
											?>
											<div class="col-md-2">
                                            <input type="checkbox"  name="timsloat[]" value="<?php echo $range[$i];?>"/> <?php echo $range[$i];?>
											</div>
<?php } ?>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button name="icat" class="btn btn-primary">Add TimeSlot & Date</button>
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
 
 
 .bootstrap-tagsinput
 {
	 height: 87px;
	     display: flex;
		 border:none;
 }
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