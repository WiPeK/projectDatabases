<?php if(isset($producers)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<h2>Producenci</h2>
	<form action="<?php echo site_url('admin/producers/addProducer'); ?>" method="post" accept-charset="utf-8">
		<input type="text" name="name" placeholder="Wpisz nazwe nowego producenta">
		<button type="submit" class="btn btn-primary">Dodaj nowego producenta</button>
	</form>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Nazwa</th>
					<th>Przedmioty</th>
					<th>Usuń</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($producers as $pr): ?>
					<tr>
						<td><?php echo $pr->ID_PRODUCERS; ?></td>
						<td><?php echo $pr->NAME_PRODUCERS; ?></td>
						<td><a href="<?php echo site_url('admin/producers/show_items/') . $pr->ID_PRODUCERS; ?>">Pokaż przedmioty</a></td>
						<td>
							<?php echo anchor(site_url('admin/producers/deleteProducer/') . $pr->ID_PRODUCERS, 'Usuń', array(
								'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
							)); ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>