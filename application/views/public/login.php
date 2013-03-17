<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/css/foundation.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/css/public-styles.css">
<style>
    .five.columns.centered .panel{margin-top:50px;}
</style>
<title>Login to Admin Section</title>	
</head>
<body>
<div class="row">
    <div class="five columns centered">       
        <div class="panel">
            <?php 
            echo ($this->session->flashdata('login_error') != '') ?  '<div class="alert-box alert">' . $this->session->flashdata('login_error') . '</div>' : ''; 
            echo validation_errors(); ?>
            <?php echo form_open('admin/login'); ?> 
            <label for="username">Username</label>
            <input type="text" name="username"/>
            <label for="password">Password</label>
            <input type="password" name="password"/>
            <input type="submit" class="button" />
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</body>
</html>