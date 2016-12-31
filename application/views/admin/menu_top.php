<nav class="navbar navbar-dark navbar-fixed-top bg-inverse">
  <button type="button" class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-label="Toggle navigation"></button>
  <a class="navbar-brand" href="<?php echo site_url(); ?>">Sklep</a>
  <div id="navbar">
    <nav class="nav navbar-nav float-xs-left">
      <a class="nav-item nav-link" href="<?php echo site_url('admin/employees'); ?>">Pracownicy</a>
      <a class="nav-item nav-link" href="<?php echo site_url('admin/clients'); ?>">Klienci</a>
      <a class="nav-item nav-link" href="<?php echo site_url('admin/providers'); ?>">Dostawcy</a>
      <a class="nav-item nav-link" href="<?php echo site_url('admin/producers'); ?>">Producenci</a>
      <a class="nav-item nav-link" href="<?php echo site_url('admin/items'); ?>">Asortyment</a>
      <a class="nav-item nav-link" href="<?php echo site_url('admin/sales'); ?>">Sprzedaże</a>
      <a class="nav-item nav-link" href="<?php echo site_url('admin/provides'); ?>">Dostawy</a>
    </nav>
  </div>
</nav>