<?php
include_once 'kundenportal/init.php';
$contact_support = get_posts([
	'category_name' => 'contact_support',
	'post_status' => 'publish',
]);
$contact_faq = get_posts([
	'category_name' => 'contact_faq',
	'post_status' => 'publish',
]);
?>

<div class="container pb-5">
<div class="h3 text-secondary">Unterstützung</div>
	<?php foreach ($contact_support as $key => $value): ?>
		<div class="row border-bottom">
			<div class="col-6 text-secondary">
				<b><?php echo strip_tags($value->post_title);?></b>:
			</div>
			<div class="col-6">
				<?php echo strip_tags($value->post_content); ?>
			</div>
		</div>
	<?php endforeach ?>

<div class="h3 pt-5 text-secondary">FAQ</div>
	<div id="accordion" class="">
		<?php foreach ($contact_faq as $key => $value): ?>
			<h3><?php echo $value->post_title ?> 1</h3>
		<div><?php echo $value->post_content; ?></div>
		<?php endforeach ?>
		
	</div>

</div>


<script>
	$( function() {
		$("#accordion").accordion({
			active: 1000,
		});
	});
</script>

<?php include_once 'kundenportal/layout/footer.php'; ?>
