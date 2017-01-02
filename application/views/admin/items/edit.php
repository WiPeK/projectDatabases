<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
	<div class="alert alert-danger" role="alert">
		<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
	</div>
<?php endif; ?>

<div class="col-lg-6">
	<div class="row placeholders">
  <div class="placeholder">
  	<form action="<?php echo site_url('admin/items/edit/') . (!empty($item->ID_ITEMS) ? $item->ID_ITEMS : "");  ?>" method="post" accept-charset="utf-8">
  		<h3><?php echo empty($item->ID_ITEMS) ? 'Dodaj nowy przedmiot:' : 'Edycja przedmiotu: ' . $item->NAME_ITEMS . ' ' . $item->MODEL_ITEMS; ?></h3>
  		<div class="form-group">
			<label for="name">Nazwa</label>
			<input type="text" name="name" class="form-control" placeholder="Wpisz nazwe" value="<?php echo $item->NAME_ITEMS; ?>" required>
			<?php if(form_error('name')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('name'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="model">Model</label>
			<input type="text" name="model" class="form-control" placeholder="Wpisz model" value="<?php echo $item->MODEL_ITEMS; ?>" required>
			<?php if(form_error('model')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('model'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="quantity">Ilość</label>
			<input type="text" name="quantity" class="form-control" placeholder="Wpisz ilość" value="<?php echo $item->QUANTITY_ITEMS; ?>" required>
			<?php if(form_error('quantity')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('quantity'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="price">Cena</label>
			<input type="text" name="price" class="form-control" placeholder="Wpisz cene" value="<?php echo $item->PRICE_ITEMS; ?>" required>
			<?php if(form_error('price')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('price'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
	    	<label for="producer">Producent</label>
	    	<select name="producer" class="custom-select" required>
		    	<?php foreach ($producers as $prdc): ?>
					<option <?php echo ($prdc['ID_PRODUCERS'] == $item->ID_PRODUCERS)? "selected" : ""; ?> value="<?php echo $prdc['ID_PRODUCERS']; ?>"><?php echo $prdc['NAME_PRODUCERS']; ?></option>
		    	<?php endforeach ?>
	    	</select>
	    	<?php if(form_error('producer')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('producer'); ?>
				</div>
			<?php endif; ?>
	  	</div>
		<button type="submit" class="btn btn-primary">Zapisz</button>
  	</form>
  </div>
</div>
</div>
<div class="col-lg-6">
	<?php if(isset($item->FTRS)): ?>
	<form action="<?php echo site_url('admin/items/addParam/') . $item->ID_ITEMS; ?>" method="post" accept-charset="utf-8">
		<label for="feature">Parametr</label>
		<?php echo form_dropdown('feature', $features, '', 'class="custom-select"'); ?>
		<input type="text" name="ftval" class="form-control" placeholder="Wpisz wartość parametru" required>
		<button type="submit" class="btn btn-primary" onsubmit="return confirm('Czy napewno chcesz dodać element. Zapisz edycje przedmiotu zanim wykonasz akcje. Jesteś pewien?);">Dodaj parametr</button>
	</form>
	<h3>Parametry</h3>
	<ul>
		<?php $features = explode(";", $item->FTRS); ?>
		<?php foreach($features as $feat): ?>
			<?php $ft = explode(">", $feat);?>
			<li class=""><?php echo $ft[1] . ' ' . $ft[2]; ?> <a href="<?php echo site_url('admin/items/deleteParam/') . trim($ft[0]) . '/' . $item->ID_ITEMS ; ?>">Usuń</a></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>