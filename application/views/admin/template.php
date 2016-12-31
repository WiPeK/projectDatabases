<?php $this->load->view('admin/header'); ?>
	<div class="container">
		<?php $this->load->view('admin/menu_top'); ?>
		<?php if(isset($_SESSION['statusBuy']) && !empty($_SESSION['statusBuy'])): ?>
			<div class="alert alert-danger" role="alert">
				<strong><?php echo $_SESSION['statusBuy']; unset($_SESSION['statusBuy']); ?></strong>
			</div>
		<?php endif; ?>
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view('admin/menu_left'); ?>
				<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 main">
					<?php $this->load->view($subview); ?>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('admin/footer'); ?>
