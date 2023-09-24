<?php 
$wellcomeCheck = json_decode(
	(new B24_Greviews())->relationsList(
		$B24_CONTACT->data["ID"],
		strtotime('first day of this month 00:00')
		// strtotime('+1day')
	), true
)['result'];


?>
<!-- JQUERY -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- FONT AWESSOME -->
<script src="https://use.fontawesome.com/e8a42d7e14.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/kundenportal/layout/style.css?v=<?php echo time(); ?>">
</div>

<?php include_once 'login-form.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-12 bg-light text-uppercase">
			<?php include_once 'sidebar.php'; ?>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-12">
