<?php if(isset($_SESSION['status_edit']) && !empty($_SESSION['status_edit'])): ?>
	<div class="alert alert-danger" role="alert">
		<strong><?php echo $_SESSION['status_edit']; unset($_SESSION['status_edit']); ?></strong>
	</div>
<?php endif; ?>

<div class="col-lg-6">
	<div class="row placeholders">
		<h4>Sprzedawca: <?php echo $provide->SPRZEDAWCA; ?></h4>
		<h4>Dostawca: <a href="<?php echo site_url('admin/providers/edit/') . $provide->ID_PROVIDERS; ?>" target="_blank">
		<?php echo $provide->NAME_PROVIDERS; ?></a></h4>
		<h4>Data wykonania:<?php echo $provide->EXECUTION_DATE_PROVIDES; ?> </h4>
		<h4>Cena dostawy:<?php echo $provide->PROVIDES_PRICE; ?> </h4>
  	</div>
</div>
<div class="col-lg-6">
	<?php if(!empty($provide->ID_PROVIDES)): ?>
		<h4>Przedmioty w dostawie</h4>
		<?php if(isset($prItems)): ?>
			<ul>
			    <?php foreach ($prItems as $item): ?>
			    	<li>
			    		<?php echo $item->ITEM . ' Ilość: ' . $item->QUANTITY_PROVIDES_ITEMS; ?>
			    	</li>
			    <?php endforeach; ?>
			</ul>
		<?php endif; ?>
  	<?php endif; ?>
</div>
