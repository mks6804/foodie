<?php $this->load->view('public/_header', $title);?>
<script src="<?php echo base_url();?>/httpdocs/js/jquery.cycle2.js"></script>
<div class="row homepageImage">
    <div class=" twelve columns cycle-slideshow">        
        <img src="httpdocs/images/slideshow1.jpg" />
        <img src="httpdocs/images/slideshow2.jpg" />
        <img src="httpdocs/images/slideshow3.jpg" />
        <img src="httpdocs/images/slideshow4.jpg" />
        <img src="httpdocs/images/slideshow5.jpg" />
        <img src="httpdocs/images/slideshow6.jpg" />
    </div> 
</div>
<div class="row homepageBlurb">
    <div class="four columns">
        <h5>Sed ut Perspiciatis!</h5>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        </p>
    </div>
    <div class="four columns">
        <h5>Finibus Bonorum...</h5> 
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        </p>
    </div>
    <div class="four columns"> 
        <h5>Hanep sa Wow</h5>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        </p>
    </div>
</div>
<?php $this->load->view('public/_footer');?>