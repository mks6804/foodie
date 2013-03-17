<?php $item = ($mode=='edit') ? $product[0] : '';  ?>
<?php $this->load->view('admin/_header');?>

<div class="row pageTitles">
    <div class="nine columns">
      <h3><?php echo $title;?></h3>
      <?php if($mode=='edit'): ?>
      <p>The following shows the details for Product id number: <strong><?php echo $item->id;?></strong>. 
        Please edit the desired fields and click "Submit". Note that Name is a required fields</p>
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
<?php if($mode=='edit'): ?>
    <input name="id" type="hidden" value="<?php  echo $item->id; ?>" />
<?php endif; ?>
    
    <div class="twelve columns">
        <label>Product name</label>
        <input name="name" type="text" value="<?php echo ($mode=='edit') ? $item->name : set_value('name');?>" />
    </div>
    <div class="twelve columns">
        <label>Description</label>
        <textarea name="description"><?php echo ($mode=='edit') ? $item->description : set_value('description'); ?></textarea>    
    </div>
    <div class="four columns">
    <label>Price</label>
    <input name="price" type="text" value="<?php echo ($mode=='edit') ? $item->price : set_value('price');?>" />    
    </div>
    <div class="eight columns">
        <label>Category</label>
        <select name="cat_id" id="cat_id">
        <?php if(is_array($categories)): ?>
            <?php foreach($categories as $cat): ?>           
            <option             
            <?php if($mode=='edit'){
                echo ($item->cat_id == $cat['id']) ? 'selected="selected"' : '';  
            }?> 
             value="<?php echo $cat['id'];?>"><?php echo $cat['name']; ?></option>
            <?php endforeach;?>
        <?php endif; ?>
        </select>
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

	 
<?php $this->load->view('admin/_footer');?>
