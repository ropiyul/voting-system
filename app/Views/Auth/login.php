<?= $this->extend('auth/layout.php') ?>
<?= $this->section('main') ?>

<div id="app">
	<section class="section">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
					<div class="login-brand">
						<img src="<?= base_url() ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
					</div>

					<div class="card card-primary">
						<div class="card-header">
							<h4>Login</h4>

						</div>


						<div class="card-body">
							<?= $this->include('auth/_message_block.php') ?>

							<form action="<?= url_to('login') ?>" method="post">

						
									<div class="form-group">
										<label for="login">Username</label>
										<input id="login" type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" tabindex="1" placeholder="username" required autofocus>
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									</div>
							
								<div class="form-group">
									<div class="d-block">
										<label for="password" class="control-label">Password</label>
										<?php if ($config->activeResetter): ?>
											<div class="float-right">
												<a href="<?= url_to('forgot') ?>" class="text-small">
													Forgot Password?
												</a>
											</div>
										<?php endif; ?>
									</div>
									<input id="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" tabindex="2" placeholder="Password" required>
									<div class="invalid-feedback">
										<?= session('errors.password') ?>
									</div>
								</div>

								<?php if ($config->allowRemembering): ?>
									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input id="remember-me" type="checkbox" class="custom-control-input" name="remember" tabindex="3" <?php if (old('remember')) : ?>checked<?php endif ?>>
											<label class="custom-control-label" for="remember-me">Remember Me</label>
										</div>
									</div>
								<?php endif; ?>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
										Login
									</button>
								</div>


							</form>
						</div>
					</div>
					<div class="mt-5 text-muted text-center">
						<?php if ($config->allowRegistration): ?>
							Don't have an account? <a href="<?= url_to('register') ?>">Create One</a>
						<?php endif; ?>
					</div>
					<div class="simple-footer">
						Copyright &copy; Stisla 2018
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



<?= $this->endSection() ?>