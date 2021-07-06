function add_to_cart(pid,type){

    var qty=jQuery("#qty").val();
jQuery.ajax({
    url:'manage_cart.php',
    type:'post',
    data:'pid='+pid+'&qty='+qty+'&type='+type,
    success:function(result){
        if(type=='remove'){
            window.location.href='cart.php';
        }
        jQuery('.htc__qua').html(result);
    }	
});	
}