<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Settings
        <small>Add a new Settings</small>
        <?php echo anchor(site_url('settings/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Settings</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Settings <?php echo $button ?></h3>
        </div>
        <div class="box-body">
    

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Lebel <?php echo form_error('lebel') ?></label>
            <input type="text" class="form-control" name="lebel" id="lebel" placeholder="Lebel" value="<?php echo $lebel; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Value <?php echo form_error('value') ?></label>
            <input type="text" class="form-control" name="value" id="value" placeholder="Value" value="<?php echo $value; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('settings') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div></div></div></section></div>