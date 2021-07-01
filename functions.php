<?php
include 'dbconnection.php';

function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con,$str){
    if($str!=''){
        $str=trim($str);
        return mysqli_real_escape_string($con,$str);

    }

}

function get_product($con, $limit='' , $cat_id=''){

    $query="SELECT * FROM product where status=1";

    if($cat_id!=''){
		$query.=" and category_id=$cat_id ";
	}

    
    
     if($limit!=null){
         $query.="limit $limit";
     }
    
     
    $data=mysqli_query($con,$query);
    $res=array();
    while($row=mysqli_fetch_assoc($data)){
        $res[]=$row;
    }
    return $res;
}

?>