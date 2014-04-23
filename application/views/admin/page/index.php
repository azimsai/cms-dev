<section>
	<h1>Pages</h1>
	<?php echo anchor('admin/page/edit', '<i class="icon-plus"></i>Add a page'); ?>
	<table class="table table-striped table-condensed">
		<thead>
			<th>Title</th>
			<th>Parent</th>
			<th>Slug</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php 
				if (count($pages)){					
					foreach ($pages as $page){			
						echo "<tr><td>".anchor('admin/page/edit/'.$page->id,$page->title)."</td>".
							 "<td>".$page->parent_slug."</td>".
							 "<td>".$page->slug."</td>".
							 "<td>".btn_edit('admin/page/edit/'.$page->id)."</td>".
							 "<td>".btn_delete('admin/page/delete/'.$page->id)."</td></tr>";
					} 
				}else{
					echo "<tr><td>No pages found<td><tr>";		 
				}
			 ?>				
		</tbody>
	</table>
</section>