<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Settings View
        <small>View of all Settings</small>
        <?php echo anchor(site_url('settings/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Settings</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Settings Read</h3>
        </div>
        <div class="box-body">
        
        <table class="table">
	    <tr><td>Lebel</td><td><?php echo $lebel; ?></td></tr>
	    <tr><td>Value</td><td><?php echo $value; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('settings') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div></div></section></div>