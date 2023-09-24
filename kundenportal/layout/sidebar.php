
<?php $current_page_slug = get_post()->post_name; ?>

<div class="text-primary text-end d-block d-lg-none d-md-none d-xl-none d-xxl-none">
	<a href="#" class="btn btn-outline-primary" id="kundenportalMenuTrigger">
		<i class="fa fa-chevron-down" aria-hidden="true"></i>
	</a>
</div>

<div id="kundenportalMenu" class="kundenportal-menu">	
	<div class="border-bottom">
		<a href="/kundenportal/new_review/" class="<?php if ($current_page_slug == 'new_review'): ?>
		text-danger
		<?php endif ?> btn btn-lg btn-outline-primary w-100 border-light">
		Neue Rezension
	</a>
</div>
<div class="border-bottom">
	<a href="/kundenportal/rewiews_in_removal/" class="<?php if ($current_page_slug == 'rewiews_in_removal'): ?>
	text-danger
	<?php endif ?> btn btn-lg btn-outline-primary w-100 border-light">
	Bewertungen in Entfernung
</a>
</div>
<div class="border-bottom">
	<a href="#" class="btn btn-lg btn-outline-primary w-100 border-light">
		Archiv
	</a>
</div>
<div class="border-bottom">
	<a href="#" class="btn btn-lg btn-outline-primary w-100 border-light">
		Rechnungen
	</a>
</div>

<div class="border-bottom p-5 d-none d-lg-block d-md-block"></div>

<div class="border-bottom">
	<a href="/kundenportal/contact_profile/" class="<?php if ($current_page_slug == 'contact_profile'): ?>
	text-danger
	<?php endif ?> btn btn-lg btn-outline-primary w-100 border-light">
	Profil
</a>
</div>
<div class="border-bottom mb-5">
	<a href="/kundenportal/contact_support/" class="<?php if ($current_page_slug == 'contact_support'): ?>
	text-danger
	<?php endif ?> btn btn-lg btn-outline-primary w-100 border-light">
	Unterstützung
</a>
</div>
</div>

<script>
	$(function () {
		$('#kundenportalMenuTrigger').click(function () {
			$('#kundenportalMenu').slideToggle();
		});
	});
</script>