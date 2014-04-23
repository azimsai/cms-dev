<section>
	<h1>Users</h1>
	<?php echo anchor('admin/user/edit', '<i class="icon-plus"></i>Add a user'); ?>
	<table class="table table-striped table-condensed">
		<thead>
			<th>Email</th>
			<th>Name</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php 
				if (count($users)){					
					foreach ($users as $user){			
						echo "<tr><td>".anchor('admin/user/edit/'.$user->id,$user->email)."</td>".
							 "<td>".$user->name."</td>".
							 "<td>".btn_edit('admin/user/edit/'.$user->id)."</td>".
							 "<td>".btn_delete('admin/user/delete/'.$user->id)."</td></tr>";
					} 
				}else{
					echo "<tr><td>No users found<td><tr>";		 
				}
			 ?>				
		</tbody>
	</table>
</section>