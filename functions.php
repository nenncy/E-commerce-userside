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

function get_product($con,$type='', $limit=''){

    $query="SELECT * FROM product";
     if($type=='latest'){
         $query.="order by id desc";
     }
     if($limit!=null){
         $query.="limit $limit";
     }
     $query="SELECT * FROM product";

    $data=mysqli_query($con,$query);
    $res=array();
    while($row=mysqli_fetch_assoc($data)){
        $res[]=$row;
    }
    return $res;
}

?>