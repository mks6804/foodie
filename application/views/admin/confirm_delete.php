<div class="row confirm">
    <div class="twelve columns">
    <p>Are you sure you want to delete <?php echo $this->uri->segment(3); ?> "<?php echo $array[0]->name;?>"?</p>    
    <?php echo form_open($action); ?>     
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input  type="hidden" name="table" value="<?php echo $table; ?>" />
        <input type="submit" class="button" value="Yes Im Sure" style="margin:5px 0 15px 0;" />
        <a class="closeModal" href="<?php echo base_url();?>admin">Cancel</a>
     <?php echo form_close(); ?>
    </div>
</div>
