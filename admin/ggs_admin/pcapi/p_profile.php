<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == ''    or $data['password'] == '' or $data['uid'] == '' or $data['address'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $name = strip_tags(mysqli_real_escape_string($mysqli,$data['name']));
   
    
     $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
	 
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = $mysqli->query("select * from partner where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="partner";
  $field = array('name'=>$name,'password'=>$password,'address'=>$address);
  $where = "where id=".$uid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
            $c = $mysqli->query("select * from partner where  `id`=".$uid."")->fetch_assoc();
			$cat = $mysqli->query("select cat_name from category where id =".$c['category_id']."")->fetch_assoc();
        $returnArr = array("PartnerLogin"=>$c,,"category"=>$cat['cat_name'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);