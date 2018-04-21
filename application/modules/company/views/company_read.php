<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Company View
        <small>View of all Company</small>
        <?php echo anchor(site_url('company/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Company</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Company Read</h3>
        </div>
        <div class="box-body">
        
        <table class="table">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Contact Number</td><td><?php echo $contact_number; ?></td></tr>
	    <tr><td>Date Time</td><td><?php echo $date_time; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('company') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div></div></section></div>