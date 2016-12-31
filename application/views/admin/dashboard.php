<h1>Sklep - panel administracyjny</h1>
<?php if(isset($stats)): ?>
<div class="row placeholders">
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->EMPL; ?></h4>
    <h4>Pracowników</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->CLNT; ?></h4>
    <h4>Klientów</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->ITCT; ?></h4>
    <h4>Przedmiotów</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->PRDC; ?></h4>
    <h4>Producentów</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->PRVD; ?></h4>
    <h4>Dostawców</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->SLSC; ?></h4>
    <h4>Sprzedaży</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->SISM; ?></h4>
    <h4>Sprzedanych przedmiotów</h4>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <h4 class="m-x-auto"><?php echo $stats[0]->SALPR; ?></h4>
    <h4>Cena sprzedanych przedmiotów</h4>
  </div>
</div>
<?php endif; ?>