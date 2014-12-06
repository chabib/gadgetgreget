<h1>Edit City</h1>

<form action="<?php echo $baseURL.'/cities/'.$city->id.'/update' ?>" method='POST'>
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
				<input type="text" name="name" value="<?php echo $city->name ?>">
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<a href="<?php echo $baseURL.'/cities' ?>">List All</a>
				<input type="submit" name="submit" value="Update">
			</td>
		</tr>
		
	</table>
</form>