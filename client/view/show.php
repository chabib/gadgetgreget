<h1>Show City</h1>

<table>
	<tr>
		<td>
			ID
		</td>
		<td>
			<?php echo $city->id ?>
		</td>
	</tr>
	<tr>
		<td>
			Name
		</td>
		<td>
			<?php echo $city->name ?>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<a href="<?php echo $baseURL.'/cities' ?>">List All</a>
			<a href="<?php echo $baseURL.'/cities/'.$city->id.'/edit' ?>">Edit</a>
			<a href="<?php echo $baseURL.'/cities/'.$city->id.'/delete' ?>">Delete</a>
		</td>
	</tr>
</table>