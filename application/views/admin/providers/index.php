<?php if(isset($providers)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<h2>Dostawcy</h2><a href="<?php echo site_url('admin/providers/edit'); ?>" class="btn btn-primary">Dodaj nowego dostawce</a>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Nazwa</th>
					<th>Email</th>
					<th>Adres</th>
					<th>Telefon</th>
					<th>NIP</th>
					<th>REGON</th>
					<th>Dostawy</th>
					<th>Edytuj</th>
					<th>Usuń</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($providers as $prv): ?>
					<tr>
						<td><?php echo $prv->ID_PROVIDERS; ?></td>
						<td><?php echo $prv->NAME_PROVIDERS; ?></td>
						<td><?php echo $prv->EMAIL_PROVIDERS; ?></td>
						<td><?php echo $prv->ADDRESS_PROVIDERS; ?></td>
						<td><?php echo $prv->PHONE_NUMBER_PROVIDERS; ?></td>
						<td><?php echo $prv->NIP_PROVIDERS; ?></td>
						<td><?php echo $prv->REGON_PROVIDERS; ?></td>
						<td>
							<a href="<?php echo site_url('admin/providers/show_provides/') . $prv->ID_PROVIDERS; ?>" target="_blank">Pokaż dostawy</a>
						</td>
						<td>
							<a href="<?php echo site_url('admin/providers/edit/') . $prv->ID_PROVIDERS; ?>" target="_blank">Edytuj</a> 
						</td>
						<td>
							<?php echo anchor(site_url('admin/providers/delete/') . $prv->ID_PROVIDERS, 'Usuń', array(
								'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
							)); ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>