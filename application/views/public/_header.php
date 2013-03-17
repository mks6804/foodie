<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<title><?php echo $title;?></title>
<link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/css/foundation.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/css/public-styles.css">
<script src="<?php echo base_url();?>/httpdocs/js/jquery.js"></script>
<script src="<?php echo base_url();?>/httpdocs/js/foundation.min.js"></script>
<script src="<?php echo base_url();?>/httpdocs/js/app.js"></script>
<script type="text/javascript">
    $(function(){
          $('a.modalExt').live("click",function(){
            var href = $(this).attr('href'); 
            $.ajax({
                url: href, 
                success: function(html){
                    $("#popup").html(html);
                    $("#popup").append('<a class="close-reveal-modal">×</a>');
                    $('#popup').reveal();
                }
            }); //end .ajax
            return false;
          })//end modalExt click
          $('a.addToOrder').live('click', function(){
                var href = $(this).attr('href');
                $.ajax({
                    url: href, 
                    success: function(){
                         $("#popup").html('this has been added to your order');                        
                         setTimeout(function(){
                             $('#popup').trigger('reveal:close');                             
                         }, 1000);
                    }
                })
                return false;
          }) //end addToOrder click
         
    }) //end doc ready
</script>
</head>
<body class="public">
<header class="row"> 
<?php echo flashData(); ?>
<div class="alignRight topMsg">
    <p>Tempor incididunt ut labore et dolore magna aliqua</p>
    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
    <p>Incididunt ut labore et dolore magna aliqua...</p>
</div>
<a class="logo" href="<?php echo base_url();?>">Home</a>
<div class="nav">
<ul>
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>about/">About</a></li>
    <li><a href="<?php echo base_url();?>menu/">Our Menu</a></li> 
    <li><a href="<?php echo base_url();?>contact/">Contact</a></li> 
    <li><a href="<?php echo base_url();?>order/">
            Order  <?php echo $this->cart->total_items() > 0 ? 
                    '(' .$this->cart->total_items() . ')' : ''; ?>       
        </a></li>
</ul>    
</div>
</header>
<div class="mid <?php echo  $this->router->class; ?> row">