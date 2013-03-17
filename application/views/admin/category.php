<?php $this->load->view('admin/_header');?>	
<div class="row pageTitles">
    <div class="nine columns">
      <h3><?php echo $title;?></h3>
      <?php if($edit): ?>
      <p>The following shows the details for Category id number: <strong><?php echo $category->id;?></strong>. Please edit the desired fields and click "Submit". Note
      that Name and Slug are required fields</p>
      <?php endif; ?>
    </div>
    <div class="three columns newButton">
    </div>
</div>
<div class="row">
    <div class="twelve columns">
        <?php echo validation_errors();  ?>
    </div>
</div>
<div class="row">    
    <?php echo form_open($action); ?> 
        <?php if($edit): ?>
            <input type="hidden" name="id" value="<?php echo $category->id;?>" />
        <?php endif; ?>
            <div class="twelve columns">
                <label>Name</label>
                <input name="name" type="text" <?php echo $edit ? 'value="' . $category->name . '"' : set_value('name'); ?>  />
            </div>
            <div class="twelve columns">
                <label>Description</label>
                <textarea name="description"><?php echo $edit ? $category->description : set_value('description'); ?> </textarea>
            </div>
            <div class="eight columns">
                <label>Image</label>
                <input name="image" type="text" value="<?php echo $img?>" />
            </div>
            <div class="four columns uploadBtn">
                <a class="secondary button small modalExt" href="<?php echo base_url() . 'admin/upload/' . $upload_mode; ?>">Add Image</a>  
            </div>
            <div class="twelve columns">
                <input type="submit" class="radius success  button"/>
            </div>
    <?php echo form_close(); ?> 
</div>

<?php $this->load->view('admin/_footer', $title);?>