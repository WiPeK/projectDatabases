<?php if(isset($itpr)): ?>
	<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
		<div class="alert alert-danger" role="alert">
			<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
		</div>
	<?php endif; ?>
	<?php if(isset($itpr[0]->NAME_PRODUCERS)): ?><h2>Producent: <?php echo $itpr[0]->NAME_PRODUCERS; ?></h2><?php endif; ?>

	<div class="table-responsive">
        <table class="table table-striped">
	        <thead>
				<tr>
					<th>Id</th>
					<th>Nazwa | Model</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($itpr as $it): ?>
					<tr>
						<td><?php echo $it->ID_ITEMS; ?></td>
						<td><a href="<?php echo site_url('admin/items/edit/') . $it->ID_ITEMS; ?>"><?php echo $it->ITEM; ?></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>
    </div>
<?php endif; ?>