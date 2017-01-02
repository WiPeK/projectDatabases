<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
	<div class="alert alert-danger" role="alert">
		<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
	</div>
<?php endif; ?>
<?php if(isset($provides)): ?>
	<h2>Dostawy</h2><a href="<?php echo site_url('admin/provides/edit'); ?>" class="btn btn-primary">Dodaj nową dostawe</a>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>SPRZEDAWCA</th>
					<th>DOSTAWCA</th>
					<th>DATA WYKONANIA</th>
					<th>CENA DOSTAWY</th>
					<th>EDYCJA/POKAŻ</th>
					<th>STATUS</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($provides as $provide): ?>
					<tr>
						<td><?php echo $provide->ID_PROVIDES; ?></td>
						<td>
							<a href="<?php echo site_url('admin/employees/edit/') . $provide->ID_EMPLOYEES; ?>" target="_blank">
							<?php echo $provide->SPRZEDAWCA; ?></a>
						</td>
						<td>
							<a href="<?php echo site_url('admin/providers/edit/') . $provide->ID_PROVIDERS; ?>" target="_blank">
							<?php echo $provide->NAME_PROVIDERS; ?></a>
						</td>
						<td><?php echo ($provide->EXECUTION_DATE_PROVIDES)? $provide->EXECUTION_DATE_PROVIDES : "DOSTAWA NIE ZAKOŃCZONA"; ?></td>
						<td><?php echo $provide->PROVIDES_PRICE; ?></td>
						<td>
							<?php if($provide->STATUS_PROVIDES): ?>
								<a href="<?php echo site_url('admin/provides/show/') . $provide->ID_PROVIDES; ?>" target="_blank">
								POKAŻ</a>
							<?php else: ?>
								<a href="<?php echo site_url('admin/provides/edit/') . $provide->ID_PROVIDES; ?>" target="_blank">
								EDYCJA</a>
							<?php endif; ?>
						</td>
						<td>
							<?php if($provide->STATUS_PROVIDES): ?>
								ZATWIERDZONY
							<?php else: ?>
								<a href="<?php echo site_url('admin/provides/closeProvide/') . $provide->ID_PROVIDES; ?>" class="btn btn-primary">ZATWIERDŹ</a>
								<a href="<?php echo site_url('admin/provides/declineProvide/') . $provide->ID_PROVIDES; ?>" class="btn btn-primary">ODRZUĆ</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>