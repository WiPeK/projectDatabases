<?php if(isset($sales)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<h2>Sprzedaże</h2>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>SPRZEDAWCA</th>
					<th>KLIENT</th>
					<th>PRZEDMIOTY</th>
					<th>DATA ZATWIERDZENIA</th>
					<th>Cena</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sales as $sal): ?>
					<tr>
						<td><?php echo $sal->ID_SALES; ?></td>
						<td>
							<?php if($sal->ID_EMPLOYEES != NULL): ?>
								<a href="<?php echo site_url('admin/employees/edit/') . $sal->ID_EMPLOYEES; ?>" target="_blank"><?php echo $sal->SPRZEDAWCA; ?></a>
							<?php else: ?>
								SPRZEDAŻ NIEZAAKCEPTOWANA
							<?php endif; ?>
						</td>
						<td>
							<?php echo $sal->KLIENT; ?>
						</td>
						<td>
							<a target="_blank" href="<?php echo site_url('admin/sales/showItems/') . $sal->ID_SALES; ?>">Pokaż przedmioty</a>
						</td>
						<td><?php echo ($sal->EXECUTION_DATE_SALES)? $sal->EXECUTION_DATE_SALES : "SPRZEDAŻ NIEZAAKCEPTOWANA"; ?></td>
						<td><?php echo $sal->SALES_PRICE; ?></td>
						<td>
							<?php if($sal->STATUS_SALES): ?>
								ZATWIERDZONY
							<?php else: ?>
								<a href="<?php echo site_url('admin/sales/acceptSale/') . $sal->ID_SALES; ?>" class="btn btn-primary">ZATWIERDŹ</a>
								<a href="<?php echo site_url('admin/sales/declineSale/') . $sal->ID_SALES; ?>" class="btn btn-primary">ODRZUĆ</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>