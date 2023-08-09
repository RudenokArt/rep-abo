<script>
	$( function() {
		$( "#login_form-tabs" ).tabs();
	} );
</script>
<?php if (isset($_SESSION['B24']['CONTACT'])): ?>
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-lg-2 col-md-3 col-sm-3 text-end">
				<a href="/kundenportal/contact_profile/" class="smart_link">
					<i class="fa fa-user-o" aria-hidden="true"></i>
					<?php echo $B24_CONTACT->data['UF_USER_LOGIN'];?>
				</a>
				<form action="" method="post" class="d-inline">
					<button class="btn btn-lg btn-outline-primary border-white" title="logout" name="contact_logout" value="Y">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
					</button>
				</form>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="login_form-layout pt-5">
		<div class="container pt-5">
			<div class="row justify-content-center pt-5">
				<div class="col-lg-6 col-md-8 col-sm-12 pt-5">


					<div id="login_form-tabs">
						<ul>
							<li><a href="#tabs-1">Genehmigung</a></li>
							<li><a href="#tabs-2">Passwort Wiederherstellung</a></li>
						</ul>
						<div id="tabs-1" class="card">
							<div class="card-header">
								<?php if ($B24_CONTACT->alert['visible']): ?>
									<div class="alert alert-<?php echo $B24_CONTACT->alert['color']; ?>">
										<?php echo $B24_CONTACT->alert['text']; ?>
									</div>
								<?php else: ?>
									Genehmigung
								<?php endif ?>
							</div>
							<div class="card-body p-3 pb-5">
								<form action="" method="post">
									<input type="text" name="UF_USER_LOGIN" class="form-control" placeholder="login" required>
									<input type="password" name="UF_USER_PASSWORD" class="form-control mt-3" placeholder="passwort" required>
									<button class="btn btn-lg btn-primary mt-3 w-100">
										<i class="fa fa-sign-in" aria-hidden="true"></i>
									</button>
								</form>
							</div>
						</div>
						<div class="card" id="tabs-2">
							<div class="card-header">
								Geben sie ihre E-Mail Adresse ein:
							</div>
							<div class="card-body pb-5">
								<form action="" method="post" class="input-group pt-3 pb-5">
								<input type="email" class="form-control" name="PASSWORD_RECOVERY" required>
									<button class="input-group-text btn btn-primary" title="Schicken">
										<i class="fa fa-envelope-o" aria-hidden="true"></i>
									</button>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php exit(); ?>
<?php endif ?>

