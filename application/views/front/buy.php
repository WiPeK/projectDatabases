<?php echo validation_errors(); ?>

<form action="<?php echo site_url('home/buy'); ?>" method="post" accept-charset="utf-8">
	<div class="form-group">
		<label for="name">Imie</label>
		<input type="text" name="name" class="form-control" placeholder="Wpisz imie">
		<small class="form-text text-muted">To pole jest obowiązkowe</small>
	</div>
	<div class="form-group">
		<label for="surname">Nazwisko</label>
		<input type="text" name="surname" class="form-control" placeholder="Wpisz nazwisko">
		<small class="form-text text-muted">To pole jest obowiązkowe</small>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" placeholder="Wpisz adres email">
		<small class="form-text text-muted">To pole jest obowiązkowe</small>
	</div>
	<div class="form-group">
    	<label for="address">Adres do wysyłki</label>
    	<textarea class="form-control" name="address" rows="3"></textarea>
  	</div>
  	<div class="form-group">
		<label for="phone">Nr telefonu</label>
		<input type="text" name="phone" class="form-control" placeholder="Wpisz nr telefonu">
		<small class="form-text text-muted">To pole jest obowiązkowe</small>
	</div>
	<button type="submit" class="btn btn-primary">Zakończ zakup</button>
</form>