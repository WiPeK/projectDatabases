<?php if(isset($provides)): ?>
	<?php if(isset($provides[0]->NAME_PROVIDERS)): ?><h2>Dostawca <?php echo $provides[0]->NAME_PROVIDERS; ?></h2><?php endif; ?>
	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Sprzedawca</th>
					<th>Data wykonania</th>
					<th>Cena dostawy</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($provides as $sal): ?>
					<tr>
						<td><a href="<?php echo site_url('admin/provides/show/') . $sal->ID_PROVIDES; ?> "></a><?php echo $sal->ID_PROVIDES; ?></td>
						<td><a href="<?php echo site_url('admin/employees/edit/') . $sal->ID_EMPLOYEES; ?> "></a><?php echo $sal->SPRZEDAWCA; ?></td>
						<td><?php echo $sal->EXECUTION_DATE_PROVIDES; ?></td>
						<td><?php echo $sal->PROVIDES_PRICE; ?></td>
						<td><?php echo ($sal->STATUS_PROVIDES)? "ZAKOŃCZONY" : "OTWARTY"; ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>