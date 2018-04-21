<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Menu View
        <small>View of all Menu</small>
        <?php echo anchor(site_url('menu/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Menu Read</h3>
        </div>
        <div class="box-body">
        
        <table class="table">
	    <tr><td>Icon</td><td><?php echo $icon; ?></td></tr>
	    <tr><td>Name Menu</td><td><?php echo $name_menu; ?></td></tr>
	    <tr><td>Link</td><td><?php echo $link; ?></td></tr>
	    <tr><td>Parent</td><td><?php echo $parent; ?></td></tr>
	    <tr><td>Position</td><td><?php echo $position; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div></div></section></div>