
<h3>Add company</h3>

	<fieldset>
		<?=form_open('company/add')?>
		<ul>

			<label>name</label><?php echo form_error('name'); ?>
			<li><?=form_input('name',set_value('name'),"placeholder='name'")?></li><br>

			<label>contact_number</label><?php echo form_error('contact_number'); ?>
			<li><?=form_input('contact_number',set_value('contact_number'),"placeholder='contact_number'")?></li><br>

			<label>date_time</label><?php echo form_error('date_time'); ?>
			<li><?=form_input('date_time',set_value('date_time'),"placeholder='date_time'")?></li><br>


		</ul>
		<?=form_submit('','Add company')?>
	</fieldset>