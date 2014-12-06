<h1>List of cities</h1>
<a href="<?php echo $baseURL.'/cities/new'?>">Create a new City</a>
<table>
	<tr>
		<th>ID</th>
		<th>City</th>
		<th></th>
	</tr>
	<?php foreach ($cities as $city): ?>
		<tr>
			<td>
				<?php echo $city->id ?>
			</td>
			<td>
				<?php echo $city->name ?>
			</td>
			<td>
				<a href="<?php echo $baseURL.'/cities/'.$city->id ?>">View</a>
				<a href="<?php echo $baseURL.'/cities/'.$city->id.'/delete' ?>">Delete</a>
			</td>
		</tr>

	<?php endforeach; ?>
</table>