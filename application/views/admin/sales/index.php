<?php if(isset($sales)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<h2>Pracownicy</h2><a href="<?php echo site_url('admin/employees/edit'); ?>" class="btn btn-primary">Dodaj nowego pracownika</a>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>SPRZEDAWCA</th>
					<th>KLIENT</th>
					<th>DATA ZATWIERDZENIA</th>
					<th>Cena</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sales as $sal): ?>
					<tr>
						<td><?php echo $empl->ID_EMPLOYEES; ?></td>
						<td><?php echo $empl->NAME_EMPLOYEES; ?></td>
						<td><?php echo $empl->SURNAME_EMPLOYEES; ?></td>
						<td><?php echo $empl->EMAIL_EMPLOYEES; ?></td>
						<td><?php echo $empl->ADDRESS_EMPLOYEES; ?></td>
						<td><?php echo $empl->PHONE_NUMBER_EMPLOYEES; ?></td>
						<td>
							<a href="<?php echo site_url('admin/employees/show_sales/') . $empl->ID_EMPLOYEES; ?>" target="_blank">Pokaż sprzedaże</a>
						</td>
						<td>
							<a href="<?php echo site_url('admin/employees/show_provides/') . $empl->ID_EMPLOYEES; ?>" target="_blank">Pokaż dostawy</a>
						</td>
						<td>
							<a href="<?php echo site_url('admin/employees/edit/') . $empl->ID_EMPLOYEES; ?>" target="_blank">Edytuj</a> 
						</td>
						<td>
							<?php echo anchor(site_url('admin/employees/delete/') . $empl->ID_EMPLOYEES, 'Usuń', array(
								'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
							)); ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>