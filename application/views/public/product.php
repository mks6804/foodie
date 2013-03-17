<div class="row">
    <h3><?php echo $product[0]['name']; ?></h3>
    <?php echo !empty($product[0]['description']) ? '<p>' . $product[0]['description'] . '</p>' : ''; ?>
<a class="button addToOrder" href="<?php echo base_url(); ?>order/add/<?php echo $product[0]['id']; ?>">Add to order</a>
</div>
