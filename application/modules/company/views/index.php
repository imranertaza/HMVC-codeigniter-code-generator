<?php echo $this->session->flashdata('msg');?>
<h3>company</h3>

<a href='<?=base_url('company/add')?>'>Add</a>

	<table>
		<thead>
			<th>Com_id</th>
			<th>Name</th>
			<th>Contact_number</th>
			<th>Date_time</th><th>View</th><th>Edit</th><th>Delete</th>
		</thead>
		<tbody>
			<?php foreach ( $datas->result() as $data ): ?>
				<tr>
					<td><?=$data->com_id?></td>
					<td><?=$data->name?></td>
					<td><?=$data->contact_number?></td>
					<td><?=$data->date_time?></td>
					<td><a href='<?=base_url('company/view/'.$data->com_id);?>'>View</a></td>
					<td><a href='<?=base_url('company/edit/'.$data->com_id);?>'>Edit</a></td>
					<td><a data-url='<?=base_url('company/delete/'.$data->com_id);?>' href='javascript:void(0)' class='delete'>Delete</a></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

<?php echo $this->pagination->create_links(); ?>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script>
		$(document).ready(function(){
			$('.delete').click(function(){
				var url = $(this).data('url');
				if (confirm('Are you sure you want to delete this entry?')) {
					window.location = url
				}
			});
		});
</script>
		