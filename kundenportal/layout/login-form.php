
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
				<div class="col-lg-4 col-md-6 col-sm-12 pt-5">
					<div class="card">
						<div class="card-header">
							<?php if ($B24_CONTACT->alert): ?>
								<div class="alert alert-danger">
									Falscher Login oder Passwort!
								</div>
							<?php else: ?>
								Genehmigung
							<?php endif ?>
						</div>
						<div class="card-body p-3 pb-5">
							<form action="" method="post">
								<input type="text" name="UF_USER_LOGIN" class="form-control" placeholder="login">
								<input type="password" name="UF_USER_PASSWORD" class="form-control mt-3" placeholder="passwort">
								<button class="btn btn-lg btn-primary mt-3 w-100">
									<i class="fa fa-sign-in" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php exit(); ?>
	<?php endif ?>