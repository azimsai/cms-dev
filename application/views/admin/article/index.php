<section>
	<h1>Articles</h1>
	<?php echo anchor('admin/article/edit', '<i class="icon-plus"></i>Add an article'); ?>
	<table class="table table-striped table-condensed">
		<thead>
			<th>Title</th>
			<th>Publish Date</th>
			<th>Slug</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php 
				if (count($articles)){					
					foreach ($articles as $article){			
						echo "<tr><td>".anchor('admin/article/edit/'.$article->id,$article->title)."</td>".
							 "<td>".$article->pubdate."</td>".
							 "<td>".$article->slug."</td>".
							 "<td>".btn_edit('admin/article/edit/'.$article->id)."</td>".
							 "<td>".btn_delete('admin/article/delete/'.$article->id)."</td></tr>";
					} 
				}else{
					echo "<tr><td>No articles found<td><tr>";		 
				}
			 ?>				
		</tbody>
	</table>
</section>