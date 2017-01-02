<?php if(isset($itpr)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>

	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Nazwa | Model</th>
					<th>Ilość</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($itpr as $it): ?>
					<tr>
						<td><?php echo $it->ID_ITEMS; ?></td>
						<td><a href="<?php echo site_url('admin/items/edit/') . $it->ID_ITEMS; ?>"><?php echo $it->ITEM; ?></a></td>
						<td><?php echo $it->QUANTITY_SALES_ITEMS; ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>