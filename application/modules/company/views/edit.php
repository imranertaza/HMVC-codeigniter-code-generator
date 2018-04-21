
<h3>Add company</h3>

	<fieldset>
		<?=form_open('company/edit/'.$data->com_id)?>
		<ul>

			<label>name</label><?php echo form_error('name'); ?>
			<li><?=form_input('name',$data->name)?></li><br>

			<label>contact_number</label><?php echo form_error('contact_number'); ?>
			<li><?=form_input('contact_number',$data->contact_number)?></li><br>

			<label>date_time</label><?php echo form_error('date_time'); ?>
			<li><?=form_input('date_time',$data->date_time)?></li><br>


		</ul>
		<?=form_submit('','Update company')?>
	</fieldset>