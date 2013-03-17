<?php $this->load->view('public/_header', $title);?>
<div class="row page-desc">    
<h1 class="four columns">Our Menu</h1>
<p class="eight columns cat-desc">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque 
    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>    
</div>
<div class="row">
<?php foreach($categories as $cat){ 
$image = (!empty($cat['image'])) ? $cat['image'] : site_url() . '/httpdocs/images/default-image.jpg';
?>
<div class="six columns category">
    <div class="div">
    <h2><a href="<?php echo site_url();?>menu/category/<?php echo $cat['slug'];?>"><?php echo $cat['name'];?></a></h2>
    <a href="<?php echo site_url();?>menu/category/<?php echo $cat['slug'];?>"><img class="thumb" src="<?php echo $image; ?>" /></a>
    </div>
</div> 
<?php } ?>
</div>
<?php $this->load->view('public/_footer');?>