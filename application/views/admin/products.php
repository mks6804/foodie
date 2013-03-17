<?php $this->load->view('admin/_header', $title);?>
<div class="row pageTitles">
   <div class="nine columns">
     <h3>Viewing All Products</h3>
     <p>Below lists the products for your menu. Each item can have their own page so use descriptions
         and detailed images as good as possible. Manage this list by selecting an action in the 
         right most column, or add new ones by clicking the button to the right. </p>
   </div>
   <div class="three columns newButton">
        <a class="button" href="<?php echo base_url();?>admin/product/new">Add a Product</a>
   </div>
</div>
<table class="twelve">
<thead>
<tr>
    <td width="350">Name</td>
    <td>Description</td>
    <td>Price</td>
    <td>Category</td>
    <td>Action</td>
</tr>
</thead>
<tbody>
<?php if(is_array($products) && !empty($products)): ?>
   <?php foreach($products as $item)
   {
           echo '<tr>';
           echo '<td>' . $item->name . '</td>';
           echo '<td>' . $item->description . '&nbsp;</td>';
           echo '<td>' . $item->price . '</td>';
           echo '<td>' . $item->cat_id . '</td>';
           echo '<td><a href="' . base_url() . 'admin/product/'  . $item->id . '">Edit</a>&nbsp;<a class="modalExt" href="'. base_url() .'admin/confirm/product/'. $item->id . '">Delete</a></td>'; 
           echo '</tr>';			  
   }?>
<?php endif; ?>
</tbody>	
</table>        
<?php echo($links);?>
<?php $this->load->view('admin/_footer', $title);?>