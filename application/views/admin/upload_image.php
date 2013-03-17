 <div id="imageUploaderror">
    <?php echo $error;?>
</div>
<?php echo form_open_multipart('admin/do_upload');?>     
<input type="file" name="userfile" size="20" id="imageText" />
<input type="submit" value="upload" id="uploadImage" />
<input type="hidden" value="<?php echo isset($mode) ? $mode : '' ; ?>" name="mode" />
</form>