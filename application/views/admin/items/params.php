<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
	<div class="alert alert-danger" role="alert">
		<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
	</div>
<?php endif; ?>
<?php if(isset($features)): ?>
	<h2>Parametry</h2>
	<form action="<?php echo site_url('admin/items/addFeature'); ?>" method="post" accept-charset="utf-8">
		<input type="text" name="name" placeholder="Wpisz nazwe nowego parametru">
		<button type="submit" class="btn btn-primary">Dodaj nowy parametr</button>
	</form>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Nazwa</th>
					<th>Usuń</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($features as $feat => $val): ?>
					<?php if($feat > 0): ?>
					<tr>
						<td><?php echo $feat; ?></td>
						<td><?php echo $val; ?></td>
						<td>
							<?php echo anchor(site_url('admin/items/deleteFeature/') . $feat, 'Usuń', array(
								'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
							));	?>
						</td>
					</tr>
					<?php endif; ?>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>