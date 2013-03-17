<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<title><?php echo (isset($title)) ? $title : '';?></title>	 	
<link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/css/foundation.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/css/admin-styles.css">
<script src="<?php echo base_url();?>/httpdocs/js/jquery.js"></script>
<script src="<?php echo base_url();?>/httpdocs/js/foundation.min.js"></script>
<script src="<?php echo base_url();?>/httpdocs/js/app.js"></script>
<script type="text/javascript">
$(function() {
    $('a.modalExt').live("click",function(){
        var href = $(this).attr('href'); 
        $.ajax({   
            url: href,
            success: function(html){
                $("#popup").html(html);
                $("#popup").append('<a class="close-reveal-modal">×</a>');
                $('#popup').reveal();
            }
        });
        return false;
    });  
    $('a.closeModal').live('click', function(){
        $('#popup').trigger('reveal:close');
        return false; 
    }) // ednd closeModal click
    
}); //end doc ready
</script>
</head>
<body class="admin">
<header class="row">
<div class="twelve columns menu">    
    <div class="fixed contain-to-grid">
    <nav class="top-bar">
        <ul>
            <li class="name">
            <h1>
            <a href="<?php echo base_url() . 'admin' ?>">Foodie</a>
            </h1>
            </li>
            <li class="toggle-topbar">
                <a href="#"></a>
            </li>
        </ul>
        <section>             
            <ul class="right">
                <li class="divider show-for-medium-and-up"></li>
                <li><a href="<?php echo base_url() . 'admin/';?>">Home</a></li>
                <li class="divider show-for-medium-and-up"></li>
                <li><a href="<?php echo base_url() . 'admin/orders';?>">Orders</a></li>
                <li class="divider show-for-medium-and-up"></li>
                <li><a href="<?php echo base_url() . 'admin/categories';?>">Categories</a></li>
                <li class="divider show-for-medium-and-up"></li>
                <li><a href="<?php echo base_url() . 'admin/products';?>">Products</a></li>
                <li class="divider show-for-medium-and-up"></li>
                <li><a class="logout" href="<?php echo base_url();?>admin/logout/">Logout</a></li>
            </ul>
        </section>
    </nav>
    </div>
</div>
</header>
<body>
<div class="admin_container row">
    <?php echo flashData(TRUE);  ?>