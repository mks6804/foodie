<?php $this->load->view('admin/_header', $title);?>
<div class="row pageTitles">
   <div class="nine columns">
     <h3>Viewing Categories</h3>
     <p>Below lists the categories for your menu. Ideas for categories are "Breakfast", "Lunch" etc. You can manage the list by selecting an action in the right most column.  </p>
   </div>
   <div class="three columns newButton">
        <a class="button" href="<?php echo base_url();?>admin/category/new">Add a Category</a>
   </div>
</div>
<table class="twelve">
<thead>
<tr>
    <td>Name</td>
    <td>Description</td>
    <td>Image</td>		
    <td>Action</td>
</tr>
</thead>
<tbody>
<?php if(is_array($categories)): ?>
    <?php foreach($categories as $item)
    {
        echo '<tr>';
        echo '<td>' . $item->name . '</td>';
        echo '<td>' . $item->description . '&nbsp;</td>';
        echo '<td>' . $item->image . '&nbsp;</td>';			 
        echo '<td><a href="' .base_url() . 'admin/category/'  . $item->id . '">Edit</a>&nbsp;<a class="modalExt" href="'. base_url() .'admin/confirm/category/'. $item->id . '">Delete</a></td>';			
        echo '</tr>';			  
    }?>
<?php endif; ?>
</tbody>	
</table>
<?php echo($links); ?>
<?php $this->load->view('admin/_footer', $title);?>