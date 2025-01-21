<?php if (session()->has('message')) : ?>
	<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                        </button>
                        <?= session(val: 'message') ?>
                      </div>
                    </div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
	<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                        </button>
                        <?= session(val: 'error') ?>
                      </div>
                    </div>
<?php endif ?>

<?php if (session()->has('errors')) : ?>
	<ul class="alert alert-danger">
	<?php foreach (session('errors') as $error) : ?>
		<li><?= $error ?></li>
	<?php endforeach ?>
	</ul>
<?php endif ?>
