<?php if(isset($emp_sales)): ?>
	<?php if(isset($emp_pr[0]->KLIENT)): ?><h2>Sprzedaże pracownika <?php echo $emp_pr[0]->KLIENT; ?></h2><?php endif; ?>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Sprzedawca</th>
					<th>Klient</th>
					<th>Data wykonania</th>
					<th>Cena sprzedaży</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($emp_sales as $sal): ?>
					<tr>
						<td><a href="<?php echo site_url('admin/sales/showItems/') . $sal->ID_SALES; ?> "><?php echo $sal->ID_SALES; ?></a></td>
						<td><a href="<?php echo site_url('admin/employees/edit/') . $sal->ID_EMPLOYEES; ?> "></a><?php echo $sal->SPRZEDAWCA; ?></td>
						<td><?php echo $sal->KLIENT; ?></td>
						<td><?php echo $sal->EXECUTION_DATE_SALES; ?></td>
						<td><?php echo $sal->SALES_PRICE; ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>