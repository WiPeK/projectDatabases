<div class="row placeholders">
  <div class="placeholder">
  	<form action="<?php echo site_url('admin/providers/edit/') . (!empty($provider->ID_PROVIDERS) ? $provider->ID_PROVIDERS : "");  ?>" method="post" accept-charset="utf-8">
  		<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
			<div class="alert alert-danger" role="alert">
				<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
			</div>
		<?php endif; ?>
  		<h3><?php echo empty($provider->ID_PROVIDERS) ? 'Dodaj nowego dostawce:' : 'Edycja dostawcy: ' . $provider->NAME_PROVIDERS; ?></h3>
  		<div class="form-group">
			<label for="name">Nazwa</label>
			<input type="text" name="name" class="form-control" placeholder="Wpisz nazwe" value="<?php echo $provider->NAME_PROVIDERS; ?>">
			<?php if(form_error('name')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('name'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" placeholder="Wpisz email" value="<?php echo $provider->EMAIL_PROVIDERS; ?>">
			<?php if(form_error('email')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('email'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
	    	<label for="address">Adres</label>
	    	<textarea class="form-control" name="address" rows="3"><?php echo $provider->ADDRESS_PROVIDERS; ?></textarea>
	    	<?php if(form_error('address')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('address'); ?>
				</div>
			<?php endif; ?>
	  	</div>
	  	<div class="form-group">
			<label for="phone">Nr telefonu</label>
			<input type="text" name="phone" class="form-control" placeholder="Wpisz nr telefonu" value="<?php echo $provider->PHONE_NUMBER_PROVIDERS; ?>">
			<?php if(form_error('phone')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('phone'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="nip">NIP</label>
			<input type="text" name="nip" class="form-control" placeholder="Wpisz nr nip" value="<?php echo $provider->NIP_PROVIDERS; ?>">
			<?php if(form_error('nip')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('nip'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="regon">REGON</label>
			<input type="text" name="regon" class="form-control" placeholder="Wpisz nr regon" value="<?php echo $provider->REGON_PROVIDERS; ?>">
			<?php if(form_error('regon')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('regon'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<button type="submit" class="btn btn-primary">Zapisz</button>
  	</form>
  </div>
</div>