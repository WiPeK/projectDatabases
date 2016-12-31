<?php if(isset($clients)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<h2>Klienci</h2>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Imie</th>
					<th>Nazwisko</th>
					<th>Email</th>
					<th>Adres</th>
					<th>Telefon</th>
					<th>Kupione</th>
					<th>Usuń</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($clients as $empl): ?>
					<tr>
						<td><?php echo $empl->ID_CLIENTS; ?></td>
						<td><?php echo $empl->NAME_CLIENTS; ?></td>
						<td><?php echo $empl->SURNAME_CLIENTS; ?></td>
						<td><?php echo $empl->EMAIL_CLIENTS; ?></td>
						<td><?php echo $empl->ADDRESS_CLIENTS; ?></td>
						<td><?php echo $empl->PHONE_NUMBER_CLIENTS; ?></td>
						<td>
							<a href="<?php echo site_url('admin/clients/show_sales/') . $empl->ID_CLIENTS; ?>" target="_blank">Pokaż kupione</a>
						</td>
						<td>
							<?php echo anchor(site_url('admin/clients/delete/') . $empl->ID_CLIENTS, 'Usuń', array(
								'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
							)); ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>