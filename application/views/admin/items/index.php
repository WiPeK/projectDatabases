<?php if(isset($items)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<h2>Asortyment</h2>
	<a href="<?php echo site_url('admin/items/edit'); ?>" class="btn btn-primary">Dodaj nowy przedmiot</a>
	<a href="<?php echo site_url('admin/items/params'); ?>" class="btn btn-primary">Parametry</a>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Nazwa</th>
					<th>Model</th>
					<th>Ilość</th>
					<th>Cena</th>
					<th>Producent</th>
					<th>Edytuj</th>
					<th>Usuń</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $item): ?>
					<tr>
						<td><?php echo $item->ID_ITEMS; ?></td>
						<td><?php echo $item->NAME_ITEMS; ?></td>
						<td><?php echo $item->MODEL_ITEMS; ?></td>
						<td><?php echo $item->QUANTITY_ITEMS; ?></td>
						<td><?php echo $item->PRICE_ITEMS; ?></td>
						<td>
							<a href="<?php echo site_url('admin/producers/'); ?>" target="_blank">
								<?php echo $item->NAME_PRODUCERS; ?>
							</a>
						</td>
						<td>
							<a href="<?php echo site_url('admin/items/edit/') . $item->ID_ITEMS; ?>" target="_blank">Edytuj</a> 
						</td>
						<td>
							<?php echo anchor(site_url('admin/items/delete/') . $item->ID_ITEMS, 'Usuń', array(
								'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
							)); ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>