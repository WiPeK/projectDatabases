<div class="row placeholders">
  <div class="placeholder">
  	<form action="<?php echo site_url('admin/employees/edit/') . (!empty($employee->ID_EMPLOYEES) ? $employee->ID_EMPLOYEES : "");  ?>" method="post" accept-charset="utf-8">
  		<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
			<div class="alert alert-danger" role="alert">
				<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
			</div>
		<?php endif; ?>
  		<h3><?php echo empty($employee->ID_EMPLOYEES) ? 'Dodaj nowego pracownika:' : 'Edycja pracownika: ' . $employee->NAME_EMPLOYEES . ' ' . $employee->SURNAME_EMPLOYEES; ?></h3>
  		<div class="form-group">
			<label for="name">Imie</label>
			<input type="text" name="name" class="form-control" placeholder="Wpisz imie" value="<?php echo $employee->NAME_EMPLOYEES; ?>">
			<?php if(form_error('name')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('name'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="surname">Nazwisko</label>
			<input type="text" name="surname" class="form-control" placeholder="Wpisz nazwisko" value="<?php echo $employee->SURNAME_EMPLOYEES; ?>">
			<?php if(form_error('surname')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('surname'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="surname">Email</label>
			<input type="email" name="email" class="form-control" placeholder="Wpisz email" value="<?php echo $employee->EMAIL_EMPLOYEES; ?>">
			<?php if(form_error('email')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('email'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
			<label for="password">Hasło</label>
			<input type="password" name="password" class="form-control" placeholder="Wpisz hasło">
			<?php if(form_error('password')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('password'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<div class="form-group">
	    	<label for="address">Adres</label>
	    	<textarea class="form-control" name="address" rows="3"><?php echo $employee->ADDRESS_EMPLOYEES; ?></textarea>
	    	<?php if(form_error('address')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('address'); ?>
				</div>
			<?php endif; ?>
	  	</div>
	  	<div class="form-group">
			<label for="phone">Nr telefonu</label>
			<input type="text" name="phone" class="form-control" placeholder="Wpisz nr telefonu" value="<?php echo $employee->PHONE_NUMBER_EMPLOYEES; ?>">
			<?php if(form_error('phone')) : ?>
				<div class="alert alert-warning bad_validation" role="alert">
					<?php echo form_error('phone'); ?>
				</div>
			<?php endif; ?>
			<small class="form-text text-muted">To pole jest obowiązkowe</small>
		</div>
		<button type="submit" class="btn btn-primary">Zapisz</button>
  	</form>
  </div>
</div>