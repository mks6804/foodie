<?php $this->load->view('admin/_header');?>	
<div class="row pageTitles">
    <div class="twelve columns">
      <h3><?php echo $title;?></h3>
      <p>This shows all of your orders. Note that the newest order is shown first.</p>
    </div>
</div>
<div class="row">
    <div class="twelve columns">
        <table class="twelve">           
            <thead>
                <tr>
                    <td>Order Id</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Total</td>
                    <td>Date</td>               
                    <td>Details</td>
                </tr>
            </thead>
            <?php if(!empty($orders)):foreach($orders as $item):?>
            <tr>
                <td><?php echo $item->id;?></td>
                <td><?php echo $item->email;?></td>
                <td><?php echo $item->phone;?></td>
                <td><?php echo $item->total;?></td>
                <td><?php echo $item->date;?></td>
                <td><a class="modalExt" href="<?php echo base_url() . 'admin/order/' . $item->id; ?>">Details</a></td>
            </tr>
            <?php endforeach; endif; ?>
        </table>
    </div>
</div>
<?php echo($links);?>
<?php $this->load->view('admin/_footer');?>