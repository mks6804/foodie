<?php $this->load->view('public/_header', $title);?>
<h3>Contact</h3> 
<div class="row">
    <div class="six columns">
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni</p>
        <h6>Use the Form below to send us a message!</h6>
        <?php echo form_open(base_url() . 'contact');?>
        <label for="name">Name</label>
        <input name="name" type="text" value="<?php echo set_value('name'); ?>" />
        <?php echo form_error('name'); ?>

        <label for="email">Email</label>
        <input type="text"  name="email" value="<?php echo set_value('email'); ?>" />
        <?php echo form_error('email'); ?>

        <label for="message">Message</label>
        <textarea name="message"><?php echo set_value('message'); ?></textarea>
        <?php echo form_error('message'); ?>
        
        <label for="captcha">Enter the Letters Below:</label>
        <?php echo $captcha; ?><br>
        <input type="text" name="captcha" />
        <?php echo form_error('captcha'); ?>
        
        <input class="button" type="submit" style="margin:15px 0 25px 0" />
        <?php echo form_close(); ?>
        <h6>Eiusmod tempor incididunt ut!</h6>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        
    </div>
    <div class="six columns">
<!--        <div class="mapView">
            <iframe width="100%" height="294" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Mi+Casita,+Sunland,+Los+Angeles,+CA&amp;aq=0&amp;oq=mi+casita+tuj&amp;sll=37.269174,-119.306607&amp;sspn=16.046017,33.815918&amp;t=m&amp;ie=UTF8&amp;hq=Mi+Casita,&amp;hnear=Sunland,+Los+Angeles,+California&amp;ll=34.259786,-118.309282&amp;spn=0.002046,0.004128&amp;z=14&amp;iwloc=A&amp;cid=9709220083287319367&amp;output=embed"></iframe><br /><small><a href="https://www.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Mi+Casita,+Sunland,+Los+Angeles,+CA&amp;aq=0&amp;oq=mi+casita+tuj&amp;sll=37.269174,-119.306607&amp;sspn=16.046017,33.815918&amp;t=m&amp;ie=UTF8&amp;hq=Mi+Casita,&amp;hnear=Sunland,+Los+Angeles,+California&amp;ll=34.259786,-118.309282&amp;spn=0.002046,0.004128&amp;z=14&amp;iwloc=A&amp;cid=9709220083287319367" style="color:#0000FF;text-align:left">View Larger Map</a></small>            
        </div>
        <div class="streetView">
            <iframe width="100%" height="294" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Mi+Casita,+Sunland,+Los+Angeles,+CA&amp;aq=0&amp;oq=mi+casita+tuj&amp;sll=37.269174,-119.306607&amp;sspn=16.046017,33.815918&amp;t=h&amp;ie=UTF8&amp;hq=Mi+Casita,&amp;hnear=Sunland,+Los+Angeles,+California&amp;layer=c&amp;cbll=34.259664,-118.309391&amp;panoid=ItLu8ZxPw5b4wIBV_Iaqiw&amp;cbp=13,11.78,,0,10.46&amp;ll=34.255665,-118.309407&amp;spn=0.013976,0.030041&amp;z=15&amp;output=svembed"></iframe><br /><small><a href="https://www.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Mi+Casita,+Sunland,+Los+Angeles,+CA&amp;aq=0&amp;oq=mi+casita+tuj&amp;sll=37.269174,-119.306607&amp;sspn=16.046017,33.815918&amp;t=h&amp;ie=UTF8&amp;hq=Mi+Casita,&amp;hnear=Sunland,+Los+Angeles,+California&amp;layer=c&amp;cbll=34.259664,-118.309391&amp;panoid=ItLu8ZxPw5b4wIBV_Iaqiw&amp;cbp=13,11.78,,0,10.46&amp;ll=34.255665,-118.309407&amp;spn=0.013976,0.030041&amp;z=15" style="color:#0000FF;text-align:left">View Larger Map</a></small>
        </div>-->
    </div>
</div>



<?php $this->load->view('public/_footer');?>