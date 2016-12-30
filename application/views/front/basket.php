<?php if(isset($items)): ?>
	<div class="alert alert-success" role="alert">
		<strong>Oto zawartość twojego koszyka</strong>
	</div>
	<div class="alert alert-success" role="alert">
		Cena przedmiotów w twoim koszyku: <strong><?php echo $basketPrice; ?></strong>
		<a href="<?php echo site_url('home/buy'); ?>" class="btn btn-primary">Dokonaj zakupu</a>
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
			<?php if(isset($item->FTRS)): ?>
			<ul class="list-group list-group-flush">
				<?php $features = explode(";", $item->FTRS); ?>
				<?php foreach($features as $ft): ?>
					<li class="list-group-item"><?php echo $ft; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<div class="card-block">
				<?php if($item->QUANTITY_ITEMS > 0): ?>
					Ilość sztuk w koszyku: <?php echo $item->IN_BASKET; ?>
					<div class="clearfix"></div>
					<a href="<?php echo site_url('home/deleteFromBasket/') . $item->ID_ITEMS; ?>" class="btn btn-primary">Usuń z koszyka</a>
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