<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
	<div class="alert alert-danger" role="alert">
		<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
	</div>
<?php endif; ?>

<div class="col-lg-6">
	<div class="row placeholders">
  <div class="placeholder">
  	<form action="<?php echo site_url('admin/provides/edit/') . (!empty($provide->ID_PROVIDES) ? $provide->ID_PROVIDES : "");  ?>" method="post" accept-charset="utf-8">
  		<h3><?php echo empty($provide->ID_PROVIDES) ? 'Dodaj nową dostawe:' : 'Edycja dostawy'; ?></h3>
  		<?php if(isset($provide->SPRZEDAWCA)): ?>
			<h4>Sprzedawca: <?php echo $provide->SPRZEDAWCA; ?></h4>
  		<?php endif; ?>
  		<?php if(empty($provide->ID_PROVIDES)): ?>
  		<div class="form-group">
	    	<label for="provider">Dostawca</label>
	    	<select name="provider" class="custom-select" required>
		    	<?php foreach ($providers as $prvd => $val): ?>
					<option <?php echo ($prvd == $provide->ID_PROVIDERS)? "selected" : ""; ?> value="<?php echo $prvd; ?>"><?php echo $val; ?></option>
		    	<?php endforeach ?>
	    	</select>
	    	<?php if(form_error('provider')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('provider'); ?>
				</div>
			<?php endif; ?>
	  	</div>
		<button type="submit" class="btn btn-primary">Zapisz</button>
	<?php endif; ?>
  	</form>
  	<?php if(!empty($provide->ID_PROVIDES)): ?>
		<div class="clearfix"></div>
		<a class="btn btn-primary" href="<?php echo site_url('admin/provides/closeProvide/') . $provide->ID_PROVIDES; ?> ">Zamknij dostawe</a>
  	<?php endif; ?>
  </div>
</div>
</div>
<div class="col-lg-6">
	<?php if(!empty($provide->ID_PROVIDES)): ?>
		<form action="<?php echo site_url('admin/provides/addItem/') . $provide->ID_PROVIDES; ?>" method="post" accept-charset="utf-8">
			<label for="feature">Parametr</label>
			<?php echo form_dropdown('item', $items, '', 'class="custom-select"'); ?>
			<input type="number" min="1" name="itqn" class="form-control" placeholder="Wpisz ilość przedmiotów" required>
			<button type="submit" class="btn btn-primary" onsubmit="return confirm('Czy napewno chcesz dodać element. Zapisz edycje przedmiotu zanim wykonasz akcje. Jesteś pewien?);">Dodaj przedmiot</button>
		</form>
		<?php if(isset($prItems)): ?>
			<ul>
			    <?php foreach ($prItems as $item): ?>
			    	<li>
			    		<?php echo $item->ITEM . ' Ilość: ' . $item->QUANTITY_PROVIDES_ITEMS; ?>
			    		<a href="<?php echo site_url('admin/provides/deleteItemFromProvide/') . $item->ID_ITEMS . '/' . $provide->ID_PROVIDES; ?>">Usuń</a>
			    	</li>
			    <?php endforeach; ?>
			</ul>
		<?php endif; ?>
  	<?php endif; ?>
</div>
