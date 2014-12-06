<h1>Create a New City</h1>

<form action="<?php echo $baseURL.'/cities' ?>" method='POST'>
	<table>
		<tr>
			<td>
				Name
			</td>
			<td>
				<input type="text" name="name" value="">
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<a href="<?php echo $baseURL.'/cities' ?>">List All</a>
				<input type="submit" name="submit" value="Create">
			</td>
		</tr>

	</table>
</form>