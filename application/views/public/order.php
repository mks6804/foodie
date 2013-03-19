<?php $this->load->view('public/_header', $title);?>
<div class="row page-desc">    
<?php echo '<h1 class="four columns">' . 'Your Order' . '</h1>'; ?>  
<p class="eight columns cat-desc"></p>    
</div>
<div class="row">
    <div class="twelve columns">
    <?php echo ($checkout) ? form_open(base_url() . 'order/submit') : form_open(base_url() . 'order/update'); ?>
    <table style="width:100%" id="cart">
    <tr>
      <td class="alignLeft thead">Item Description</td>
      <td class="alignLeft thead">Quantity</td>
      <td class="alignRight thead">Item Price</td>
      <td class="alignRight thead">Sub-Total</td>
    </tr>

    <?php $i = 0; ?>
    <?php foreach ($this->cart->contents() as $items): ?>
            <?php 
            if($checkout){
                echo form_hidden('details' . $i .'[id]', $items['id']);                 
            }else{
                echo form_hidden($i.'[rowid]', $items['rowid']); 
            }
            ?>        
            <tr>
            <td>
                <?php echo $items['name']; ?>
            </td>
              <td>
                  <?php 
                  if($checkout){
                    echo $items['qty'];    
                    echo form_hidden('details' .$i.'[qty]', $items['qty']); 
                    echo form_hidden('details' .$i.'[price]', $items['price']);      
                  }else{
                    echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5'));
                    echo form_error($i.'[qty]');
                  }?>
              </td>

              <td  class="alignRight"><?php echo $this->cart->format_number($items['price']); ?></td>
              <td  class="alignRight">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
            </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <tr>
        <td colspan="2"></td>
        <td></td>
        <td class="alignRight"><strong>Total</strong> $<?php echo $this->cart->format_number($this->cart->total()); ?>
            <?php echo ($checkout) ? form_hidden('total', $this->cart->format_number($this->cart->total())) : ''; ?>  
        </td>


    </tr>

    </table>

    <?php if($checkout == FALSE){ ?>
    <?php 
    $opts = array(
        'id'          => 'updateOrder',
        'value'       => 'Update your Order',
        'class'       => 'secondary button'
        );
    echo '<p>' . form_submit($opts) . '</p>';
    ?>      
    <p><a href="<?php echo base_url(). 'order/checkout' ?>" class="success button">Proceed to Checkout</a></p>
    <?php }else{ ?>
    <div class="row email">
        <div class="six columns">
        <?php
            echo form_hidden('count', ($i));    
            echo form_label('Email', 'email');
            echo form_input('email', set_value('email')); 
            echo form_error('email');
         ?>
        </div>
        <div class="six columns">
        <?php 
        echo form_label('Phone', 'phone');
        echo form_input('phone', set_value('phone')); 
        echo form_error('phone');    
        ?>
        </div>
    </div>
    <div class="row">
        <div class="twelve columns">
        <?php 
        $textArea = array(
          'name'        => 'instructions',
          'id'          => 'instructions',
          'maxlength'   => '100',
          'style'       => 'height:68px; margin-bottom:20px;', 
          'value' => set_value('instructions')
        );
        echo form_label('Special Instructions', 'instructions');
        echo form_textarea($textArea);             
        echo form_error('instructions');
        ?>
        </div>
    </div>
    <div class="row">
        <label for="captcha">Enter the Letters Below:</label>
        <?php echo $captcha; ?><br>
        <input type="text" name="captcha" />
        <?php echo form_error('captcha'); ?>
        
    </div>
    <p><?php 
    $submit = array(
        'id'          => 'submitOrder',
        'value'       => 'Submit Order',
        'class'       => 'success button'
        );
    echo form_submit($submit); ?></p>

    <?php } ?>
    <?php echo form_close(); ?> 
    </div>
    </div>

<?php $this->load->view('public/_footer');?>