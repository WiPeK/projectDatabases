<nav class="navbar navbar-dark bg-inverse">
  <a class="navbar-brand" href="<?php echo site_url(); ?>">Sklep</a>
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="<?php echo site_url(); ?>">Strona główna <span class="sr-only">(current)</span></a>
    </li>
    <?php if(!empty($_SESSION['basket'])): ?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('home/basket'); ?>">Koszyk</a>
    </li>
  <?php endif; ?>
  <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('admin/admin'); ?>">Panel administratora</a>
    </li>
  </ul>
  <?php if(!isset($_SESSION['logged'])): ?>
    <form action="<?php echo site_url('home/login'); ?>" method="post" accept-charset="utf-8" class="form-inline float-xs-right">
      <input name="email" class="form-control" type="email" placeholder="email" value="wipekxxx@gmail.com">
      <input name="password" class="form-control" type="password" placeholder="Hasło" value="12345">
      <button class="btn btn-outline-info" type="submit">Zaloguj</button>
    </form>
  <?php endif; ?>
</nav>