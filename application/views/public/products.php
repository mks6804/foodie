<?php $this->load->view('public/_header', $title);?>
<div class="row page-desc">    
<?php echo '<h1 class="four columns">' . $categoryName . '</h1>'; ?>  
<p class="eight columns cat-desc"><?php echo $categoryDesc; ?></p>    
</div>
<div class="row products">
    <?php for($i=0; $i<count($products); $i++):
        $img = (!empty($products[$i]['image'])) ? $products[$i]['image'] : site_url() . '/httpdocs/images/default-image.jpg';
    ?> 
    <div class="four columns product <?php echo ($i==(count($products) - 1) ? 'end' : '') ?>">
        <div class="div">
        <h2><a class="modalExt" href='<?php echo site_url() . 'menu/product/' . $products[$i]['slug']; ?>'><?php echo $products[$i]['name']; ?></a>
            <span class="price"><?php echo $products[$i]['price']; ?></span></h2>
        <a class="modalExt"  href='<?php echo site_url() . 'menu/product/' . $products[$i]['slug']; ?>'>
            <img class="thumb" src="<?php echo $img; ?>" />
        </a>
        </div>
    </div>
    <?php endfor;?>   
</div> 
<div class="row pagin">
     <?php echo $links;?>
</div>
<?php $this->load->view('public/_footer');?>