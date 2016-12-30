<?php $this->load->view('front/header'); ?>
	<div class="container">
		<?php $this->load->view('front/menu'); ?>
		<?php if(isset($_SESSION['statusBuy']) && !empty($_SESSION['statusBuy'])): ?>
			<div class="alert alert-danger" role="alert">
				<strong><?php echo $_SESSION['statusBuy']; unset($_SESSION['statusBuy']); ?></strong>
			</div>
		<?php endif; ?>
		<?php $this->load->view($subview); ?>
	</div>
<?php $this->load->view('front/footer'); ?>
