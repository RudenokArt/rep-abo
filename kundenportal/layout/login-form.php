<?php
if (isset($_POST['UF_USER_PASSWORD']) and isset($_POST['UF_USER_LOGIN'])) {
	(new B24_Contact())->login($_POST['UF_USER_LOGIN'], $_POST['UF_USER_PASSWORD']);
}
if (isset($_POST['logout']) and $_POST['logout'] == 'Y') {
	unset($_SESSION['B24']['CONTACT']);
}
?>

<?php if (!$_SESSION['B24']['CONTACT']): ?>
	<div class="login_form-layout pt-5">
		<div class="container pt-5">
			<div class="row justify-content-center pt-5">
				<div class="col-lg-4 col-md-6 col-sm-12 pt-5">
					<div class="card">
						<div class="card-header">
							Authorization
						</div>
						<div class="card-body p-3 pb-5">
							<form action="" method="post">
								<input type="text" name="UF_USER_LOGIN" class="form-control" placeholder="login">
								<input type="password" name="UF_USER_PASSWORD" class="form-control mt-3" placeholder="password">
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
<?php else: ?>
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-lg-2 col-md-3 col-sm-3 text-end">
				<a href="#" class="smart_link">
					<?php echo $_SESSION['B24']['CONTACT']['UF_USER_LOGIN'];?>
				</a>
				<form action="" method="post" class="d-inline">
					<button class="btn btn-outline-info" style="border:none" title="logout" name="logout" value="Y">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
					</button>
				</form>
			</div>
		</div>
	</div>
	<?php endif ?>