<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

<html>
<head>
	<link rel="stylesheet" href="<?=base_url()?>css/paginator.css" type="text/css" media="screen" />
</head>

	<body>
		
		<div class="list">
			<div id="pagination"><?=$pagination?></div>
			
			<table class="list" cellspacing="0">
				<tr>
					<td>
						<form action="<?=base_url()?>sample_controller" method="post" enctype="multipart/form-data">Search:&nbsp;<input type="text" name="search_string" value="<?=$search_string?>">&nbsp;<input type="submit" value="search" name="search" id="search" />
						</form>
					</td>
				</tr>
				<tr>
					<th>row1</th>
					<th>row2</th>
				</tr>
				<?php foreach ($records as $record) : ?>
				<tr>
					<td><?=$record->row1?></td>
					<td><?=$record->row2?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>

	</body>
</html>