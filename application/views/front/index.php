<?php if(isset($items)): ?>
	<div class="alert alert-success" role="alert">
		<strong>Witaj w naszym sklepie</strong> Zapraszamy do zapoznania się z naszym asortymentem
	</div>
	<?php foreach($items as $item): ?>
		<div class="card col-lg-4">
			<div class="card-block">
				<h4 class="card-title"><?php echo $item->NAME_ITEMS; ?></h4>
				<p class="card-text">Model: <strong><?php echo $item->MODEL_ITEMS; ?></strong></p>
				<p class="card-text">Ilość sztuk: <strong><?php echo ($item->QUANTITY_ITEMS > 0)? $item->QUANTITY_ITEMS : "Brak przedmiotu w magazynie"; ?></strong></p>
				<p class="card-text">Cena: <strong><?php echo $item->PRICE_ITEMS; ?></strong></p>
				<p class="card-text">Producent: <strong><?php echo $item->NAME_PRODUCERS; ?></strong></p>
			</div>
			<?php if(isset($item->ftrs)): ?>
			<ul class="list-group list-group-flush">
				<?php $features = explode(";", $item->ftrs); ?>
				<?php foreach($features as $ft): ?>
					<li class="list-group-item"><?php echo $ft; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<div class="card-block">
				<?php if($item->QUANTITY_ITEMS > 0): ?>
					<form action="<?php echo site_url() . 'home/addToBasket/' . $item->ID_ITEMS; ?>" method="post" accept-charset="utf-8">
						Podaj ilość sztuk: <input type="number" value="1" name="itemtobasket" min="1" max="<?php echo $item->QUANTITY_ITEMS; ?>">
						<div class="clearfix"></div>
						<button type="submit" class="btn btn-primary">Dodaj do koszyka</button>
					</form>
				<?php else: ?>
					<strong>Przedmiot niedostępny</strong>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
		<strong>Niestety nasz magazyn jest pusty</strong>
	</div>
<?php endif; ?>